<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\LaundryTransaction;
use App\Models\OverheadCost;
use App\Models\RawMaterial;
use App\Services\AhpService;
use Illuminate\Http\Request;

class LaundryTransactionController extends Controller
{
    public function index()
    {
        $transactions = LaundryTransaction::with('customer')
            ->latest()
            ->paginate(5);

        return view('pages.transactions', compact('transactions'));
    }

    /* =====================
        STEP 1
    ===================== */
    public function create()
    {
        $customers = Customer::all();

        return view('pages.laundry-transactions.step-1', compact('customers'));
    }

    public function storeStep1(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'nullable|string',
            'transaction_date' => 'required|date',
            'pickup_date' => 'required|date',
        ]);

        session(['step1' => $data]);

        return redirect()->route('laundry-transactions.step2');
    }

    /* =====================
        STEP 2
    ===================== */
    public function step2()
    {
        abort_if(! session()->has('step1'), 404);

        return view('pages.laundry-transactions.step-2');
    }

    public function storeStep2(Request $request)
    {
        $data = $request->validate([
            'category' => 'required',
            'laundry_type' => 'required',
            'laundry_weight' => 'required|numeric|min:0.1',
            'perfume' => 'nullable',
            'notes' => 'nullable',
        ]);

        session(['step2' => $data]);

        return redirect()->route('laundry-transactions.step3');
    }

    /* =====================
        STEP 3 (REVIEW + SAVE)
    ===================== */
    public function step3()
    {
        abort_if(! session()->has('step2'), 404);

        $weight = session('step2.laundry_weight');

        // PRICING FIX
        $pricePerKg = 10000;
        $serviceFee = 1500;

        $totalPrice = ($pricePerKg * $weight) + $serviceFee;

        return view('pages.laundry-transactions.step-3', [
            'step1' => session('step1'),
            'step2' => session('step2'),
            'pricePerKg' => $pricePerKg,
            'serviceFee' => $serviceFee,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function storeFinal(AhpService $ahp)
    {
        $step1 = session('step1');
        $step2 = session('step2');

        /* =====================
           A. DATA BIAYA BULANAN
        ===================== */
        $monthlyCapacityKg = 350;

        $totalRawMaterial = RawMaterial::sum('price'); // Rp 235.000
        $totalLabor = Employee::with('detail')->get()
            ->sum(fn ($e) => $e->detail->salary ?? 0); // Rp 49.161.824
        $totalOverhead = OverheadCost::sum('cost_amount'); // Rp 4.300.000

        /* =====================
           B. BIAYA PER KG
        ===================== */
        $rawPerKg = $totalRawMaterial / $monthlyCapacityKg;
        $laborPerKg = $totalLabor / $monthlyCapacityKg;
        $overheadPerKg = $totalOverhead / $monthlyCapacityKg;

        /* =====================
           C. AHP
        ===================== */
        $criteriaMatrix = [
            [1,   3,   5],
            [1 / 3, 1, 3],
            [1 / 5, 1 / 3, 1],
        ];

        $result = $ahp->calculate($criteriaMatrix);
        if (! $result['is_consistent']) {
            return back()->withErrors('Matriks AHP tidak konsisten (CR > 0.1)');
        }

        $weights = $result['weights'];

        /* =====================
           D. HPP PER KG (AHP)
        ===================== */
        $hppPerKg = ($weights[0] * $rawPerKg)
                  + ($weights[1] * $laborPerKg)
                  + ($weights[2] * $overheadPerKg);

        $hppPerKg = round($hppPerKg);
        $totalHpp = $hppPerKg * $step2['laundry_weight'];

        /* =====================
           E. PRICING
        ===================== */
        $pricePerKg = 10000;
        $serviceFee = 1500;

        $totalPrice = ($pricePerKg * $step2['laundry_weight']) + $serviceFee;

        /* =====================
           F. SIMPAN DATA
        ===================== */
        $customer = Customer::create([
            'customer_name' => $step1['customer_name'],
            'phone_number' => $step1['phone_number'],
            'address' => $step1['address'] ?? null,
        ]);

        LaundryTransaction::create([
            'customer_id' => $customer->id,
            'transaction_date' => $step1['transaction_date'],
            'laundry_weight' => $step2['laundry_weight'],
            'hpp_per_kg' => $hppPerKg,
            'total_hpp' => $totalHpp,
            'total_price' => $totalPrice,
            'notes' => $step2['notes'] ?? null,
        ]);

        session()->forget(['step1', 'step2']);

        return redirect()
            ->route('laundry-transactions.index')
            ->with('success', 'Transaksi berhasil');
    }

    /* =====================
       HPP VIEW (REVIEW)
    ===================== */
    public function hpp(AhpService $ahp)
    {
        abort_if(! session()->has('step2'), 404);

        $step1 = session('step1');
        $step2 = session('step2');

        /* =====================
           AHP: MATRIX KRITERIA
        ===================== */
        $criteriaMatrix = [
            [1, 1 / 3, 3],    // Bahan Baku
            [3, 1, 5],      // Tenaga Kerja
            [1 / 3, 1 / 5, 1],  // Overhead
        ];

        $ahpResult = $ahp->calculate($criteriaMatrix);

        if (! $ahpResult['is_consistent']) {
            return back()->withErrors('Matriks AHP tidak konsisten (CR > 0.1)');
        }

        $weights = $ahpResult['weights'];
        $cr = $ahpResult['cr'];

        /* =====================
           DATA BIAYA BULANAN
        ===================== */
        $monthlyCapacityKg = 4000;

        $rawMaterialCost = RawMaterial::sum('price');
        $laborCost = Employee::with('detail')->get()->sum(fn ($e) => $e->detail->salary ?? 0);
        $overheadCost = OverheadCost::sum('cost_amount');

        /* =====================
           BIAYA PER KG
        ===================== */
        $rawPerKg = $rawMaterialCost / $monthlyCapacityKg;
        $laborPerKg = $laborCost / $monthlyCapacityKg;
        $overheadPerKg = $overheadCost / $monthlyCapacityKg;

        /* =====================
           HPP PER KG (AHP)
        ===================== */
        $hppPerKg = ($weights[0] * $rawPerKg) + ($weights[1] * $laborPerKg) + ($weights[2] * $overheadPerKg);
        $hppPerKg = round($hppPerKg);

        /* =====================
           TOTAL HPP
        ===================== */
        $totalHpp = $hppPerKg * $step2['laundry_weight'];

        /* =====================
           PRICING FIX (opsional)
        ===================== */
        $pricePerKg = 10000;
        $serviceFee = 1500;

        return view('pages.laundry-transactions.step-hpp', compact(
            'step1',
            'step2',
            'rawMaterialCost',
            'laborCost',
            'overheadCost',
            'hppPerKg',
            'totalHpp',
            'weights',
            'cr',
            'pricePerKg',
            'serviceFee'
        ));
    }

    public function destroy(LaundryTransaction $laundryTransaction)
    {
        $laundryTransaction->delete();

        return back()->with('success', 'Transaction deleted');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\LaundryTransaction;
use App\Models\OverheadCost;
use App\Models\RawMaterial;
use App\Services\AhpService;
use App\Services\LaundryPricingService;
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
        return view('pages.laundry-transactions.step-1');
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
        STEP 3 (REVIEW)
    ===================== */
    public function step3(LaundryPricingService $pricing)
    {
        abort_if(! session()->has('step2'), 404);

        $step1 = session('step1');
        $step2 = session('step2');

        $pricingResult = $pricing->calculate($step2);

        return view('pages.laundry-transactions.step-3', compact(
            'step1',
            'step2',
            'pricingResult'
        ));
    }

    /* =====================
        FINAL SAVE
    ===================== */
    public function storeFinal(
        LaundryPricingService $pricing,
        AhpService $ahp
    ) {
        abort_if(
            ! session()->has('step1') || ! session()->has('step2'),
            404
        );

        $step1 = session('step1');
        $step2 = session('step2');

        /* ======================
           HITUNG HARGA JUAL
        ====================== */
        $pricingResult = $pricing->calculate($step2);

        /* ======================
           HITUNG HPP (AHP)
        ====================== */
        $criteriaMatrix = [
            [1, 1 / 3, 3],
            [3, 1, 5],
            [1 / 3, 1 / 5, 1],
        ];

        $ahpResult = $ahp->calculate($criteriaMatrix);

        if (! $ahpResult['is_consistent']) {
            return back()->withErrors('Matriks AHP tidak konsisten');
        }

        $weights = $ahpResult['weights'];
        $monthlyCapacityKg = 4000;

        $rawPerKg = RawMaterial::sum('price') / $monthlyCapacityKg;
        $laborPerKg = Employee::with('detail')
            ->get()
            ->sum(fn ($e) => $e->detail->salary ?? 0) / $monthlyCapacityKg;
        $overheadPerKg = OverheadCost::sum('cost_amount') / $monthlyCapacityKg;

        $hppPerKg = round(
            ($weights[0] * $rawPerKg) +
            ($weights[1] * $laborPerKg) +
            ($weights[2] * $overheadPerKg)
        );

        $totalHpp = $hppPerKg * $step2['laundry_weight'];

        /* ======================
           BUAT CUSTOMER
        ====================== */
        $customer = Customer::create([
            'customer_name' => $step1['customer_name'],
            'phone_number' => $step1['phone_number'],
            'address' => $step1['address'] ?? null,
        ]);

        /* ======================
           SIMPAN TRANSAKSI
        ====================== */
        LaundryTransaction::create([
            'customer_id' => $customer->id,
            'transaction_date' => $step1['transaction_date'],
            'laundry_weight' => $step2['laundry_weight'],
            'category' => $step2['category'],
            'laundry_type' => $step2['laundry_type'],
            'perfume' => $step2['perfume'] ?? null,
            'total_price' => $pricingResult['total_price'],
            'hpp_per_kg' => $hppPerKg,
            'total_hpp' => $totalHpp,
            'notes' => $step2['notes'] ?? null,
        ]);

        /* ======================
           CLEAR SESSION
        ====================== */
        session()->forget(['step1', 'step2']);

        return redirect()
            ->route('laundry-transactions.index')
            ->with('success', 'Transaksi berhasil disimpan');
    }

    /* =====================
        HPP VIEW
    ===================== */
    public function hpp(AhpService $ahp)
    {
        abort_if(! session()->has('step2'), 404);

        $step2 = session('step2');

        // =====================
        // AHP MATRIX
        // =====================
        $criteriaMatrix = [
            [1, 1 / 3, 3],
            [3, 1, 5],
            [1 / 3, 1 / 5, 1],
        ];

        $ahpResult = $ahp->calculate($criteriaMatrix);

        if (! $ahpResult['is_consistent']) {
            return back()->withErrors('Matriks AHP tidak konsisten');
        }

        $weights = $ahpResult['weights'];

        // =====================
        // KAPASITAS BULANAN
        // =====================
        $monthlyCapacityKg = 4000;

        // =====================
        // BIAYA PER KG
        // =====================
        $rawMaterialCost = RawMaterial::sum('price') / $monthlyCapacityKg;

        $laborCost = Employee::with('detail')
            ->get()
            ->sum(fn ($e) => $e->detail->salary ?? 0) / $monthlyCapacityKg;

        $overheadCost = OverheadCost::sum('cost_amount') / $monthlyCapacityKg;

        // =====================
        // HPP PER KG (AHP)
        // =====================
        $hppPerKg = round(
            ($weights[0] * $rawMaterialCost) +
            ($weights[1] * $laborCost) +
            ($weights[2] * $overheadCost)
        );

        $totalHpp = $hppPerKg * $step2['laundry_weight'];

        return view('pages.laundry-transactions.step-hpp', compact(
            'rawMaterialCost',
            'laborCost',
            'overheadCost',
            'hppPerKg',
            'totalHpp',
            'step2'
        ));
    }
}

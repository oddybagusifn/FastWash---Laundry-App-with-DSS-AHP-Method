<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OverheadCost;

class OverheadCostController extends Controller
{
public function index()
{
$overheads = OverheadCost::paginate(5);
return view('pages.overhead', compact('overheads'));
}


public function store(Request $request)
{
OverheadCost::create($request->validate([
'cost_name' => 'required|string|max:100',
'cost_amount' => 'required|numeric|min:0'
]));


return back()->with('success', 'Overhead cost added');
}


public function update(Request $request, OverheadCost $overheadCost)
{
$overheadCost->update($request->validate([
'cost_name' => 'required|string|max:100',
'cost_amount' => 'required|numeric|min:0'
]));


return back()->with('success', 'Overhead cost updated');
}


public function destroy(OverheadCost $overheadCost)
{
$overheadCost->delete();
return back()->with('success', 'Overhead cost deleted');
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RawMaterial;

class RawMaterialController extends Controller
{
public function index(Request $request)
{
$rawMaterials = RawMaterial::when($request->search, function ($q) use ($request) {
$q->where('item_name', 'like', '%' . $request->search . '%');
})
->paginate(5);


return view('pages.raw-materials', compact('rawMaterials'));
}


public function store(Request $request)
{
$data = $request->validate([
'item_name' => 'required|string|max:100',
'item_category' => 'required|string|max:50',
'stock' => 'required|integer|min:0',
'price' => 'required|numeric|min:0',
]);


RawMaterial::create($data);


return back()->with('success', 'Raw material created successfully');
}


public function update(Request $request, RawMaterial $rawMaterial)
{
$data = $request->validate([
'item_name' => 'required|string|max:100',
'item_category' => 'required|string|max:50',
'stock' => 'required|integer|min:0',
'price' => 'required|numeric|min:0',
]);


$rawMaterial->update($data);


return back()->with('success', 'Raw material updated successfully');
}


public function destroy(RawMaterial $rawMaterial)
{
$rawMaterial->delete();
return back()->with('success', 'Raw material deleted successfully');
}
}{
    //
}

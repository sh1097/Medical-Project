<?php

namespace App\Http\Controllers;
use App\Models\MedicalShop;
use Illuminate\Http\Request;

class MedicalShopController extends Controller
{
    public function index()
    {
        $shops = MedicalShop::all();
        return view('medical_shops.index', compact('shops'));
    }
    
    public function create()
    {
        $shops = MedicalShop::all();

        return view('medical_shops.create', compact('shops'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
        ]);
    
        MedicalShop::create($request->all());
        return redirect()->route('medical_shops.index');
    }
    
    public function edit(MedicalShop $medicalShop)
    {
        return view('medical_shops.edit', compact('medicalShop'));
    }
    
    public function update(Request $request, MedicalShop $medicalShop)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
        ]);
    
        $medicalShop->update($request->all());
        return redirect()->route('medical_shops.index');
    }
    
    public function destroy(MedicalShop $medicalShop)
    {
        $medicalShop->delete();
        return redirect()->route('medical_shops.index');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Shop;

use Illuminate\Http\Request;

class ClinicShopController extends Controller
{
    public function edit(Clinic $clinic)
    {
        return view('clinics.shop.edit', compact('clinic'));
    }

    public function update(Request $request, Clinic $clinic)
    {
        $request->validate([
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate images if needed
            'prices.*' => 'numeric|min:0', // Validate prices if needed
            'discounts.*' => 'numeric|min:0|max:100', // Validate discounts if needed
            // Add more validation rules as necessary
        ]);

        // Handle file uploads if you have image uploads
        if ($request->hasFile('product_images')) {
            $images = [];

            foreach ($request->file('product_images') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName); // Store images in storage/app/public/images

                $images[] = $imageName;
            }

            $clinic->product_images = $images;
        }

        // Update prices and discounts
        $clinic->prices = $request->input('prices');
        $clinic->discounts = $request->input('discounts');

        // Save updated data
        $clinic->save();

        return redirect()->route('clinics.shop.edit', $clinic)
                         ->with('success', 'Shop details updated successfully!');
    }

    public function create(Clinic $clinic)
    {
        return view('shops.create', compact('clinic'));
    }

    public function store(Request $request, $clinicId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'prices.*' => 'numeric|min:0',
            'discounts.*' => 'numeric|min:0|max:100',
            // Add more validation rules as necessary for other fields
        ]);
    
        // Handle file uploads for product images
        $productImages = [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);
                $productImages[] = $imageName;
            }
        }
        $productImagesJson = json_encode($productImages);
        $pricesJson = json_encode($request->input('prices'));
        $discountsJson = json_encode($request->input('discounts'));
        // Prepare data for shop creation

    
    $shop = new Shop();
    $shop->clinic_id = $clinicId;
    $shop->name = $request->input('name');
    $shop->product_images = $productImagesJson;
    $shop->prices = $pricesJson;
    $shop->discounts = $discountsJson;
    // echo "<pre>";print_r($shop);die;

        // Create the shop
        $shop->save();      
        return redirect()->route('clinics.shop.index', ['clinic' => $clinicId])->with('success', 'Shop created successfully!');

    }
  public function index()
    {
        $clinics = Clinic::with('shops')->get();

       
        

        
        return view('clinics.index', compact('clinics'));
    }

    public function show($id)
    {
        $clinic = Clinic::with('shops')->findOrFail($id);
        return view('clinics.show', compact('clinic'));
    }
}

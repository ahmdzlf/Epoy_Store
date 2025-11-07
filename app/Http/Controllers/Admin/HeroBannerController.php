<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use App\Models\Product;
use Illuminate\Http\Request;

class HeroBannerController extends Controller
{
    public function index()
    {
        $heroBanner = HeroBanner::with('product.primaryImage')->first();
        $products = Product::all();
        
        return view('admin.hero-banners.index', compact('heroBanner', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Hapus hero banner lama
        HeroBanner::query()->delete();
        
        // Buat hero banner baru
        HeroBanner::create([
            'product_id' => $request->product_id,
            'is_active' => true
        ]);

        return redirect()->route('admin.hero-banners.index')
            ->with('success', 'Hero Banner berhasil diupdate!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Testimonial;
use App\Models\HeroBanner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Hero Banner
        $heroBanner = HeroBanner::where('is_active', true)
            ->with('product.primaryImage')
            ->first();

        // Featured Product (fallback jika tidak ada hero banner)
        $featuredProduct = Product::active()
            ->featured()
            ->with('primaryImage')
            ->first();

        // Popular Products
        $popularProducts = Product::active()
            ->with(['primaryImage', 'category'])
            ->latest()
            ->take(12)
            ->get();

        // Best Selling Products
        $bestSellingProducts = Product::active()
            ->with(['primaryImage', 'category'])
            ->latest()
            ->take(8)
            ->get();

        // Testimonials
        $testimonials = Testimonial::where('is_active', true)
            ->latest()
            ->take(4)
            ->get();

        return view('home', compact(
            'heroBanner',
            'featuredProduct',
            'popularProducts', 
            'bestSellingProducts',
            'testimonials'
        ));
    }
}
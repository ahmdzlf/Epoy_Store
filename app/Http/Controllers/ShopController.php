<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)    
            ->withCount('products')
            ->get();

        $query = Product::with(['primaryImage', 'category'])
            ->where('is_active', true);

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Filter by gender
        if ($request->has('gender') && $request->gender != '') {
            $query->where('gender', $request->gender);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by price
        if ($request->filled('price')) {
            switch ($request->price) {
                case 'under-100k':
                    $query->where('price', '<', 100000);
                    break;
                case '100k-250k':
                    $query->whereBetween('price', [100000, 250000]);
                    break;
                case '250k-500k':
                    $query->whereBetween('price', [250000, 500000]);
                    break;
                case 'over-500k':
                    $query->where('price', '>', 500000);
                    break;
            }
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(12);

        return view('shop', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with(['primaryImage', 'category', 'images'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedProducts = Product::with(['primaryImage', 'category'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->take(4)
            ->get();

        return view('product-detail', compact('product', 'relatedProducts', 'testimonials'));
    }
}
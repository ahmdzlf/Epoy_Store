@extends('layouts.app')

@section('title', 'Home - EpStore')

@section('content')
<!-- Hero Section -->
<section class="bg-gray-100 py-12 lg:py-20">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            
            <!-- Left: Text Content (STATIS - TIDAK BERUBAH) -->
            <div>
                <h1 class="text-5xl lg:text-4xl font-bold leading-tight mb-5">
                    Tampil Keren Setiap Hari<br>
                    Bersama EP Store!
                </h1>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Saatnya upgrade outfit kamu tanpa harus bingung mix and match<br>
                    Kami hadir dengan koleksi fashion pria dan wanita terbaru yang siap menemani setiap momen kamu.
                </p>
            </div>
            
            <!-- Right: Featured Product (DINAMIS - Dari Hero Banner) -->
            <div class="flex justify-center lg:justify-end">
                @php
                    // Ambil produk dari hero banner atau featured product sebagai fallback
                    $displayProduct = ($heroBanner && $heroBanner->product) ? $heroBanner->product : $featuredProduct;
                @endphp

@if($displayProduct)
    <div class="bg-white rounded-xl shadow-lg overflow-hidden" style="width: 400px;">
        <!-- Product Image with Background -->
        <div class="relative bg-gradient-to-br from-white to-gray-200 flex items-center justify-center overflow-hidden" style="height: 350px;">
            @if($displayProduct->primaryImage)
                <img src="{{ asset('storage/' . $displayProduct->primaryImage->image_path) }}" 
                     alt="{{ $displayProduct->name }}" 
                     class="w-[90%] h-auto max-h-[320px] object-contain transform scale-125 transition-transform duration-500 hover:scale-[1.35]">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-400">
                    No Image
                </div>
            @endif
        </div>

                        <!-- Product Info -->
                        <div class="p-5 text-center">
                            <h3 class="font-semibold text-base mb-1">{{ $displayProduct->name }}</h3>
                            <p class="text-gray-700 text-sm font-medium">
                                Rp {{ number_format($displayProduct->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @else
                    <!-- Fallback jika tidak ada hero banner dan featured product -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden" style="width: 400px;">
                        <div class="bg-gray-200" style="height: 350px;">
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                No Featured Product
                            </div>
                        </div>
                        <div class="p-5 text-center">
                            <h3 class="font-semibold text-base mb-1">Produk Unggulan</h3>
                            <p class="text-gray-700 text-sm font-medium">Rp 0</p>
                        </div>
                    </div>
                @endif
            </div>
            
        </div>
    </div>
</section>

<!-- Brand Logos Section (H&M, Levi's, Zara) -->
<section class="bg-black py-8">
    <div class="container mx-auto px-6">
        <div class="flex justify-center items-center gap-16">
            <div class="text-white text-3xl font-bold italic" style="font-family: 'Futura', sans-serif;">H&M</div>
            <div class="text-white text-3xl font-bold">LEVI'S</div>
            <div class="text-white text-3xl font-bold">ZARA</div>
        </div>
    </div>
</section>
<!-- Best Selling Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        
        <!-- Section Header -->
        <div class="text-center mb-10">
            <!-- Title with Lines -->
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="h-px bg-black w-16"></div>
                <h2 class="text-2xl font-bold">Best Selling</h2>
                <div class="h-px bg-black w-16"></div>
            </div>
            
            <!-- Filter Buttons -->
            <div class="flex justify-center gap-3 flex-wrap">
                <button class="px-8 py-2 bg-black text-white text-sm font-medium transition hover:bg-gray-800">
                    Man
                </button>
                <button class="px-8 py-2 border border-black text-sm font-medium transition hover:bg-black hover:text-white">
                    Woman
                </button>
                <button class="px-8 py-2 border border-black text-sm font-medium transition hover:bg-black hover:text-white">
                    kids
                </button>
                <button class="px-8 py-2 border border-black text-sm font-medium transition hover:bg-black hover:text-white">
                    Unisex
                </button>
            </div>
        </div>

        <!-- Products Grid (3 columns) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($bestSellingProducts as $product)
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                    
                    <!-- Product Image Container -->
                    <div class="relative bg-gray-50 overflow-hidden" style="height: 280px;">
                        <!-- NEW Badge -->
                        @if($product->is_new)
                            <span class="absolute top-3 left-3 bg-black text-white px-2.5 py-1 text-xs font-bold uppercase z-10">
                                NEW
                            </span>
                        @endif
                        
                        <!-- Product Link & Image -->
                        <a href="{{ route('product.detail', $product->slug) }}" class="block h-full">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-contain p-4 hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-gray-400 text-sm">No Image</span>
                                </div>
                            @endif
                        </a>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="p-4 bg-white">
                        <h3 class="font-medium text-sm mb-3 truncate">
                            {{ $product->name }}
                        </h3>
                        
                        <div class="flex justify-between items-center">
                            <!-- Price -->
                            <p class="text-sm font-semibold text-gray-800">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            
                            <!-- Arrow Button -->
                            <a href="{{ route('product.detail', $product->slug) }}" 
                               class="bg-black text-white rounded-full w-9 h-9 flex items-center justify-center hover:bg-gray-800 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        
                        <!-- Stock Status (Optional) -->
                        @if(!$product->is_in_stock)
                            <p class="text-xs text-red-500 mt-2">Out of Stock</p>
                        @endif
                    </div>
                    
                </div>
            @empty
                <div class="col-span-3 text-center py-16">
                    <p class="text-gray-500 text-base">Belum ada produk tersedia</p>
                </div>
            @endforelse
        </div>
        
    </div>
</section>

<!-- Client Testimonial Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        
        <!-- Section Title -->
        <div class="flex items-center justify-center gap-3 mb-10">
            <div class="h-px bg-black w-16"></div>
            <h2 class="text-2xl font-bold">Client Testimonial</h2>
            <div class="h-px bg-black w-16"></div>
        </div>

        <!-- Testimonials Grid (2 columns) -->
        <div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            @forelse($testimonials as $testimonial)
                <div class="bg-white rounded-lg shadow-md p-6 flex gap-4">
                    
                    <!-- Customer Photo -->
                    @if($testimonial->customer_photo)
                        <img src="{{ asset('storage/' . $testimonial->customer_photo) }}" 
                             alt="{{ $testimonial->customer_name }}" 
                             class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                    @else
                        <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                            <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <!-- Testimonial Content -->
                    <div class="flex-1">
                        <!-- Customer Name -->
                        <h4 class="font-semibold text-base mb-1">
                            {{ $testimonial->customer_name }}
                        </h4>
                        
                        <!-- Star Rating -->
                        <div class="flex text-yellow-400 text-sm mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                    <span>★</span>
                                @else
                                    <span class="text-gray-300">★</span>
                                @endif
                            @endfor
                        </div>
                        
                        <!-- Review Text -->
                        <p class="text-gray-600 text-sm leading-relaxed">
                            {{ $testimonial->testimonial }}
                        </p>
                    </div>
                    
                </div>
            @empty
                <div class="col-span-2 text-center py-16">
                    <p class="text-gray-500 text-base">Belum ada testimoni</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination Dots -->
        @if($testimonials->count() > 0)
            <div class="flex justify-center gap-2 mt-8">
                <div class="w-2 h-2 rounded-full bg-black"></div>
                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
            </div>
        @endif
        
    </div>
</section>

<!-- Footer -->
<footer class="bg-black text-white py-12">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
            
            <!-- Column 1: About -->
            <div>
                <h3 class="font-bold text-base mb-4">EpoyStore</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-4">
                    Lorem Ipsum Dolor Sit Amet, Consectetur<br>
                    Adipiscing Elit, Sed Do Eiusmod Tempor<br>
                    Incididunt Ut Labore Et Dolore Magna Aliqua.
                </p>
                
                <!-- Social Media Icons -->
                <div class="flex gap-3">
                    <a href="#" class="w-9 h-9 bg-white text-black rounded-full flex items-center justify-center hover:bg-gray-200 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-9 h-9 bg-white text-black rounded-full flex items-center justify-center hover:bg-gray-200 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Column 2: Newsletter -->
            <div>
                <h3 class="font-bold text-base mb-4">Subscribe to our news letter</h3>
                <form action="#" method="POST" class="mb-4">
                    @csrf
                    <input type="email" 
                           name="email"
                           placeholder="Enter Email..." 
                           class="w-full px-4 py-2.5 rounded text-black text-sm focus:outline-none focus:ring-2 focus:ring-gray-400"
                           required>
                </form>
                <p class="text-gray-400 text-sm">
                    <span class="mr-2">📞</span>+6234 - store@epocpanel.co
                </p>
            </div>
            
            <!-- Column 3: Quick Links -->
            <div>
                <h3 class="font-bold text-base mb-4">Quick Links</h3>
                <ul class="text-gray-400 text-sm space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('shop') }}" class="hover:text-white transition">Shop</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition">Collection</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition">Contact</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition">Wishlist</a>
                    </li>
                </ul>
            </div>
            
        </div>
        
        <!-- Copyright -->
        <div class="border-t border-gray-800 pt-6 text-center">
            <p class="text-gray-400 text-sm">
                &copy; {{ date('Y') }} EpoyStore. All rights reserved.
            </p>
        </div>
    </div>
</footer>

@endsection
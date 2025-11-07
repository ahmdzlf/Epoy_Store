@extends('layouts.app')

@section('title', $product->name . ' - EP Store')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Breadcrumb -->
    <nav class="mb-8 text-sm text-gray-600">
        <a href="{{ route('home') }}" class="hover:text-black">Home</a>
        <span class="mx-2">/</span>
        <span class="text-black font-medium">Detail</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        <!-- Product Image -->
        <div>
            <div class="bg-gray-50 rounded-lg p-8 border border-gray-200">
                @if($product->primaryImage)
                    <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-[500px] object-contain">
                @else
                    <div class="w-full h-[500px] bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">No Image</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Info -->
        <div>
            <!-- Breadcrumb Detail -->
            <p class="text-sm text-gray-500 mb-4">Home/Detail</p>
            
            <h1 class="text-3xl lg:text-4xl font-bold mb-6">{{ $product->name }}</h1>
            
            <!-- Info List -->
            <div class="space-y-3 mb-8 text-sm">
                <div>
                    <p class="text-gray-600">Formal Shoes</p>
                    <p class="font-medium">{{ $product->category->name }}</p>
                </div>
                
                @if($product->description)
                <div>
                    <p class="text-gray-600">Deskripsi Produk</p>
                    <p class="font-medium">{{ $product->description }}</p>
                </div>
                @endif
                
                @if($product->detail)
                <div>
                    <p class="text-gray-600">Detail Produk</p>
                    <p class="font-medium">{{ $product->detail }}</p>
                </div>
                @endif
                
                <div>
                    <p class="text-gray-600">Stok:</p>
                    <p class="font-medium">{{ $product->stock }} Tersedia</p>
                </div>
                
                <div>
                    <p class="text-gray-600">SKU:</p>
                    <p class="font-medium">{{ $product->sku ?? 'FCS-005' }}</p>
                </div>
                
                <div>
                    <p class="text-gray-600">Gender:</p>
                    <p class="font-medium">{{ ucfirst($product->gender ?? 'Men') }}</p>
                </div>
                
                <div>
                    <p class="text-gray-600">Kategori:</p>
                    <p class="font-medium">{{ $product->category->name }}</p>
                </div>
            </div>

            <!-- Price -->
            <div class="mb-8">
                @if($product->has_discount)
                    <div class="flex items-baseline gap-3">
                        <span class="text-3xl font-bold">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                        <span class="text-xl text-gray-400 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                @else
                    <span class="text-3xl font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                @endif
            </div>

            <!-- Shop Now Button -->
            @php
                $waNumber = '6285718173038';
                $waText = 'Halo, saya tertarik dengan produk: ' . $product->name . ' - Rp ' . number_format($product->final_price, 0, ',', '.');
                $waLink = 'https://wa.me/' . $waNumber . '?text=' . urlencode($waText);
            @endphp
            
            @if($product->stock > 0)
                <a href="{{ $waLink }}" 
                   target="_blank" 
                   class="inline-block px-12 py-3 bg-black text-white font-medium hover:bg-gray-800 transition text-sm">
                    Shop Now
                </a>
            @else
                <button disabled 
                        class="inline-block px-12 py-3 bg-gray-300 text-gray-600 font-medium cursor-not-allowed text-sm">
                    Stok Habis
                </button>
            @endif
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-black text-white py-12 mt-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div>
                <h3 class="text-xl font-bold mb-4">EpoyStore</h3>
                <p class="text-gray-400 text-sm mb-6">
                    Lorem ipsum Dolor Sit Amet, Consectetur<br>
                    Adipiscing Elit, Sed Do Eiusmod tempor<br>
                    Incididunt Ut Labore Et Dolore Magna Aliqua.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 bg-white text-black rounded-full flex items-center justify-center">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white text-black rounded-full flex items-center justify-center">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                </div>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Subscribe to our news latter</h4>
                <input type="email" placeholder="Enter Email..." class="w-full px-4 py-2 text-sm bg-white text-black rounded">
            </div>
            
            <div>
                <h5 class="font-semibold mb-4">Quick Link's</h5>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                    <li><a href="{{ route('shop') }}" class="hover:text-white">Shop</a></li>
                    <li><a href="#">Collection</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Privacy</a></li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-800 pt-8 text-center">
            <p class="text-sm text-gray-400">epoy_store@apparel.co</p>
        </div>
    </div>
</footer>
@endsection
@extends('layouts.app')

@section('title', 'Shop - EP Store')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-8">Shop</h1>
    
    <!-- Filter & Products akan ditambahkan nanti -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @forelse($products as $product)
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
            <a href="{{ route('product.detail', $product->slug) }}">
                @if($product->primaryImage)
                    <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-64 object-cover rounded-t-lg">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-t-lg"></div>
                @endif
            </a>
            <div class="p-4">
                <h3 class="font-semibold mb-2">{{ $product->name }}</h3>
                <p class="font-bold text-lg">Rp {{ number_format($product->final_price, 0, ',', '.') }}</p>
            </div>
        </div>
        @empty
        <div class="col-span-4 text-center py-12">
            <p class="text-gray-500">Belum ada produk</p>
        </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>

<!-- Footer -->
<footer class="bg-black text-white py-12 mt-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">EpoyStore</h3>
                <p class="text-gray-400 text-sm">Lorem ipsum dolor sit amet</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Subscribe</h4>
                <input type="email" placeholder="Email..." class="w-full px-4 py-2 rounded">
            </div>
            <div>
                <h5 class="font-semibold mb-4">Quick Links</h5>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
@endsection
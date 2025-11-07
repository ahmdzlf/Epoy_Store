@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <!-- Total Products -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-gray-500 text-sm">Total Produk</div>
        <div class="text-3xl font-bold">{{ $totalProducts }}</div>
    </div>

    <!-- Total Categories -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-gray-500 text-sm">Total Kategori</div>
        <div class="text-3xl font-bold">{{ $totalCategories }}</div>
    </div>

    <!-- Total Orders -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-gray-500 text-sm">Total Pesanan</div>
        <div class="text-3xl font-bold">{{ $totalOrders }}</div>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-gray-500 text-sm">Total Pendapatan</div>
        <div class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Orders -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Pesanan Terbaru</h2>
        <div class="space-y-3">
            @forelse($recentOrders as $order)
            <div class="flex justify-between items-center border-b pb-2">
                <div>
                    <div class="font-semibold">{{ $order->order_number }}</div>
                    <div class="text-sm text-gray-600">{{ $order->customer_name }}</div>
                </div>
                <div class="text-right">
                    <div class="font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                    <span class="text-xs px-2 py-1 rounded 
                        @if($order->status == 'delivered') bg-green-100 text-green-800
                        @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
            @empty
            <p class="text-gray-500">Belum ada pesanan</p>
            @endforelse
        </div>
        @if($recentOrders->count() > 0)
        <a href="{{ route('admin.orders.index') }}" class="block text-center mt-4 text-blue-600 hover:underline">
            Lihat Semua Pesanan
        </a>
        @endif
    </div>

    <!-- Low Stock Products -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Stok Menipis</h2>
        <div class="space-y-3">
            @forelse($lowStockProducts as $product)
            <div class="flex justify-between items-center border-b pb-2">
                <div>
                    <div class="font-semibold">{{ $product->name }}</div>
                    <div class="text-sm text-gray-600">{{ $product->category->name }}</div>
                </div>
                <div class="text-right">
                    <span class="text-xs px-2 py-1 rounded bg-red-100 text-red-800">
                        Stok: {{ $product->stock }}
                    </span>
                </div>
            </div>
            @empty
            <p class="text-gray-500">Semua produk stok aman</p>
            @endforelse
        </div>
        @if($lowStockProducts->count() > 0)
        <a href="{{ route('admin.products.index') }}" class="block text-center mt-4 text-blue-600 hover:underline">
            Kelola Produk
        </a>
        @endif
    </div>
</div>
@endsection
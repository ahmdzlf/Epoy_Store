@extends('layouts.admin')

@section('title', 'Tambah Hero Banner')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.hero-banners.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                ← Kembali
            </a>
            <h1 class="text-3xl font-bold">Tambah Hero Banner</h1>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.hero-banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Judul *</label>
                    <input type="text" 
                           name="title" 
                           value="{{ old('title') }}"
                           class="w-full border rounded-lg px-4 py-2 @error('title') border-red-500 @enderror"
                           required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                    <textarea name="description" 
                              rows="3"
                              class="w-full border rounded-lg px-4 py-2 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Gambar Banner *</label>
                    <input type="file" 
                           name="image" 
                           accept="image/*"
                           class="w-full border rounded-lg px-4 py-2 @error('image') border-red-500 @enderror"
                           required>
                    <p class="text-gray-500 text-sm mt-1">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Produk Unggulan</label>
                    <select name="product_id" class="w-full border rounded-lg px-4 py-2">
                        <option value="">-- Pilih Produk (Opsional) --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Teks Tombol</label>
                        <input type="text" 
                               name="button_text" 
                               value="{{ old('button_text') }}"
                               placeholder="Contoh: Lihat Produk"
                               class="w-full border rounded-lg px-4 py-2">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Link Tombol</label>
                        <input type="text" 
                               name="button_link" 
                               value="{{ old('button_link') }}"
                               placeholder="Contoh: /products"
                               class="w-full border rounded-lg px-4 py-2">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Urutan</label>
                    <input type="number" 
                           name="order" 
                           value="{{ old('order', 0) }}"
                           class="w-full border rounded-lg px-4 py-2">
                    <p class="text-gray-500 text-sm mt-1">Semakin kecil angka, semakin awal ditampilkan</p>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="is_active" 
                               value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="mr-2">
                        <span class="text-gray-700">Aktifkan banner ini</span>
                    </label>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.hero-banners.index') }}" 
                       class="px-6 py-2 border rounded-lg hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                        Simpan Banner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
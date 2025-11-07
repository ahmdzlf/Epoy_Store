@extends('layouts.admin')

@section('title', 'Edit Hero Banner')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.hero-banners.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                ← Kembali
            </a>
            <h1 class="text-3xl font-bold">Edit Hero Banner</h1>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.hero-banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Judul *</label>
                    <input type="text" 
                           name="title" 
                           value="{{ old('title', $banner->title) }}"
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
                              class="w-full border rounded-lg px-4 py-2">{{ old('description', $banner->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Gambar Banner</label>
                    
                    @if($banner->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $banner->image) }}" 
                                 alt="Current banner" 
                                 class="w-48 h-48 object-cover rounded">
                            <p class="text-sm text-gray-500 mt-1">Gambar saat ini</p>
                        </div>
                    @endif
                    
                    <input type="file" 
                           name="image" 
                           accept="image/*"
                           class="w-full border rounded-lg px-4 py-2">
                    <p class="text-gray-500 text-sm mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Produk Unggulan</label>
                    <select name="product_id" class="w-full border rounded-lg px-4 py-2">
                        <option value="">-- Pilih Produk (Opsional) --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" 
                                    {{ old('product_id', $banner->product_id) == $product->id ? 'selected' : '' }}>
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
                               value="{{ old('button_text', $banner->button_text) }}"
                               class="w-full border rounded-lg px-4 py-2">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Link Tombol</label>
                        <input type="text" 
                               name="button_link" 
                               value="{{ old('button_link', $banner->button_link) }}"
                               class="w-full border rounded-lg px-4 py-2">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Urutan</label>
                    <input type="number" 
                           name="order" 
                           value="{{ old('order', $banner->order) }}"
                           class="w-full border rounded-lg px-4 py-2">
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="is_active" 
                               value="1"
                               {{ old('is_active', $banner->is_active) ? 'checked' : '' }}
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
                        Update Banner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('title', 'Hero Banner')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Hero Banner - Produk Unggulan</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Preview Produk Saat Ini -->
                    @if($heroBanner && $heroBanner->product)
                        <div class="alert alert-info">
                            <h5 class="mb-3"><i class="fas fa-info-circle"></i> Produk di Hero Banner Saat Ini:</h5>
                            <div class="d-flex align-items-center">
                                @if($heroBanner->product->primaryImage)
                                    <img src="{{ asset('storage/' . $heroBanner->product->primaryImage->image_path) }}" 
                                         alt="{{ $heroBanner->product->name }}" 
                                         class="rounded me-3"
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary rounded me-3 d-flex align-items-center justify-content-center text-white" 
                                         style="width: 100px; height: 100px;">
                                        <small>No Image</small>
                                    </div>
                                @endif
                                <div>
                                    <h5 class="mb-1">{{ $heroBanner->product->name }}</h5>
                                    <p class="mb-0 text-muted">Rp {{ number_format($heroBanner->product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Belum ada produk di hero banner
                        </div>
                    @endif

                    <!-- Form Pilih Produk -->
                    <form action="{{ route('admin.hero-banners.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="product_id" class="form-label">
                                <strong>Pilih Produk untuk Hero Banner</strong>
                            </label>
                            <select name="product_id" id="product_id" class="form-select" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" 
                                            {{ $heroBanner && $heroBanner->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save"></i> Update Hero Banner
                        </button>
                    </form>

                    <!-- Info -->
                    <div class="alert alert-light mt-4">
                        <h6 class="mb-2"><i class="fas fa-lightbulb"></i> Informasi:</h6>
                        <ul class="mb-0 small">
                            <li>Pilih produk yang akan muncul di hero banner homepage</li>
                            <li>Foto, nama, dan harga otomatis dari produk yang dipilih</li>
                            <li>Teks "Find Your Sole Mate With Us" tetap statis</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Products</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th style="width: 120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->primaryImage)
                                <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" 
                                     alt="{{ $product->name }}" 
                                     class="rounded"
                                     style="width: 60px; height: 60px; object-fit: cover;">
                                @elseif($product->images->first())
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                     alt="{{ $product->name }}" 
                                     class="rounded"
                                     style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-image"></i>
                                </div>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $product->name }}</strong>
                                    @if($product->is_featured)
                                    <span class="badge bg-warning text-dark ms-1" style="font-size: 10px;">Featured</span>
                                    @endif
                                    @if($product->is_new)
                                    <span class="badge bg-success ms-1" style="font-size: 10px;">New</span>
                                    @endif
                                </div>
                                @if($product->sku)
                                <small class="text-muted">SKU: {{ $product->sku }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $product->category->name }}</span>
                            </td>
                            <td>
                                @if($product->has_discount)
                                <div>
                                    <strong class="text-danger">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</strong>
                                    <br>
                                    <small class="text-muted text-decoration-line-through">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </small>
                                </div>
                                @else
                                <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                                @endif
                            </td>
                            <td>
                                @if($product->stock > 10)
                                <span class="badge bg-success">{{ $product->stock }}</span>
                                @elseif($product->stock > 0)
                                <span class="badge bg-warning text-dark">{{ $product->stock }}</span>
                                @else
                                <span class="badge bg-danger">Out of Stock</span>
                                @endif
                            </td>
                            <td>
                                @if($product->is_active)
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i> Active
                                </span>
                                @else
                                <span class="badge bg-secondary">
                                    <i class="fas fa-times-circle"></i> Inactive
                                </span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('product.detail', $product->slug) }}" 
                                       class="btn btn-info"
                                       title="View"
                                       target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="btn btn-warning"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-danger delete-product-btn"
                                            title="Delete"
                                            data-product-id="{{ $product->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $product->id }}" 
                                      action="{{ route('admin.products.destroy', $product) }}" 
                                      method="POST" 
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No products found</p>
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add Your First Product
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-product-btn') || e.target.closest('.delete-product-btn')) {
            const button = e.target.closest('.delete-product-btn');
            const productId = button.getAttribute('data-product-id');
            
            if (confirm('Are you sure you want to delete this product?\n\nThis will also delete all associated images and cannot be undone.')) {
                document.getElementById('delete-form-' + productId).submit();
            }
        }
    });
});
</script>
@endsection
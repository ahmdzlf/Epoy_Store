@extends('layouts.admin')

@section('title', 'Edit Order')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2>Edit Order #{{ $order->order_number }}</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">Order Notes</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes / Catatan Pesanan</label>
                            <textarea class="form-control" id="notes" name="notes" rows="5">{{ old('notes', $order->notes) }}</textarea>
                            <small class="text-muted">Gunakan untuk mencatat informasi tambahan seperti status pengiriman, pembayaran, dll.</small>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Order</button>
                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
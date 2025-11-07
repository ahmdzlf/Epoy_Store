@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Order Details</h2>
            <p class="text-muted mb-0">Order #{{ $order->order_number }}</p>
        </div>
        <div>
            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Notes
            </a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Customer Information -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Customer Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong><br>{{ $order->customer_name }}</p>
                            <p><strong>Email:</strong><br>{{ $order->customer_email }}</p>
                            <p><strong>Phone:</strong><br>{{ $order->customer_phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Shipping Address:</strong><br>{{ $order->shipping_address }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Order Items</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->product_name }}</strong>
                                    </td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                                    <td class="text-end">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Shipping:</strong></td>
                                    <td class="text-end">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="table-active">
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td class="text-end"><strong class="text-primary">Rp {{ number_format($order->total, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Order Summary -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <p><strong>Order Number:</strong><br>#{{ $order->order_number }}</p>
                    <p><strong>Order Date:</strong><br>{{ $order->created_at->format('d M Y H:i') }}</p>
                    <p><strong>Total Amount:</strong><br>
                        <h4 class="text-primary mb-0">Rp {{ number_format($order->total, 0, ',', '.') }}</h4>
                    </p>
                </div>
            </div>

            <!-- Order Notes -->
            @if($order->notes)
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Order Notes</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $order->notes }}</p>
                </div>
            </div>
            @endif

            <!-- Order History -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Order History</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <small class="text-muted">{{ $order->created_at->format('d M Y H:i') }}</small><br>
                            <strong>Order created</strong>
                        </li>
                        @if($order->updated_at != $order->created_at)
                        <li class="mb-2">
                            <small class="text-muted">{{ $order->updated_at->format('d M Y H:i') }}</small><br>
                            <strong>Last updated</strong>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('title', 'Create New Order')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2>Create New Order</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                <li class="breadcrumb-item active">Create New</li>
            </ol>
        </nav>
    </div>

    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-8">
                <!-- Customer Information -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">Customer Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="customer_name" class="form-label">Customer Name *</label>
                                <input type="text" 
                                       class="form-control @error('customer_name') is-invalid @enderror" 
                                       id="customer_name" 
                                       name="customer_name" 
                                       value="{{ old('customer_name') }}" 
                                       required>
                                @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="customer_email" class="form-label">Email *</label>
                                <input type="email" 
                                       class="form-control @error('customer_email') is-invalid @enderror" 
                                       id="customer_email" 
                                       name="customer_email" 
                                       value="{{ old('customer_email') }}" 
                                       required>
                                @error('customer_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="customer_phone" class="form-label">Phone *</label>
                                <input type="text" 
                                       class="form-control @error('customer_phone') is-invalid @enderror" 
                                       id="customer_phone" 
                                       name="customer_phone" 
                                       value="{{ old('customer_phone') }}" 
                                       required>
                                @error('customer_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="shipping_address" class="form-label">Shipping Address *</label>
                                <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                                          id="shipping_address" 
                                          name="shipping_address" 
                                          rows="3" 
                                          required>{{ old('shipping_address') }}</textarea>
                                @error('shipping_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                        <div id="order-items">
                            <div class="order-item-row mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Product *</label>
                                        <select name="products[0][product_id]" class="form-select product-select" required>
                                            <option value="">Select Product</option>
                                            @foreach($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->final_price }}" data-stock="{{ $product->stock }}">
                                                {{ $product->name }} - Rp {{ number_format($product->final_price, 0, ',', '.') }} (Stock: {{ $product->stock }})
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Quantity *</label>
                                        <input type="number" name="products[0][quantity]" class="form-control quantity-input" min="1" value="1" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Price</label>
                                        <input type="text" class="form-control price-display" readonly>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="button" class="btn btn-danger btn-sm w-100 remove-item" disabled>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm" id="add-item">
                            <i class="fas fa-plus"></i> Add Item
                        </button>
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
                        <div class="mb-3">
                            <label class="form-label">Subtotal</label>
                            <input type="text" class="form-control" id="subtotal-display" readonly value="Rp 0">
                        </div>

                        <div class="mb-3">
                            <label for="shipping_cost" class="form-label">Shipping Cost</label>
                            <input type="number" 
                                   class="form-control @error('shipping_cost') is-invalid @enderror" 
                                   id="shipping_cost" 
                                   name="shipping_cost" 
                                   value="{{ old('shipping_cost', 0) }}"
                                   min="0">
                            @error('shipping_cost')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label"><strong>Total Amount</strong></label>
                            <input type="text" class="form-control" id="total-display" readonly value="Rp 0">
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Create Order</button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
let itemCount = 1;

document.getElementById('add-item').addEventListener('click', function() {
    const container = document.getElementById('order-items');
    const newItem = container.querySelector('.order-item-row').cloneNode(true);
    
    // Update names
    newItem.querySelectorAll('select, input').forEach(el => {
        const name = el.getAttribute('name');
        if (name) {
            el.setAttribute('name', name.replace('[0]', `[${itemCount}]`));
        }
        if (el.tagName === 'INPUT') {
            el.value = el.classList.contains('quantity-input') ? 1 : '';
        } else if (el.tagName === 'SELECT') {
            el.selectedIndex = 0;
        }
    });
    
    newItem.querySelector('.remove-item').disabled = false;
    container.appendChild(newItem);
    itemCount++;
    
    attachEventListeners();
});

document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-item')) {
        e.target.closest('.order-item-row').remove();
        calculateTotal();
    }
});

function attachEventListeners() {
    document.querySelectorAll('.product-select').forEach(select => {
        select.addEventListener('change', function() {
            const price = this.options[this.selectedIndex].dataset.price || 0;
            const row = this.closest('.order-item-row');
            row.querySelector('.price-display').value = 'Rp ' + parseInt(price).toLocaleString('id-ID');
            calculateTotal();
        });
    });
    
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('input', calculateTotal);
    });
    
    document.getElementById('shipping_cost').addEventListener('input', calculateTotal);
}

function calculateTotal() {
    let subtotal = 0;
    
    document.querySelectorAll('.order-item-row').forEach(row => {
        const select = row.querySelector('.product-select');
        const price = parseFloat(select.options[select.selectedIndex]?.dataset.price) || 0;
        const quantity = parseInt(row.querySelector('.quantity-input').value) || 0;
        subtotal += price * quantity;
    });
    
    const shipping = parseFloat(document.getElementById('shipping_cost').value) || 0;
    const total = subtotal + shipping;
    
    document.getElementById('subtotal-display').value = 'Rp ' + subtotal.toLocaleString('id-ID');
    document.getElementById('total-display').value = 'Rp ' + total.toLocaleString('id-ID');
}

attachEventListeners();
</script>
@endsection
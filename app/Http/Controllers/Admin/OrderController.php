<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems')
            ->latest()
            ->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)
            ->where('stock', '>', 0)
            ->get();
        return view('admin.orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'shipping_cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1'
        ]);

        $subtotal = 0;
        $orderItems = [];

        // Calculate subtotal and prepare order items
        foreach ($validated['products'] as $item) {
            $product = Product::findOrFail($item['product_id']);
            
            if ($product->stock < $item['quantity']) {
                return back()->with('error', "Stok {$product->name} tidak mencukupi");
            }

            $itemSubtotal = $product->final_price * $item['quantity'];
            $subtotal += $itemSubtotal;

            $orderItems[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => $product->final_price,
                'quantity' => $item['quantity'],
                'subtotal' => $itemSubtotal
            ];
        }

        $shippingCost = $validated['shipping_cost'] ?? 0;
        $total = $subtotal + $shippingCost;

        // Create order
        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'shipping_address' => $validated['shipping_address'],
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            'notes' => $validated['notes'] ?? null
        ]);

        // Create order items and update stock
        foreach ($orderItems as $item) {
            $order->orderItems()->create($item);
            
            $product = Product::find($item['product_id']);
            $product->decrement('stock', $item['quantity']);
        }

        return redirect()->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil ditambahkan');
    }

    public function show(Order $order)
    {
        $order->load('orderItems.product');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

public function update(Request $request, Order $order)
{
    $validated = $request->validate([
        'notes' => 'nullable|string'
    ]);

    $order->update($validated);

    return redirect()->route('admin.orders.index')
        ->with('success', 'Catatan pesanan berhasil diupdate');
}

    public function destroy(Order $order)
    {
        // Return stock
        foreach ($order->orderItems as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil dihapus');
    }
}
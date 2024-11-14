<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Customer;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('customer', 'orderProducts.product')->get();
        $products = Product::all();
        $customers = Customer::all();

        return inertia('Orders/Index', compact('orders', 'products', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable',
            'order_date' => 'nullable|date',
            'products' => 'required|array',
        ]);

        $data = $request->all();
        $data['folio'] = rand(1000, 9999);

        $productIds = array_map(fn($p) => $p['id'], $data['products']);
        Product::whereIn('id', $productIds)->get(); // Valida que los productos existan

        $order = new Order($data);

        if ($data['customer_id']) {
            $customer = Customer::findOrFail($data['customer_id']);
            $order->customer()->associate($customer);
        }

        $order->save();

        foreach ($data['products'] as $productData) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $productData['id'];
            $orderProduct->tax = $productData['tax'];
            $orderProduct->price = $productData['price'];
            $orderProduct->quantity = $productData['quantity'];
            $orderProduct->save();
        }

        return to_route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return to_route('orders.index');
    }
}

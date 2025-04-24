<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index() {
        return response()->json(Order::all());
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        // Ambil data user
        $user = Http::get("http://localhost:8001/api/users/{$request->user_id}");
        if (!$user->ok()) return response()->json(['error' => 'User not found'], 404);

        // Ambil data produk
        $product = Http::get("http://localhost:8002/api/products/{$request->product_id}");
        if (!$product->ok()) return response()->json(['error' => 'Product not found'], 404);

        $productData = $product->json();
        $total = $productData['price'] * $request->quantity;

        $order = Order::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $total,
        ]);

        return response()->json($order, 201);
    }
    public function showDetail($id) {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Ambil data user
        $userResponse = Http::get("http://localhost:8001/api/users/{$order->user_id}");
        $userData = $userResponse->ok() ? $userResponse->json() : null;

        // Ambil data produk
        $productResponse = Http::get("http://localhost:8002/api/products/{$order->product_id}");
        $productData = $productResponse->ok() ? $productResponse->json() : null;

        return response()->json([
            'order' => $order,
            'user' => $userData,
            'product' => $productData,
        ]);
    }
}

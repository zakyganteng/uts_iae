<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index() {
        return response()->json(Product::all());
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|numeric'
        ]);

        $product = Product::create($request->only('name', 'description', 'stock', 'price'));
        return response()->json($product, 201);
    }

    // Contoh konsumsi data user dari UserService
    public function getUserFromUserService($userId) {
        $response = Http::get("http://localhost:8001/api/users/{$userId}");

        if ($response->successful()) {
            return $response->json();
        }

        return response()->json(['error' => 'User not found'], 404);
    }
}

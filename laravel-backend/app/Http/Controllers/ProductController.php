<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();

        return response()->json([
            'products' => $products,
            'method' => 'GET'
        ], 200);
    }

    public function getProductsById(Request $request)
    {
        $userId = $request->query('user_id');
        $products = Products::where('user_id', $userId)->get();

        return response()->json([
            'products' => $products,
            'method' => 'GET'
        ], 200);
    }

    public function show($id)
    {
        $product = Products::findOrFail($id);

        return response()->json([
            'product' => $product,
            'method' => 'GET'
        ], 200);
    }

    public function store(Request $request)
    {
        $product = Products::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'stocks' => $request->input('stocks'),
            'user_id' => $request->input('user_id'),
            'price' => $request->input('price')
        ]);

        return response()->json([
            'product' => $product,
            'method' => 'POST'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $product = Products::where('id', $id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'stocks' => $request->input('stocks'),
            'price' => $request->input('price')
        ]);

        return response()->json([
            'updated_rows' => $product,
            'method' => 'PUT'
        ], 200);
    }

    public function destroy($id)
    {
        $product = Products::where('id', $id)->delete();

        return response()->json([
            'deleted_rows' => $product,
            'method' => 'DELETE'
        ], 200);
    }
}

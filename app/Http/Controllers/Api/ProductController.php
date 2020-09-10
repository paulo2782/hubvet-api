<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\productResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return response(['data'=>productResource::collection($product)]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        return response(['data'=>productResource::collection($product)]);
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}

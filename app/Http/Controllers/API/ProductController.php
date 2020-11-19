<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $TotalperPage = 10;

    public function index(Request $request)
    {
        $products = Product::getResults($request->all(), $this->TotalperPage);

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product->fill($request->all());

        if(!$product->save()){
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($product, 201);
    }

    public function show($product)
    {
        $product = Product::find($product);

        if(empty($product)) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($product);
    }

    public function update(Request $request, $product)
    {
        $product = Product::find($product);
        if(!empty($product)) {
            $product->fill($request->all());

            if (!$product->save()) {
                return response()->json(['error' => 'Not found'], 404);
            }
        }

        return response()->json($product);
    }

    public function destroy($product)
    {
        $product = Product::find($product);
        if(!empty($product)) {
            $product->delete();
            return response()->json(['success' => 'register has been deleted'], 200);
        }

        return response()->json(['error' => 'Not found'], 404);
    }
}

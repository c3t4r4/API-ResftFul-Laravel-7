<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $TotalperPage = 10;

    public function index(Request $request)
    {
        $products = Product::getResults($request->all(), $this->TotalperPage);

        return response()->json($products);
    }

    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->fill($request->all());

        if(!$product->save()){
            return response()->json(['error' => 'Not found'], 404);
        }

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $product->image = url($request->image->store("products/{$product->id}/"));
            $product->save();
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

    public function update(ProductRequest $request, $product)
    {
        $product = Product::find($product);
        if(!empty($product)) {
            $oldImage = $product->image;
            $product->fill($request->all());

            if (!$product->save()) {
                return response()->json(['error' => 'Not found'], 404);
            }

            if($request->hasFile('image') && $request->file('image')->isValid()){

                if(!empty($oldImage) && Storage::exists("products/{$product->id}/{$oldImage}")){
                    Storage::delete("products/{$product->id}/{$oldImage}");
                }

                $product->image = url($request->image->store("products/{$product->id}/"));
                $product->save();
            }
        }

        return response()->json($product);
    }

    public function destroy($product)
    {
        $product = Product::find($product);
        if(!empty($product)) {
            if(Storage::exists("products/{$product->id}")){
                Storage::deleteDirectory("products/{$product->id}");
            }

            $product->delete();
            return response()->json(['success' => 'register has been deleted'], 200);
        }

        return response()->json(['error' => 'Not found'], 404);
    }
}

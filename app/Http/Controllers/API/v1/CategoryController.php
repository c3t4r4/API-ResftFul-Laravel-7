<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $TotalperPage = 10;

    public function index(Request $request)
    {
        $categories = Category::getResults($request->name);

        return response()->json($categories);
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category;
        $category->fill($request->all());

        if(!$category->save()){
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($category, 201);
    }

    public function show($category)
    {
        $category = Category::find($category);

        if(empty($category)) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($category);
    }

    public function update(CategoryRequest $request, $category)
    {
        $category = Category::find($category);
        if(!empty($category)) {
            $category->fill($request->all());

            if (!$category->save()) {
                return response()->json(['error' => 'Not found'], 404);
            }
        }

        return response()->json($category);
    }

    public function destroy($category)
    {
        $category = Category::find($category);
        if(!empty($category)) {
            $category->delete();
            return response()->json(['success' => 'register has been deleted'], 200);
        }

        return response()->json(['error' => 'Not found'], 404);
    }

    public function products($category)
    {
        $category = Category::find($category);

        if(empty($category)) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json([
            'category' => $category,
            'products' =>$category->products()->paginate($this->TotalperPage)
        ]);
    }
}

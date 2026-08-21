<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        if (Category::count() >= 4) {
            return response()->json(['message' => 'カテゴリは最大4個までです'], 422);
        }

        $category = Category::create([
            'name' => $request->input('name'),
            'color' => $request->input('color'),
        ]);

        return response()->json($category, 201);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'カテゴリが見つかりません'], 404);
        }

        $category->delete();

        return response()->json(null, 204);
    }
}

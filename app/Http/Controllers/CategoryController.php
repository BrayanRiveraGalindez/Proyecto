<?php

namespace App\Http\Controllers;

use App\Models\Category; // Importar el modelo de Categoría
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Category\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

	public function store(CategoryRequest $request)
    {
        $category = new Category($request->all());
        $category->save();
        return response()->json([], 201);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            DB::beginTransaction();
            $category->update(['name' => $request->name]);
            DB::commit();
            return response()->json([], 204);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([], 204);
    }
}

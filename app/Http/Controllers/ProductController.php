<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Category;

class ProductController extends Controller
{
	use UploadFile;

	public function home()
	{
		$categories = Category::get();
		$products = Product::with('category', 'file')
			->whereHas('category')
			->where('stock', '>', 0)
			->get();

		return view('index', compact('products','categories'));
	}

	public function index()
	{
		$categories = Category::get();
		$products = Product::with('category','file')->get();
		return view('products.index', compact('products','categories'));
	}

	public function category(Category $category) //Es metodo es para trear los productos por categoria
	{
    	$products = $category->products()->where('stock', '>', 0)->paginate(10);
   		 return view('products.category', compact('products', 'category'));
	}

	public function store(ProductRequest $request)
	{
		try {
			DB::beginTransaction();
			$product = new Product($request->all());
			$product->save();
			$this->uploadFile($product, $request);
			DB::commit();
			return response()->json([], 200);
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
	}

	public function show($id)
	{
		$product = Product::with('category', 'file')->findOrFail($id);
        return view('products.show', compact('product'));
		return response()->json(['product' => $product], 200);
	}

	public function update(ProductUpdateRequest $request, Product $product)
	{
		try {
			DB::beginTransaction();
			$product->update($request->all());
			$this->uploadFile($product, $request);
			DB::commit();
			return response()->json([], 204);
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
	}

	public function destroy(Product $product)
	{
		$product->delete();
		$this->deleteFile($product);
		return response()->json([], 204);
	}
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showCart()
    {
		$cartProducts = Product::all();
        return view('carts.show', ['products' => $cartProducts]);
    }
}

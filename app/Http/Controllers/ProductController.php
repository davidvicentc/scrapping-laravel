<?php

namespace App\Http\Controllers;
use App\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::paginate(20);

        $productsAlldiswashers = count(Product::where('category_id', 2)->get());
        $productsAllsmallappliance = count(Product::where('category_id', 1)->get());
        $total = count(Product::all());

        return view('index')
            ->with('products', $products)
            ->with('countDatasmall', $productsAllsmallappliance)
            ->with('countDatadiswashers', $productsAlldiswashers)
            ->with('total', $total);
    }
}

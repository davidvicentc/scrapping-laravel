<?php

namespace App\Http\Controllers;
use App\Product;
use App\User;

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
            ->with('title', 'home')
            ->with('total', $total);
    }

    public function test($id)
    {
        // Con esta linea de codigo ves la lista de productos que tienes en favorito :v
        $user = User::findOrfail($id)->products;

        // Con esta linea agregas la relaciones hay 4 tipos
            // 1: sync
            // 2: attach
            // 3: dettach
            // 4: syncwithoutdetaching
        $user_parte_dos = User::findOrfail($id)->products()->sync([258, 259, 260]);


        // SON 10 DOLARES PERRO :v

        return($user);
    }

    public function product($id) {
        $product = Product::find($id);
        $products = Product::paginate(4);


        return view('product')
        ->with('product', $product)
        ->with('products', $products)
        ;
    }

    public function dishwashers() {
        $dishwashers = Product::where('category_id', 2)->paginate(20);

        $productsAlldiswashers = count(Product::where('category_id', 2)->get());
        $productsAllsmallappliance = count(Product::where('category_id', 1)->get());
        $total = count(Product::all());

        return view('index')
            ->with('products', $dishwashers)
            ->with('countDatasmall', $productsAllsmallappliance)
            ->with('countDatadiswashers', $productsAlldiswashers)
            ->with('title', 'dishwashers')
            ->with('total', $total);
    }

    public function small_appliance() {
        $small_appliance = Product::where('category_id', 1)->paginate(20);

        $productsAlldiswashers = count(Product::where('category_id', 2)->get());
        $productsAllsmallappliance = count(Product::where('category_id', 1)->get());
        $total = count(Product::all());

        return view('index')
            ->with('products', $small_appliance)
            ->with('countDatasmall', $productsAllsmallappliance)
            ->with('countDatadiswashers', $productsAlldiswashers)
            ->with('title', 'small appliance')
            ->with('total', $total);
    }

}

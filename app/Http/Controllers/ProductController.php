<?php

namespace App\Http\Controllers;
use App\SmallAppliance;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = SmallAppliance::paginate(20);


        return view('index')->with('products', $products);;
    }
}

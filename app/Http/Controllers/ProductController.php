<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Product;
Use App\Models\Slider;

class ProductController extends Controller
{
    //
    function index(){
        $data = Product::all();
        $slider = Slider::all();
        return view('product', ['sliders' => $slider]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
class storeController extends Controller
{
    public function store(){
        $latestProducts= product::latest()->take(3)->get();
        // return $latestProducts;
        return view('store.index')->with('latestProducts', $latestProducts);
    }
    


 
}

<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use Stripe;
use App\product;
use App\cart;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(product $products)
    {
        return view('product.index')->with('products', product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $request->validate([
            'qty'=>'required|numeric|min:1'
        ]);
        $cart = new cart(session()->get('cart'));
        $cart->updateQty($product->id,$request->qty);
        session()->put('cart',$cart);
        return redirect()->back()->with('success','product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
       $cart = new cart(session()->get('cart'));
       $cart->remove($product->id);
       if ($cart->totalQty <= 0) {
           session()->forget('cart');
       }
       else {
           session()->put('cart',$cart);
        }
       return redirect()->back()->with('success','product removed successfully');
          }


          //////
    public function addToCart(product $product){
        if (session()->has('cart')) {
            $cart = new cart(session()->get('cart'));
        } else {
            $cart = new cart();
        }
        $cart->add($product);
        // dd($cart);
        session()->put('cart',$cart);
        return redirect()->route('product')->with('success','product added successfully');

    }
//////////
    public function ShowCart(){
        if (session()->has('cart')) {
            $cart = new cart(session()->get('cart'));
        }else {
            $cart= null;
        }

        return view('cart.index',compact('cart'));
    }

    public function CheckOut($amount){

        return view('cart.checkOut',compact('amount'));
    }

    public function Charge(request $request ){
        
    $charge = stripe::charges()->create([
        
            'currency' => 'USD',
            'source' => $request->stripeToken,
            'amount'   => $request->amount,
            'description' => ' Test from laravel new app'
        ]);

        $chargeID = $charge['id'];
    if ($chargeID) {
        auth()->user()->orders()->create([
            'cart'=> serialize(session()->get('cart'))
        ]);
        session()->forget('cart');
        Alert::success('success','Payment has DONE , Thank you for your trust in us');
        return redirect()->route('store');
        } else {
        return redirect()->route('store')->with(Alert::success('something went wrong', 'please try later or after few minutes'));

        }

    }
}

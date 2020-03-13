@extends('layouts.app')

@section('content')
<div class="container">
    <section>
@if( session()->has('success'))
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
                @endif
    <div class="row">
    @foreach($products as $product)
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src={{$product->image}}>
                <div class="card-body">
                    <h5 class="card-title">{{$product->title}}</h5>
                    <p class="card-price">$ {{$product->price}}</p>
                    <a href="{{route('Cart.add',$product->id)}}" class="btn btn-primary">buy</a>

                </div>
         </div>  
        
        </div>

    @endForeach
    </div>
 </section>
</div>
@endSection

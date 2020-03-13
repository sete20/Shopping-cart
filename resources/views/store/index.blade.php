@extends('layouts.app')

@section('content')
<div class="container">
<!-- {(session()get('cart')) -->

    <section>
    @if( session()->has('success'))
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
                @endif
        <div class="jumbotron">
            <h1 class="display-4"> Our customer</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="{{route('product')}}" role="button">All Products</a>
            </p>
    </div>
    </section>
 <section>
    <div class="row">
    @foreach($latestProducts as $product)
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

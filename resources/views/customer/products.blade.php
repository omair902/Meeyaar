@extends('layouts.customer')
@section('title','Products')
@section('content')
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active">Product List</li>
        </ul>
    </div>
</div>
<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4">
                            <div class="product-item">
                                <div class="product-title">
                                    <a href="#">{{$product->title}}</a>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="#">
                                        <img src="{{asset('product_images/'.$product->image[0]->image)}}" alt="Product Image">
                                    </a>
                                    <div class="product-action">
                                        <a href="#"><i class="fa fa-cart-plus"></i></a>
                                        <a href="#"><i class="fa fa-heart"></i></a>
                                        <a href="#"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h3><span>RS</span> {{$product->price}}</h3>
                                    <a class="btn" href="{{route('customer.products.order',$product->id)}}"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination Start -->
                <div class="col-md-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            {{$products->links()}}
                        </ul>
                    </nav>
                </div>
                <!-- Pagination Start -->
            </div>         
        </div>
    </div>
</div>
@endsection
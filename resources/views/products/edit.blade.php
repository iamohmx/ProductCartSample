@extends('layouts.app')
@section('title', 'Edit Products')
@section('content')
    <div class="text-center">
        <h1>Edit Product</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="product_name">ชื่อสินค้า</label>
                        <input class="form-control" id="product_name" type="text" name="name" value="{{ $product->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="product_price">ราคาสินค้า</label>
                        <input class="form-control" id="product_price" type="number" name="price" value="{{ $product->price }}">
                    </div>
                    <button type="submit" class="btn btn-success">Edit Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection
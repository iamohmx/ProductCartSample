@extends('layouts.app')
@section('title', 'Add Products')
@section('content')
    <div class="text-center">
        <h1>Create Product</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="product_name">ชื่อสินค้า</label>
                        <input class="form-control" id="product_name" type="text" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="product_price">ราคาสินค้า</label>
                        <input class="form-control" id="product_price" type="number" name="price">
                    </div>
                    <button type="submit" class="btn btn-success">Add Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection
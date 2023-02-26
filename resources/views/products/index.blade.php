@extends('layouts.app')
@section('title', 'Products')
@section('content')
    <div class="text-center">
        <h1>Hello <b>{{ Auth::user()->name }}</b> </h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('products.create') }}" class="btn btn-success mb-3">เพิ่มสินค้า</a>
                <div class="row">
                    @foreach ($products as $item)
                        <div class="col-md-4">
                            <form action="{{ route('orders.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <div class="card p-3">
                                    <h4>ชื่อสินค้า {{ $item->name }}</h4>
                                    <p>ราคา {{ $item->price }}</p>
                                    <button type="submit" class="btn btn-secondary">Buy</button>
                                </div>
                            </form>
                            <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning mt-2">Edit</a>
                            <form action="{{ route('products.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"
                                    onclick="confirm('Do you want to delete?')">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

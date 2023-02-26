@extends('layouts.app')
@section('title', 'Orders')
@section('content')
    <div class="text-center">
        <h1>Hello Orders</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($order)
                            @foreach ($order->order_details as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->amout }}</td>
                                    <td>
                                        <div class="row text-center">
                                            <div class="col-md-6">
                                                <form action="{{ route('orders.update', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" value="decrease" name="value">
                                                    <input type="hidden" value="{{ $item->product_id }}" name="product_id">
                                                    <button type="submit" class="btn btn-outline-danger">-</button>
                                                </form>
                                            </div>
                                            <div class="col-md-6">
                                                <form action="{{ route('orders.update', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" value="increase" name="value">
                                                    <input type="hidden" value="{{ $item->product_id }}" name="product_id">
                                                    <button type="submit" class="btn btn-outline-success">+</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $order->total }}</td>
                                <td class="text-center">
                                    <form action="{{ route('orders.update', $order->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" value="checkout" name="value">
                                        <button type="submit" class="btn btn-primary">Checkout</button>
                                    </form>
                                </td>
                        @endif

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::where('user_id', Auth::id())->where('status', 0)->first();
        return view('orders.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        $order = Order::where('user_id', Auth::id())->where('status', 0)->first();
        if ($order) {
            $orderDetail = $order->order_details()->where('product_id', $product->id)->first();
            if ($orderDetail) {
                $amoutNew = $orderDetail->amout + 1;
                $orderDetail->update([
                    'amout' => $amoutNew
                ]);
            } else {

                $prepareDetail = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'amout' => 1,
                    'price' => $product->price,
                ];
                $orderDetail = OrderDetail::create($prepareDetail);
            }
        } else {
            $prepareCart = [
                'status' => 0,
                'user_id' => Auth::id()
            ];

            $order = Order::create($prepareCart);

            $prepareDetail = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'amout' => 1,
                'price' => $product->price,
            ];
            $orderDetail = OrderDetail::create($prepareDetail);
        }
        $totalRaw = 0;
        $total = $order->order_details->map(function ($orderDetail) use ($totalRaw){
            $totalRaw += $orderDetail->amout * $orderDetail->price;
            return $totalRaw;
        })->toArray();
        // dd(array_sum($total));
        $order->update([
            'total' => array_sum($total),
        ]);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $orderDetail = $order->order_details()->where('product_id', $request->product_id)->first();
        if($request->value == "checkout") {
            $order->update([
                'status' => 1
            ]);
        } else {
            if ($orderDetail) {
                if($request->value == "increase"){
                    $amoutNew = $orderDetail->amout + 1;
                } else {
                    $amoutNew = $orderDetail->amout - 1;
                }
                $orderDetail->update([
                    'amout' => $amoutNew
                ]);
            }
        }

        $totalRaw = 0;
        $total = $order->order_details->map(function ($orderDetail) use ($totalRaw){
            $totalRaw += $orderDetail->amout * $orderDetail->price;
            return $totalRaw;
        })->toArray();
        $order->update([
            'total' => array_sum($total),
        ]);
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}

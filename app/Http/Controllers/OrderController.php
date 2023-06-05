<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new OrderCollection(Order::with('user')->with('products')->where('status', 0)->orderBy('id', 'DESC')->get()); 
    }

    public function ordersOut()
    {
        return new OrderCollection(Order::with('user')->with('products')->where('status', 1)->orderBy('id', 'DESC')->get()); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Save order 
        $order = new Order;
        $order->user_id = Auth::user()->id;  
        $order->total = $request->total; 
        $order->save(); 

        //get id from order 
        $id = $order->id; 

        //get products from order 
        $products = $request->products; 

        // format array 
        $order_product = []; 
        foreach ($products as $product) {
            $order_product[] = [
                'order_id' => $id,
                'product_id' => $product['id'],
                'amount' => $product['amount'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        //save BD

        OrderProduct::insert($order_product); //Insert permite ingresar o almacenar un arreglo 

        return [
            'message' => 'Pedido Realizado Correctamente',
        ]; 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->status = 1; 
        $order->save(); 

        return [
            'Order' => $order
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete(); 
        return [
            "message" => "Orden Eliminada"
        ];
    }
}

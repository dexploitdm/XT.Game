<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OrderController extends Controller
{
    //Mock Payment API
    public function payment(Request $request, $price) {
        //Mock data
        $uid = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 20);
        return $uid;
    }

    public function store(Request $request) {
        $order = new Order();

        $order->uid_payment = $request->uid_payment;
        $order->total_price = $request->total_price;
        $area = json_encode($request->game_list);
        $order->game_list = $area;
        $order->user_id = $request->user()->id;
        $order->user = $request->user();
        $order->save();
        return Redirect::route('orders')->with('message', 'Заказ размещен. Ожидайте выполнения!');
    }

    public function getOrdersUser() {
        $order = Order::where('user_id', Auth::id())
            ->take(10)
            ->get();
       return response()->json($order);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index() {
        $orders = Order::orderBy('id', 'desc')
            ->paginate(6);

        return \inertia('lk/orders/list',[
            'orders' => $orders
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->code = $request->code;
        $order->active = 0;
        $order->save();
        return Redirect::route('orders.index')->with('message', 'Код выдан, заказ закрыт!');
    }
}

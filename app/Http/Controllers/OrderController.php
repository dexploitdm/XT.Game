<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OrderController extends Controller
{
    //Mock Payment API
    public function payment(Request $request, $price) {

        //Mock data
        $uid = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 20);
        return $uid;
//        return redirect()->route('orders')->with('message', 'My message');

        //return Redirect::route('dashboard');
    }

    public function store(Request $request) {
        $order = new Order();

        //Сохранение ордера
        $order->uid_payment = $request->uid_payment;
        $order->total_price = $request->total_price;
        $area = json_encode($request->game_list);
        $order->game_list = $area;
        $order->user_id = $request->user()->id;
        $order->save();
        return Redirect::route('orders')->with('message', 'Заказ размещен. Ожидайте выполнения!');
    }
}

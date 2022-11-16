<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
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

    /**
     * Search resource.
     * @param \App\Models\Order $orders_pay
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchOrdersByUID(Request $request) {
        $orders_pay = Order::query()
            ->when($request->input('search'), function ($query, $search) {
                $query->where('uid_payment', 'like', '%' . $search . '%');
            })->paginate(8)
            ->withQueryString();

        return response()->json($orders_pay);
    }
}

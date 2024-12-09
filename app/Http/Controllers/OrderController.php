<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    public function store(Request $request) {
        $order = Order::create($request->all());
        if (!$order) {
            return response()->json('error', 500);
        }
        return response()->json($order,201);
    }

    public function show($id) {
        $order = Order::find($id);
        return response()->json($order,200);
    }

    public function destroy($id) {
        $order = Order::find($id);
        $order->delete();
        return response()->json($order,200);
    }
}

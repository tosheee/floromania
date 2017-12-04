<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.dashboard')->with('orders', $orders)->with('title', 'Всички поръчки');
    }

    public function not_completed_orders()
    {
        $orders = Order::where('completed_order', false)->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.dashboard')->with('orders', $orders)->with('title', 'Не завършени поръчки');
    }

    public function viewOffer($id)
    {
        $order = Order::find($id);

        return view('admin.view_offer')->with('order', $order)->with('title', 'Преглед на поръчка');
    }

    public function completedOrder($id)
    {
        $order = Order::find($id);

        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        if ($order->completed_order == 1)
        {
            $order->completed_order = 0;
        }
        else
        {
            $order->completed_order = 1;
        }

        $order->save();
        return redirect()->back()->with('orders', $orders)->with('order', $order)->with('success', 'Поръчката е маркиране')->with('title', 'Преглед на поръчка');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return view('admin.dashboard')->with('success', 'Поръчката е изтрита')->with('title', 'Всички Поръчки');
    }
}

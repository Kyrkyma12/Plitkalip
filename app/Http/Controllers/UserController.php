<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(12);
        return view('user.orders', compact('orders'));
    }

    public function orderDetails($order_id)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $order_id)->first();
        if($order)
        {
            $orderItems = OrderItem::where('order_id', $order->id)->orderBy('id')->paginate(12);
            $transaction = Transaction::where('order_id', $order->id)->first();
            return view('user.order-details', compact('order', 'orderItems', 'transaction'));
        }
        else
        {
            return redirect()->route('login');
        }
    }

    public function orderCancel(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = 'canceled';
        $order->canceled_date = Carbon::now();
        $order->save();
        return back()->with('status', 'order has been cancelled successfully!');
    }
    public function getFormattedMobileAttribute()
    {
        if (!$this->mobile) return null;

        $num = $this->mobile;
        if (strlen($num) === 11 && $num[0] === '7') {
            $num = substr($num, 1);
        }
        return preg_replace('/(\d{3})(\d{3})(\d{2})(\d{2})/', '7-$1-$2-$3-$4', $num);
    }

// Для сохранения в едином формате
    public function setMobileAttribute($value)
    {
        // Сохраняем только цифры с ведущей 7
        $this->attributes['mobile'] = '7' . preg_replace('/[^0-9]/', '', $value);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\ProductSize;
use App\ItemOrder;
use App\User;
use Auth;
use DB;
use Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user');
    }

    public function userDashboard() {
        $user_id = Auth::user()->id;
        $pendingOrders =DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('statuses', 'statuses.id', '=', 'orders.status_id')
        ->where('status_id', 1)
        ->where('user_id', $user_id)
        ->select('orders.*', 'statuses.name AS status_name', 'users.name AS user_name')
        ->get();
        // dd($pendingOrders);

        $countCompletedOrders = Order::where('status_id', 2)->where('user_id', $user_id)->count();
        // $pendingOrders = Order::where('status_id', 1)->get();
        $countPendingOrders = Order::where('status_id', 1)->count();

        if(Session::has('cart')) {
            $cartItems = Session::get('cart');
            // return $cartItems;
            $countCartItems = count(Session::get('cart'));
            // return $countCartItems;
            return view('pages.user.user_dashboard', compact('countCompletedOrders', 'pendingOrders', 'countPendingOrders', 'countCartItems'));
        }

        $countCartItems = 0;
        return view('pages.user.user_dashboard', compact('countCompletedOrders', 'pendingOrders', 'countPendingOrders', 'countCartItems'));
    }

    public function userProfile() {
        return view('pages.user.user_profile');
    }

    public function userTransactions() {
        $user_id = Auth::user()->id;
        $orders =DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('statuses', 'statuses.id', '=', 'orders.status_id')
        ->where('user_id', $user_id)
        ->select('orders.*', 'statuses.name AS status_name')
        ->orderBy('orders.created_at')
        ->get();
        // dd($orders);

        return view('pages.user.user_transactions', compact('orders'));
    }

    public function cancelOrder($id) {
        $order = Order::find($id);
        $order->status_id = 3;
        $order->save();

        Session::flash('success', "Order $order->transaction_id successfully deleted");
        return redirect('/user/dashboard');
    }

    public function userShowOrder($id) {
        $user_id = Auth::user()->id;
        // $orders = ItemOrder::all()->where('order_id', $id);

        $orderDetails =DB::table('orders')
        ->join('item_orders', 'item_orders.order_id', '=', 'orders.id')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('products', 'products.id', '=', 'item_orders.product_id')
        ->where('user_id', $user_id)
        ->where('order_id', $id)
        ->select('item_orders.*', 'orders.transaction_id', 'products.name AS product_name')
        ->get();
        // dd($orderDetails);
        return view('pages.user.user_show_order', compact('orderDetails'));
    }

    public function editName($id, Request $request) {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->save();

        Session::flash('success', "Name successfully updated to $request->name");
        return back();
    }
}


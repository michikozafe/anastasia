<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Order;
use App\Category;
use App\Status;
use DB;
use Session;
use App\ProductSize;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function adminDashboard() {
        $pendingOrders =DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('statuses', 'statuses.id', '=', 'orders.status_id')
        ->where('status_id', 1)
        ->select('orders.*', 'statuses.name AS status_name', 'users.name AS user_name')
        ->get();
        $users = User::where('role', 'user')->get();
        $countCompletedOrders = Order::where('status_id', 2)->count();
        $availableProducts = DB::table('product_sizes')->sum('quantity');
        $countPendingOrders = Order::where('status_id', 1)->count();
        return view('pages.admin.admin_dashboard', compact('users', 'countCompletedOrders', 'pendingOrders', 'availableProducts', 'countPendingOrders'));
    }

    public function adminProfile() {
        return view('pages.admin.admin_profile');
    }

    public function adminProducts() {
        $products = Product::all();
        return view('pages.admin.admin_products', compact('products'));
    }

    public function adminTransactions() {
        $orders =DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('statuses', 'statuses.id', '=', 'orders.status_id')
        ->select('orders.*', 'statuses.name AS status_name', 'users.name AS user_name')
        ->get();
        return view('pages.admin.admin_transactions', compact('orders'));
    }

    public function restorePage() {
        $trashedProducts = Product::onlyTrashed()->get();
        $countTrashedProducts = count($trashedProducts);
        return view('pages.admin.restore_products', compact('trashedProducts', 'countTrashedProducts'));
    }

    public function restore($id) {
        $product = Product::onlyTrashed()
        ->where('id', $id)
        ->restore();

        Session::flash('success', "Product successfully restored");
        return redirect('/admin/products');
    }

    public function deleteTrashItem($id){
        $product = Product::withTrashed()->find($id);
        $product->forceDelete();
        Session::flash('success', "$product->name successfully deleted");
        return redirect('/admin/products/restore');
    }

    public function adminUsers() {
        $users = User::where('role', 'user')->get();
        return view('pages.admin.admin_users', compact('users'));
    }

    public function adminInventory() {
        $inventories = DB::table('product_sizes')
        ->join('sizes', 'sizes.id', '=', 'product_sizes.size_id')
        ->join('products', 'products.id', '=', 'product_sizes.product_id')
        ->select('product_sizes.*', 'products.name AS product_name', 'sizes.name AS size_name')
        ->get();

        return view('pages.admin.admin_inventory', compact('inventories'));
    }

    public function approveOrder($id) {
        $order = Order::find($id);
        $order->status_id = 2;
        $order->save();
        Session::flash('success', "Order $order->transaction_id successfully approved");
        return redirect ('/admin/dashboard');
    }

    public function cancelOrder($id) {
        $order = Order::find($id);
        $order->status_id = 3;
        $order->save();


        Session::flash('success', "Order $order->transaction_id successfully deleted");
        return redirect ('/admin/dashboard');
    }

    public function search(Request $request) {
        $products = Product::where('name','LIKE','%'.$request->keyword.'%')->get();
        return view('pages.admin.admin_products', compact('products'));
    }

    public function filterByStatus($id) {
        $status = Status::find($id);
        $orders = $status->products;

        return view('pages.admin.admin_transactions');
    }

    public function deleteUser($id) {
        $user = User::find($id);
        $user->delete();
        Session::flash('success', "$user->name successfully deleted");
        return redirect('/admin/users');
    }

    public function adminShowOrder($id) {
        $orderDetails =DB::table('orders')
        ->join('item_orders', 'item_orders.order_id', '=', 'orders.id')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('products', 'products.id', '=', 'item_orders.product_id')
        ->where('order_id', $id)
        ->select('item_orders.*', 'orders.transaction_id', 'products.name AS product_name')
        ->get();
        // dd($orderDetails);
        return view('pages.admin.admin_show_order', compact('orderDetails'));
    }

}



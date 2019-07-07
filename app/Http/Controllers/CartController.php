<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Product;
use App\Size;
use App\Order;
use Auth;
use App\ItemOrder;
use App\ProductSize;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(Session::has('cart')) {
            $cartItems = Session::get('cart');
            // return $cartItemsSession;
            $countCartItems = count($cartItems);

            $total = 0;
            foreach ($cartItems as $cartItem) {
                $total += $cartItem['total'];
            }
            return view("pages.user.cart", compact('cartItems', 'countCartItems', 'total'));
        }
        return view("pages.user.cart");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addToCart($id, Request $request) {
        $this->validate($request, [
            'daysRented' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'size' => 'required',
        ]);
        // $cart = Session::forget('cart');
        // return $cart;
        $cart = [];

        if (Session::has('cart')) {
            $cart = Session::get('cart');
        };

        $cartItem = $request->all();
        $request->price = str_replace(",", "", $request->price);
        $cartItem["id"] = \Str::uuid();
        $cartItem["product_id"] = (int)$id;
        $cartItem["total"] = $request->price * $request->quantity;
        $cartItem['name'] = $request->name;
        $cartItem['available'] = $request->available;


        $cartCollection = collect($cart);
        $isProductUnavailable = false;

        foreach ($cart as $existingCartItem) {
            if ($existingCartItem["product_id"] === $cartItem["product_id"] && $existingCartItem["size"] === $cartItem["size"]) {
                if ($existingCartItem["available"] < ($existingCartItem["quantity"] + $cartItem["quantity"])) {
                    $isProductUnavailable = true;
                }
            }
        }

        if ($isProductUnavailable && count($cart) > 0) {
            Session::flash('error', "Exceeded Maximum Quantity. Check Cart Items & Available Stock!");
            return back();
        }

        $isProductExisting = $cartCollection->contains(function($product, $key) use ($cartItem) {
            return $product["product_id"] === $cartItem["product_id"] && $product["size"] === $cartItem["size"] && $product["price"] === $cartItem["price"];
        });

        if ($isProductExisting) {
            $cartCollection = $cartCollection->map(function($product, $key) use ($cartItem) {
                if ($product["product_id"] === $cartItem["product_id"] && $product["size"] === $cartItem["size"] && $product["price"] === $cartItem["price"]) {
                    $product["quantity"] += $cartItem["quantity"];
                }
                return $product;
            });
        } else {
            $cartCollection->push($cartItem);
        }

        Session::put('cart', $cartCollection);
        // return $cartCollection;
        $product = Product::find($id);
        Session::flash('success', "$request->quantity of $product->name has been successfully added to your cart!");

        // return array_sum(Session::get('cart'));
        // return Redirect::back();
        // return $cart;
        return redirect('/user/cart');
    }


    public function emptyCart() {
        Session::forget('cart');
        Session::flash('success', 'Your cart is now empty!');
        return redirect('/collections');
    }

    public function deleteCartItem ($id) {
        $cart = Session::get('cart');
        $cartCollection = collect($cart);
        $itemToDeleteIndex = $cartCollection->search(function ($item, $key) use ($id) {
            return (string)$item["id"] === $id;
        });
        $deletedItem = $cartCollection->pull($itemToDeleteIndex);
        $cartCollection->forget($itemToDeleteIndex);
        // dd($deletedItem["product_id"]);
        Session::put('cart', $cartCollection);

        $product = Product::find($deletedItem["product_id"]);
        Session::flash('success', "$product->name was successfully deleted!");
        $countCartCollection = count($cartCollection);
        if ($countCartCollection > 0) {
            return back();
        } else {
            Session::forget('cart');
            return back();
        }
    }

    public function editCart($id, Request $request) {
        $this->validate($request, [
            'quantity' => 'required'
        ]);

        $input = $request->all();
        $input["price"] = str_replace(",", "", $input["price"]);
        $cart = Session::get('cart');
        $cartCollection = collect($cart);
        // return $input;

        $editedCart = $cartCollection->map(function ($cartItem, $key) use ($input, $id) {
            if ((string) $cartItem["id"] === $id) {
                $cartItem["quantity"] = $input["quantity"];
                $cartItem["total"] = $input["price"] * $input["quantity"];
            }

            return $cartItem;
        });
        Session::put('cart', $editedCart);
        Session::flash('success', "Changed quantity to $request->quantity!");
        return back();

    }

    public function generate_transaction_code() {
        $ref_number = "";
        $source = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F"];

        for($i = 0; $i < 6; $i++) {
          $index = rand(0, 15);
          $ref_number .= $source[$index];
        }
        $today = getdate();

        return $ref_number . "-" . $today[0];
      }

      public function checkout()
    {
        $cartItems = Session::get('cart');
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $productSize = Size::where('name', '=', $cartItem["size"])->first();
            // dd($cartItem);
            $productItem = ProductSize::where('product_id', '=', $cartItem["product_id"])->where('size_id', '=', $productSize->id)->first();
            // return $productItem;
            if ($productItem !== null) {
                $product_sizes = $productItem;
                $product_sizes->size_id = $productSize->id;
                $product_sizes->product_id = $cartItem['product_id'];
                $product_sizes->quantity = $productItem->quantity - $cartItem['quantity'];
                $product_sizes->save();
                // dd($product_sizes->quantity);
            } else {
                echo "Product Does Not Exist!";
            }

            $total += $cartItem['total'];
        }

        $order = new \App\Order;
        $order->user_id = Auth::user()->id;
        $order->total = $total;
        $order->status_id = 1;
        $order->transaction_id = $this->generate_transaction_code();
        $order->save();

        // dd($order);


        // dd(gettype($cartItem['price']));
        foreach ($cartItems as $cartItem) {
            $item_order = new \App\ItemOrder;
            $item_order->order_id = $order->id;
            $item_order->product_id = $cartItem['product_id'];
            $item_order->price = $cartItem['price'];
            $item_order->size = $cartItem['size'];
            $item_order->days_rented = $cartItem['daysRented'];
            $item_order->quantity = $cartItem['quantity'];
            $item_order->save();
        }

        $productToDelete = ProductSize::where('quantity', 0);
        $productToDelete->delete();

        Session::forget('cart');
        Session::flash('success', 'Checkout Complete!');
        return redirect('/collections');
    }
}

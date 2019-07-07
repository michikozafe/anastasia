<?php

namespace App\Http\Controllers;
use Auth;
use App\Favorite;
use Session;
use DB;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user');
    }

    public function addFavorites($id) {
        // dd($request);
        $favorites = Favorite::all();
        // dd($favorites);
        $user_id = Auth::user()->id;
        $product_id = $id;

        foreach($favorites as $favorite) {
            if($favorite->user_id == $user_id && $favorite->product_id == $product_id) {
                Session::flash('error', "Product is already saved in your favorites");
                return back();
            }
        }

        $favorite = new Favorite;
        $favorite->user_id = $user_id;
        $favorite->product_id = $id;
        $favorite->save();

        $product = DB::table('favorites')
        ->join('products', 'products.id', '=', 'favorites.product_id')
        ->join('users', 'users.id', '=', 'favorites.user_id')
        ->select('products.name AS product_name', 'favorites.*')
        ->where('user_id', $user_id)
        ->where('products.id', $id)
        ->first();
        // dd($product->product_name);
        Session::flash('success', "$product->product_name successfully added to favorites");
        return  back();
    }

    public function showFavorites() {
        $user_id = Auth::user()->id;
        $favorites = DB::table('favorites')
        ->join('products', 'products.id', '=', 'favorites.product_id')
        ->join('users', 'users.id', '=', 'favorites.user_id')
        ->select('products.name AS product_name', 'favorites.*')
        ->where('user_id', $user_id)
        ->get();
        // dd($favorites);
        return view('pages.user.favorites', compact('favorites'));
    }

    public function deleteFavorite($id) {
        $user_id = Auth::user()->id;
        $favorite = Favorite::find($id);
        $product = DB::table('favorites')
        ->join('products', 'products.id', '=', 'favorites.product_id')
        ->join('users', 'users.id', '=', 'favorites.user_id')
        ->select('products.name AS product_name', 'favorites.*')
        ->where('user_id', $user_id)
        ->where('favorites.id', $id)
        ->first();
        // dd($product->product_name);
        $favorite->delete();
        Session::flash('success', "$product->product_name removed from favorites successfully!");
        return back();
    }
}

@extends('layouts.app')

@section('content')

    <div class="row">
        @include('includes.user.user_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <h2 class="text-center text-uppercase header-color font-weight-bold">Cart</h2>
            @if(Session::has('cart'))
            <div class="float-right mb-2">
                @if(count($cartItems) > 0)
                    <button data-toggle="modal" data-target="#deleteCartModal" class="btn btn-main mx-1 btn-lg">Empty Cart</button>
                    <a href="/user/cart/checkout" class="btn btn-main mx-1 btn-lg">Checkout</a>
                @endif
            </div>
            @endif
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Days Rented</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(Session::has('cart'))
                        @foreach ($cartItems as $cartProduct)
                            <tr>
                                <td>{{$cartProduct["name"]}}</td>
                                <td>{{$cartProduct["daysRented"]}}</td>
                                <td>{{$cartProduct["size"]}}</td>
                                <td>&#8369; {{$cartProduct["price"]}}</td>
                                <td>
                                    <form action="/user/cart/{{$cartProduct["id"]}}/edit" method="POST">
                                        @csrf
                                        <input type="hidden" name="price" value="{{$cartProduct["price"]}}">
                                        <input class="w-30 text-center" type="number" min="1" name="quantity" value="{{$cartProduct["quantity"]}}" max="{{$cartProduct["available"]}}">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </form>
                                </td>
                                <td>&#8369; {{number_format($cartProduct["total"])}}</td>
                                <td>
                                    <a class="btn btn-danger" href="/user/cart/{{$cartProduct["id"]}}/delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="5" class="text-right header-style font-weight-bold">TOTAL:</td>
                                <td class="header-style font-weight-bold">&#8369; {{number_format($total)}}</td>
                            </tr>
                    @else
                        <tr>
                            <td colspan="7">
                                <div class="jumbotron">
                                    <h3 class="text-center">Your cart is empty </h3>
                                </div>
                            </td>
                        </tr>
                    @endif
                    <div>
                        <a href="/collections" class="btn btn-main btn-lg mb-3">Shop Now!</a>
                    </div>

                </tbody>
            </table>
        </main>
    </div>

    @if(Session::has('cart'))
    <!-- Empty Cart Modal -->
    <div class="modal fade" id="deleteCartModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase">Empty Cart</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="deleteModalBody">
                Are you sure you want to empty your cart?
            </div>
            <div class="modal-footer">
                <a href="/user/cart/emptyCart" class="btn btn-main mx-1 btn-lg">Empty Cart</a>
            </div>
            </div>
        </div>
    </div>

    <!-- Delete Cart Item Modal -->
    <div class="modal fade" id="deleteCartItemModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase">Delete Cart Item</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="deleteCartItemModalBody">
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row">
                    <form method="get" id="deleteCartItemForm">
                        @csrf
                        {{ method_field('DELETE')}}
                        <button class="btn btn-danger"
                        type="submit">Delete Item</button>
                    </form>
                    <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    @endif
@endsection

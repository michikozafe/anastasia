@extends('layouts.app')

@section('content')
    <div class="row mb-5" id="collection-item">
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="/{{$product->img_path}}" width="390" height="480">
        </div>
        <div class="col-md-7">
            <h3 class="text-center header-style text-uppercase header-font-size">{{$product->name}}</h3>
            @auth
                @if (Auth::user()->role == 'user')
                    <a class="btn btn-main float-right" href="/user/favorites/{{$product->id}}">Add to Favorites</a>
                @endif
            @endauth
            <p class="mb-0 header-color">Description:</p>
            <p>{{$product->description}}</p>
            <p><span class="header-color">Price:</span>&#8369; {{$product->price}} per day</p>
            <p class="header-color final-price">&#8369;{{$price}} for {{$daysRented}} days</p>
            <p class="d-inline align-items-center">Rent for how many days?
                <form method="POST" class="d-inline" id="updateDaysRented">
                    @csrf
                    <div class="d-flex align-items-center">
                        <div class="input-group-prepend d-inline">
                            <button class="btn input-group-text rounded-0 d-inline operatorBtns" onclick="minusDaysRented({{$product->id}})">
                                <img src="{{asset('images/minus.png')}}" height="15">
                            </button>
                        </div>
                        <input type="number" name="daysRented" class="input daysRented{{$product->id}} d-inline" min="1" value="{{isset($daysRented) ? $daysRented : 0}}" required>
                        <div class="input-group-append d-inline">
                            <button class="btn input-group-text rounded-0 d-inline operatorBtns" onclick="plusDaysRented({{$product->id}})">
                                <img src="{{asset('images/plus.png')}}" height="15">
                            </button>
                        </div>
                    </div>
                </form>
            </p>
            <p class="mb-0 header-color">Select Your Size</p>
            @if (count($product->sizes) > 0)
            <form action="/user/cart/{{$product->id}}/add" method="POST">
                @csrf
                <input type="hidden" name="daysRented" value="{{$daysRented}}">
                <input type="hidden" name="price" value="{{$price}}">
                <input type="hidden" name="name" value="{{$product->name}}">
                @foreach ($product->sizes as $size)
                <input type="radio" name="size" id="size{{$size->id}}" value="{{$size->name}}" data-stock="{{$size->pivot->quantity}}" onclick="availableStock({{$size->id}})"> {{$size->name}}: {{$size->pivot->quantity}}pc/s available <br>
                @endforeach
                <br>
                @auth

                    @if (Auth::user()->role == 'user')
                        <label for="quantity" class="primary-color">Quantity: </label>
                        <div class="d-flex align-items-center">
                            <div class="input-group-prepend d-inline">
                                <button type="button" class="btn input-group-text rounded-0 d-inline operatorBtns" onclick="minusProductQuantity({{$product->id}})">
                                    <img src="{{asset('images/minus.png')}}" height="15">
                                </button>
                            </div>
                            <input type="hidden" name="available" id="available">
                            <input type="number" name="quantity" id="quantity" class="d-inline input quantity{{$product->id}}" min="1" value="0" required>
                            <div class="input-group-append d-inline">
                                <button type="button" class="btn input-group-text rounded-0 d-inline operatorBtns" onclick="plusProductQuantity({{$product->id}})">
                                    <img src="{{asset('images/plus.png')}}" height="15">
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-collection-item mt-3">Reserve Now</button>
                    @endif
                @endauth
            </form>

            @else
            <button type="disabled" class="btn btn-block btn-collection-item mt-3">Out Of Stock</button>
            @endif
        </div>
    </div>
@endsection

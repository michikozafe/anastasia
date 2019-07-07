@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.admin.admin_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <a href="/admin/transactions" class="btn btn-main float-left">Back to Transactions</a>
            <h2 class="text-center text-uppercase header-color font-weight-bold">Order Details</h2>
            <table class="table text-center mt-4">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Days Rented</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderDetails as $orderDetail)
                    <tr>
                        <td>{{$orderDetail->transaction_id}}</td>
                        <td>{{$orderDetail->product_name}}</td>
                        <td>&#8369; {{$orderDetail->price}}</td>
                        <td>{{$orderDetail->size}}</td>
                        <td>{{$orderDetail->days_rented}}</td>
                        <td>{{$orderDetail->quantity}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>
@endsection

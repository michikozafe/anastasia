@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.admin.admin_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <h2 class="text-center text-uppercase header-color font-weight-bold">Transactions</h2>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Ordered By</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td><a href="/admin/order/{{$order->id}}/show" class="text-decoration-none">{{$order->transaction_id}}</a></td>
                        <td>{{$order->user_name}}</td>
                        <td>&#8369; {{number_format($order->total)}}</td>
                        <td class="text-uppercase">{{$order->status_name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.user.user_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 mb-5">
            <h2 class="text-center text-uppercase header-color font-weight-bold">Transactions</h2>
            {{-- {{count($orders)}} --}}
            <table class="table text-center mt-4">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Order Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($orders) > 0)
                        @foreach ($orders as $order)
                            <tr>
                                <td><a class="text-decoration-none" href="/user/order/{{$order->id}}/show">{{$order->transaction_id}}</a></td>
                                <td>{{Carbon\Carbon::parse($order->created_at)->format('M j, Y')}}</td>
                                <td>&#8369; {{number_format($order->total)}}</td>
                                <td class="text-uppercase">{{$order->status_name}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">
                                <div class="jumbotron">
                                    <h3 class="text-center">
                                        No Orders Found.
                                    </h3>
                                </div>
                            </td>
                        </tr>
                        <div>
                            <a href="/collections" class="btn btn-main btn-lg">Shop Now!</a>
                        </div>
                    @endif
                </tbody>
            </table>
        </main>
    </div>
@endsection

@extends('layouts.app')

@section('content')

    <div class="row">
        @include('includes.user.user_navbar')

        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="align-items-center">
            <h1 class="h2 border-bottom mb-3 pb-2 header-color">DASHBOARD <small class="float-right dashboard-date">Today is <span class="header-color font-weight-bold" id="time"></span></small></h1>

            {{-- Dashboard Tiles --}}
            <div class="text-white text-center">
                <div class="row">
                    <div class="col-md-4 px-0">
                        <div class="row bg-primary mx-1 rounded py-4">
                            <div class="col-md-3 text-center px-1"><i class="fas fa-check fa-3x"></i></div>
                            <div class="col-md-9 px-0">
                            <div class="admin-dashboard-counter">{{$countCompletedOrders}}</div>
                                <div class="admin-dashboard-tile">Orders Completed</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 px-0">
                        <div class="row bg-success mx-1 rounded py-4">
                            <div class="col-md-3 text-center px-1"><i class="fas fa-shopping-bag fa-3x"></i></div>
                            <div class="col-md-9 px-0">
                                <div class="admin-dashboard-counter">{{$countCartItems}}</div>
                                <div class="admin-dashboard-tile">Cart Products</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 px-0">
                        <div class="row bg-danger mx-1 rounded py-4">
                            <div class="col-md-3 text-center px-1"><i class="fas fa-exclamation fa-3x"></i></div>
                            <div class="col-md-9 px-0">
                                <div class="admin-dashboard-counter">{{count($pendingOrders)}}</div>
                                <div class="admin-dashboard-tile">Pending Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pending Orders --}}
            <div class="py-5">
                <h3 class="text-center header-color">Pending Orders <span><a href="/collections" class="btn btn-lg mb-3 float-right btn-main">Shop Now</a></span></h3>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Order Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if($countPendingOrders > 0)
                            @foreach ($pendingOrders as $pendingOrder)
                            <tr>
                            <td><a class="text-decoration-none" href="/user/order/{{$pendingOrder->id}}/show">{{$pendingOrder->transaction_id}}</a></td>
                                <td>{{Carbon\Carbon::parse($pendingOrder->created_at)->format('M j, Y')}}</td>
                                <td>&#8369; {{number_format($pendingOrder->total)}}</td>
                                <td class="text-uppercase">{{$pendingOrder->status_name}}</td>
                                <td>
                                    <button class="btn btn-danger" onclick="userCancelOrderModal({{ $pendingOrder->id }}, '{{$pendingOrder->transaction_id}}')" data-toggle="modal" data-target="#userCancelOrderModal">
                                      Cancel
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    <div class="jumbotron">
                                        <h3 class="text-center">
                                            No Pending Orders.
                                        </h3>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        </main>
        </div>
    </div>

    {{-- User Cancel Order Modal --}}
    <div class="modal fade" id="userCancelOrderModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase">Cancel Order</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="userCancelOrderModalBody">
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row">
                    <form method="get" id="userCancelOrderForm">
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
@endsection


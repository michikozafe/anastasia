@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.admin.admin_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 mb-5">
            <h2 class="text-center text-uppercase header-color font-weight-bold mb-3">Inventory</h2>
            <table class="table text-center mt-4">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Size</th>
                        <th>In Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventories as $inventory)
                        <tr>
                            <td>{{$inventory->product_name}}</td>
                            <td>{{$inventory->size_name}}</td>
                            <td>{{$inventory->quantity}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>
@endsection

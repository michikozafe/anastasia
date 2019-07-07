@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.admin.admin_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <h2 class="text-center text-uppercase header-color font-weight-bold mb-3">Dresses</h2>
            <div class="row mb-2 ">
                <div class="col-md-6 d-flex align-items-center">
                    <form action="/collections/search/admin" method="GET" class="my-3">
                        @csrf
                        <input type="text" name="keyword" placeholder="Search an item..." class="form-control inputForAdminSearch">
                    </form>
                    <a href="/admin/products" class="btn btn-secondary mx-2">Clear Filter</a>
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-end">
                    <a class="btn btn-main mx-1" href="/admin/products/add">Add Product</a>
                    <a class="btn btn-main mx-1" href="/admin/products/restore">Restore Deleted Products</a>
                </div>
            </div>
           <div>
                <div class="row mb-5">
                    @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="/{{$product->img_path}}" class="card-img-top" height="350">
                            <div class="card-body text-center">
                            <a href="/admin/products/{{$product->id}}" class="card-title text-decoration-none header-color text-uppercase">{{$product->name}}</a>
                            <p class="card-text">&#8369; {{number_format($product->price)}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
           </div>
        </main>
    </div>
@endsection

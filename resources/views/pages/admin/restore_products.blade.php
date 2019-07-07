@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.admin.admin_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <h2 class="text-center text-uppercase header-color font-weight-bold">Deleted Products</h2>
            <table class="table table- text-center mt-4">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Deleted On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($countTrashedProducts > 0)
                    @foreach ($trashedProducts as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{Carbon\Carbon::parse($product->deleted_at)->format('M j, Y')}}</td>
                        <td>
                            <a class="btn btn-primary" href="/admin/products/restore/{{$product->id}}">Restore</a>
                            <a class="btn btn-danger" href="/admin/products/delete/{{$product->id}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                <div class="jumbotron">
                                    <h3 class="text-center">
                                        No Deleted Products.
                                    </h3>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </main>
    </div>
@endsection

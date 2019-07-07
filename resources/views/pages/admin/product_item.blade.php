@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.admin.admin_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 mb-5">
            <div>
                <div class="row">
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <img src="/{{$product->img_path}}" width="390" height="480">
                    </div>
                    <div class="col-md-7">
                        <h2 class="text-center header-style text-uppercase header-font-size">{{$product->name}}</h2>
                        <div class="d-flex justify-content-end">
                            <div>
                                <a class="btn btn-main mx-1" href="/admin/products/{{$product->id}}/edit">Edit</a>
                            </div>
                            <div>
                                <form action="/admin/products/{{$product->id}}/delete" method="POST">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-main mx-1" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                        <p class="mb-0 header-color">Description:</p>
                        <p>{{$product->description}}</p>
                        <p class="mb-0 header-color">Rent per day:</p>
                        <p>&#8369; {{number_format($product->price)}}</p>
                        <h3 class="text-center header-color">Inventory</h3>
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>In Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->sizes as $size)
                                <tr>
                                    <td>{{$size->name}}</td>
                                    <td>
                                        <form action="/admin/products/{{$product->id}}/edit/stock" method="POST">
                                            @csrf
                                            {{method_field('PATCH')}}
                                            <input type="hidden" name="sizeId" value="{{$size->id}}" class="text-center">
                                            <input type="number" name="quantity" value="{{$size->pivot->quantity}}" class="text-center" min="0" required>
                                            <button class="btn btn-main" type="submit">Update</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (count($product->sizes) < 3)
                        <div>
                            <h3 class="text-center header-color mt-4">Add Size</h3>
                            <form action="/admin/products/{{$product->id}}/add/size" method="GET">
                                @csrf
                                <div class="d-flex justify-content-around align-items-center">
                                    <div class="form-group m-0" style="width: 30%">
                                        <input type="number" name="quantity" id="quantity" class="form-control text-center" min="1" placeholder="Quantity" required>
                                    </div>
                                    <div class="form-group d-flex justify-content-center align-items-center m-0 w-50">
                                        <label for="size" class="m-0">Size:</label>
                                        <select name="size" id="size" class="form-control w-50">
                                            @foreach($allSizeNames as $name)
                                                <option value="{{ $name }}" class="w-50">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="btn btn-main w-50" type="submit">Add</button>
                                </div>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.admin.admin_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 mb-5">
            <h2 class="text-center">Edit Product</h2>
            <div class="row">
                <div class="col-md-8 mx-auto">
                <form action="/admin/products/{{$product->id}}/edit" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$product->name}}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" class="form-control" value="{{$product->description}}" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price per day</label>
                            <input type="number" name="price" min="1" id="price" class="form-control" value="{{$product->price}}" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select name="category" id="category" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? "selected" : ""}}> {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Upload Image:</label> <br>
                            <img src="/{{$product->img_path}}" height="350">
                            <input type="file" name="image" id="image" class="form-control" value="{{$product->img_path}}">
                        </div>
                        <button class="btn btn-success" type="submit">Edit Product</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection

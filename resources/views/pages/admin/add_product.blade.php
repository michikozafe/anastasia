@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.admin.admin_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 mb-5">
                <h2 class="text-center text-uppercase header-color font-weight-bold mb-3">Add Product</h2>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price per day</label>
                            <input type="number" name="price" id="price" class="form-control" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select name="category" id="category" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Upload Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <button class="btn btn-main btn-block mt-4" type="submit">Add New Product</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection

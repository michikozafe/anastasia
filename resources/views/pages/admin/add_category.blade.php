@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.admin.admin_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 mb-5">
            <h2 class="text-center text-uppercase header-color font-weight-bold mb-3">Add Category</h2>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <button class="btn btn-main btn-block" type="submit">Add New Category</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection

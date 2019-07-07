@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.admin.admin_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <h2 class="text-center text-uppercase header-color font-weight-bold">Categories</h2>
            <a class="btn btn-main float-right mb-3" href="/admin/categories/add">Add New Category</a>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Added on</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{Carbon\Carbon::parse($category->created_at)->format('M j, Y')}}</td>
                        <td class="d-flex justify-content-center">
                            <div>
                                <a class="btn btn-primary mx-1" href="/admin/categories/{{$category->id}}/edit">Edit</a>
                            </div>
                            <div>
                                <form action="/admin/categories/{{$category->id}}/delete" method="POST">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-danger mx-1"  type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>
@endsection

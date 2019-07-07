@extends('layouts.app')


@section('content')
    <div class="row">
        @include('includes.user.user_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <h2 class="text-center text-uppercase header-color font-weight-bold">Favorites</h2>
            <table class="table text-center mt-4">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($favorites) > 0)
                        @foreach ($favorites as $favorite)
                            <tr>
                                <td>{{$favorite->product_name}}</td>
                                <td>{{Carbon\Carbon::parse($favorite->created_at)->format('M j, Y')}}</td>
                                <td>
                                    <button class="btn btn-danger" onclick="deleteFavoritesModal({{ $favorite->id }}, '{{$favorite->product_name}}')" data-toggle="modal" data-target="#deleteFavoritesModal">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">
                                <div class="jumbotron">
                                    <h3>No Favorites Saved</h3>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </main>
    </div>

    {{-- Delete Favorites Modal --}}
    <div class="modal fade" id="deleteFavoritesModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase">Delete Favorites</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="deleteFavoritesModalBody">
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row">
                    <form method="get" id="deleteFavoritesForm">
                        @csrf
                        {{ method_field('DELETE')}}
                        <button class="btn btn-danger"
                        type="submit">Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

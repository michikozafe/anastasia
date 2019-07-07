@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.user.user_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" id="userProfile">
            <h2 class="text-center text-uppercase header-color font-weight-bold">Profile</h2>
            <div class="row text-center">
                <div class="col-md-5 mx-auto mt-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title header-color font-weight-bold">Name:</h5>
                            <p class="card-text">{{Auth::user()->name}}</p>
                            <button class="btn btn-main btn-block" data-toggle="modal" data-target="#editNameModal">Edit Name</button>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title header-color font-weight-bold">Email:</h5>
                            <p class="card-text">{{Auth::user()->email}}</p>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title header-color font-weight-bold">Member since:</h5>
                            <p class="card-text">{{Auth::user()->created_at->format('F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- Name Modal Form --}}
    <div class="modal fade" id="editNameModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Edit Name</h4>
                    <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="d-flex flex-column">
                    <form action="/user/profile/{{Auth::user()->id}}/edit" method="POST">
                        @csrf
                        {{method_field('PATCH')}}
                        <input type="text" placeholder="Type your name here..." name="name" class="form-control" required>
                        <button type="submit" class="btn btn-main btn-block mt-2">Update Name</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

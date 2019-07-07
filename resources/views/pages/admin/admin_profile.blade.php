@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.admin.admin_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" id="userProfile">
                <h2 class="text-center text-uppercase header-color font-weight-bold">Profile</h2>
                <div class="row">
                    <div class="col-md-5 mx-auto mt-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title header-color font-weight-bold">Name:</h5>
                                <p class="card-text">{{Auth::user()->name}}</p>
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
@endsection

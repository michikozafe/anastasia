@extends('layouts.app')

@section('content')
    <div class="row">
        @include('includes.admin.admin_navbar')
        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <h2 class="text-center text-uppercase header-color font-weight-bold">Registered Users</h2>
            <table class="table text-center mt-4">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Member Since</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at->format('F Y') }}</td>
                        <td>
                            <a role="button" class="btn text-white btn-danger" onclick="deleteRegisteredUserModal({{ $user->id }}, '{{$user->name}}')" data-toggle="modal" data-target="#deleteRegisteredUserModal">Cancel</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>

    {{-- Admin Delete Registered User Modal --}}
    <div class="modal fade" id="deleteRegisteredUserModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase">Cancel Order</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="deleteRegisteredUserModalBody">
            </div>
            <div class="modal-footer">
                <div class="d-flex flex-row">
                    <form method="get" id="deleteRegisteredUserForm">
                        @csrf
                        {{ method_field('DELETE')}}
                        <button class="btn btn-danger"
                        type="submit">Delete Item</button>
                    </form>
                    <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

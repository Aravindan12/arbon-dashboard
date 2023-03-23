@extends('layouts.layout')

@section('content')
    <div class="content ">
        <div class="row">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add User</h4>
                    </div>
                    <div class="card-body col-lg-12 px-lg-5 pt-0">
                        <form role="form" class="text-start" method="POST" action="{{route('admin.users.store')}}">
                            @csrf
                            <div class="mb-3">
                                <input type="name" class="form-control" placeholder="Name"
                                aria-label="Name" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email" aria-label="Email"
                                name="email" value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Password"
                                aria-label="Password" name="password" value="{{ old('password') }}">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100 my-4 mb-2">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


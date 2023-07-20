@extends('layouts.layout')

@section('content')
    <div class="content ">
        <div class="row">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit User</h4>
                    </div>
                    <div class="card-body col-lg-12 px-lg-5 pt-0">
                        <form role="form" class="text-start" method="POST" action="{{route('admin.users.update')}}">
                            @csrf
                            <input name="id" type="hidden" value="{{$data->id}}">
                            <div class="mb-3">
                                <input type="name" class="form-control" placeholder="Name"
                                aria-label="Name" name="name" value="{{$data->name}}">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email" aria-label="Email"
                                name="email" value="{{$data->email}}">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100 my-4 mb-2">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


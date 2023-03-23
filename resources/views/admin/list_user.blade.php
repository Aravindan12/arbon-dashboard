@extends('layouts.layout')

@section('content')
    <div class="content ">
        <div class="row">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('pagination.user_list')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 col-md-12">
                            <div class="row form-group">
                                <label for="date_picker" class="col-1 col-form-label">
                                    {{__('pagination.date')}}:
                                </label>
                                <div class="col-2 text-left">
                                    <input id="date_picker" type="text" name="date" class="form-control"
                                    placeholder="Select Date Range">
                                </div>
                                <div class="col-2 text-left">
                                    <button id="filter" type="button" class="btn btn-primary">
                                        {{ __('pagination.filter') }}
                                    </button>
                                </div>
                                <div class="col-4 text-right">
                                    <form id="download-report" method="POST"
                                        action="{{route('admin.users.download')}}">
                                        @csrf
                                        <button class="btn button btn-primary" id = 'download_report' type="submit"
                                        title="Download Report">{{__('pagination.download')}}</button>
                                    </form>
                                </div>
                                <div class="col-2 text-left">
                                    <a href="{{route('admin.users.add')}}">
                                        <button type="button" class="btn btn-primary">
                                            Add User
                                        </button>
                                    </a>
                                </div>

                            </div>
                            <div class="table-responsive">
                                <table id="users_table" class="table table-bordered text-center align-items-center mb-0"
                                    aria-describedby="table">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center" data-orderable ="false" >
                                            <input type="checkbox" id="title_checkbox">
                                        </th>
                                        <th scope="col" class="text-center">{{ __('pagination.s_no')}}</th>
                                        <th scope="col" class="text-center">{{ __('pagination.name')}}</th>
                                        <th scope="col" class="text-center">{{ __('pagination.email')}}</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    @if ($errors->any())
    toastr.error('{{($errors->first())}}', "", {"iconClass": 'customer-info'});
    @endif

</script>
    <script>let adminUserUrl = '{{route("admin.users.pagination")}}'; </script>
    <script src="{{ asset('assets/js/pagination/admin-user.js')}}"></script>
@endsection

@extends('admin.layout.master')
@section('title', 'Update Password')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Settings</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 m-auto grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Admin Profile</h4>
                        @if(Session::has('success'))
                            <div class="mt-2 alert alert-success bg-transparent alert-dismissible fade show" role="alert">
                                <strong>Success: </strong>{{ Session::get('success') }}
                                <button type="button" class="close text-center" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form class="forms-sample" action="{{ route('admin.profile-update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $admin->name }}" id="name" placeholder="Admin Name">
                                @error('name')
                                <span class="text-danger mt-3">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile Number</label>
                                <input class="form-control"
                                       type="text"
                                       value="{{ $admin->mobile }}"
                                       name="mobile"
                                       id="mobile"
                                       placeholder="Mobile Number"
                                >
                                @error('mobile')
                                <span class="text-danger mt-3">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Profile Image</label>
                                <input class="form-control"
                                       type="file"
                                       name="image"
                                       id="image"
                                >
                                @error('image')
                                <span class="text-danger mt-3">{{ $message }}</span>
                                @enderror
                                @if($admin->image)
                                    <a target="_blank" href="{{ asset($admin->image) }}">View Picture</a>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

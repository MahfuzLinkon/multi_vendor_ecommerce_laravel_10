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
                        <h4 class="card-title">Update Password</h4>
                        @if(Session::has('error'))
                            <div class="mt-2 alert alert-danger bg-transparent alert-dismissible fade show" role="alert">
                                <strong>Error: </strong>{{ Session::get('error') }}
                                <button type="button" class="close text-center" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <div class="mt-2 alert alert-success bg-transparent alert-dismissible fade show" role="alert">
                                <strong>Success: </strong>{{ Session::get('success') }}
                                <button type="button" class="close text-center" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form class="forms-sample" action="{{ url('/admin/password-update') }}" method="post">
                            @csrf
                            {{--                    <div class="form-group">--}}
                            {{--                        <label for="exampleInputUsername1">Email address</label>--}}
                            {{--                        <input type="email" readonly class="form-control" value="{{ auth()->guard('admin')->user()->email }}" name="email" id="email" placeholder="Email Address">--}}
                            {{--                    </div>--}}
                            <div class="form-group">
                                <label for="currentPassword">Current Password</label>
                                <input type="password" class="form-control" name="current_password" value="{{ old('current_password') }}" id="currentPassword" placeholder="Current Password">
                                <span id="currentPassCheck"></span>
                                @error('current_password')
                                <span class="text-danger mt-3">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" name="new_password" class="form-control"  id="newPassword" placeholder="New Password">
                                @error('new_password')
                                <span class="text-danger mt-3">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirmNewPassword">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" id="confirmNewPassword" placeholder="Confirm New Password">
                                @error('password_confirmation')
                                <span class="text-danger mt-3">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).on('keyup', '#currentPassword', function (){
            let currentPassword = $(this).val();
            let _token = "{{ csrf_token() }}"
            $.ajax({
                url: "{{ route('admin.password-check') }}",
                method: 'post',
                data: {currentPassword, _token},
                success: function (response) {
                    if (response.status === 400){
                        $('#currentPassCheck').html('<font class="text-danger">Current password is incorrect!</font>')
                    }else if(response.status === 200){
                        $('#currentPassCheck').html('<font class="text-success font-weight-bold">Current password is correct!</font>')
                    }
                },error: function (){
                    alert('error');
                }
            });
        });
    </script>
@endsection

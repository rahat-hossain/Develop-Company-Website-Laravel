@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 m-auto">
                <div class="card">
                    <div class="card-header">
                        Change Password
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('error_status'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error_status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <form method="post" action="{{ route('passwordchange') }}">
                            @csrf
                            <div class="form-group">
                                <label>Current Password</label>
                                <input value="{{ old('old_password') }}" type="password" class="form-control" placeholder="Enter Current password" name="old_password">
                                @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Enter new password" name="new_password" id="new_password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" onclick="Show_pass()" id="show_btn"><span class="fa fa-eye"></span></button>
                                        {{-- Show and hide eye js Start --}}
                                        <script>
                                            function Show_pass() {
                                                var x = document.getElementById("new_password");
                                                var y = document.getElementById("show_btn");
                                                if (x.type === "password") {
                                                    x.type = "text";
                                                    y.innerHTML = " <i class='fa fa-eye-slash' aria-hidden='true'></i>";
                                                }
                                                else {
                                                    x.type = "password";
                                                    y.innerHTML = " <i class='fa fa-eye' aria-hidden='true'></i>";
                                                }
                                            }
                                        </script>
                                        {{-- Show and hide eye js End --}}
                                    </div>
                                </div>
                                @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" placeholder="confirm password" name="confirm_password">
                                @error('confirm_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-info">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

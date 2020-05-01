@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-header">
                    Edit Team
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

                    <form method="post" action="{{ url('team/edit') }}/{{ $team_info->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $team_info->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <input type="text" class="form-control" name="designation" value="{{ $team_info->designation }}">
                            @error('designation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>FB</label>
                            <input type="text" class="form-control" name="fb" value="{{ $team_info->fb }}">
                            @error('fb')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Google</label>
                            <input type="text" class="form-control" name="google" value="{{ $team_info->google }}">
                            @error('google')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Linkedin</label>
                            <input type="text" class="form-control" name="linkedin" value="{{ $team_info->linkedin }}">
                            @error('linkedin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Team Photo</label><br>
                            <img src="{{ asset('uploads/team_photos') }}/{{ $team_info->tm_photo }}" alt="not found" height="150" width="250">
                        </div>
                        <div class="form-group">
                            <label>New Photo</label>
                            <input type="file" class="form-control" name="new_image" onchange="readURL(this);"><br>
                            <img class="hidden" id="tenant_photo_viewer" src="#" alt="your image" height="150" width="250"/><br>
                                <script>
                                    function readURL(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                        $('#tenant_photo_viewer').attr('src', e.target.result).width(250).height(150);
                                        };
                                        $('#tenant_photo_viewer').removeClass('hidden');
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                    }
                                </script>
                        </div>

                        <button type="submit" class="btn btn-info">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 m-auto">
            <div class="card">
                <div class="card-header">
                    Edit Service
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

                    <form method="post" action="{{ url('service/edit') }}/{{ $service_info->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $service_info->title }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Short Description</label>
                            <textarea class="form-control" name="short_description">{{ $service_info->short_description }}</textarea>
                            @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Service Photo</label><br>
                            <img src="{{ asset('uploads/service_photos') }}/{{ $service_info->services_photo }}" alt="not found" height="150" width="250">
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 m-auto">
            <div class="card">
                <div class="card-header">
                    Edit Client
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

                    <form method="post" action="{{ url('client/edit') }}/{{ $client_info->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Short Text</label>
                            <textarea class="form-control" name="short_text" rows="6">{{ $client_info->short_text }}</textarea>
                            @error('short_text')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Client Photo</label><br>
                            <img src="{{ asset('uploads/client_photos') }}/{{ $client_info->clients_photo }}" alt="not found" height="150" width="250">
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

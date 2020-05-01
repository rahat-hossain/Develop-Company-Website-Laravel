@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-header">
                    Edit Contact
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

                    <form method="post" action="{{ url('contact/edit') }}/{{ $contact_info->id }}">
                        @csrf
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="6">{{ $contact_info->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" value="{{ $contact_info->address }}">
                        </div>
                        <div class="form-group">
                            <label>Phone No</label>
                            <input type="text" class="form-control" name="phone_no" value="{{ $contact_info->phone_no }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $contact_info->email }}">
                        </div>
                        <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" class="form-control" name="twitter" value="{{ $contact_info->twitter }}">
                        </div>
                        <div class="form-group">
                            <label>FB</label>
                            <input type="text" class="form-control" name="fb" value="{{ $contact_info->fb }}">
                        </div>
                        <div class="form-group">
                            <label>Google</label>
                            <input type="text" class="form-control" name="google" value="{{ $contact_info->google }}">
                        </div>
                        <div class="form-group">
                            <label>Linkedin</label>
                            <input type="text" class="form-control" name="linkedin" value="{{ $contact_info->linkedin }}">
                        </div>


                        <button type="submit" class="btn btn-info">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

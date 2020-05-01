@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Contact
                </div>
                <div class="card-body table-responsive">
                    @if (session('editstatus'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{ session('editstatus') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table class="table table-bordered table-hover" id="slider_table">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Description</th>
                                <th>Address</th>
                                <th>Phone No</th>
                                <th>Email</th>
                                <th>Twitter</th>
                                <th>FB</th>
                                <th>Google</th>
                                <th>Linkedin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $contact)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $contact->description }}</td>
                                <td>{{ Str::limit($contact->address,20) }}</td>
                                <td>{{ Str::limit($contact->phone_no,20) }}</td>
                                <td>{{ Str::limit($contact->email,20) }}</td>
                                <td>{{ Str::limit($contact->twitter,20) }}</td>
                                <td>{{ Str::limit($contact->fb,20) }}</td>
                                <td>{{ Str::limit($contact->google,20) }}</td>
                                <td>{{ Str::limit($contact->linkedin,20) }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('contact/edit') }}/{{ $contact->id }}" type="button" class="btn btn-primary">Edit</a>
                                        <a href="{{ url('contact/delete') }}/{{ $contact->id }}" type="button" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="15" class="text-center text-danger">No Data Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Add Contact
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
                    <form method="post" action="{{ url('contact/insert') }}" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="6"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone No</label>
                            <input type="text" class="form-control" name="phone_no">
                            @error('phone_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" class="form-control" name="twitter">
                            @error('twitter')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>FB</label>
                            <input type="text" class="form-control" name="fb">
                            @error('fb')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Google</label>
                            <input type="text" class="form-control" name="google">
                            @error('google')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Linkedin</label>
                            <input type="text" class="form-control" name="linkedin">
                            @error('linkedin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Portfolios
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
                    @if (session('deletestatus'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('deletestatus') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <table class="table table-bordered table-hover" id="slider_table">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Short Text</th>
                                <th>Title</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($portfolios as $portfolio)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $portfolio->short_text }}</td>
                                <td>{{ $portfolio->title }}</td>
                                <td>
                                    <img width="80" height="60" src="{{ asset('uploads/portfolio_photos') }}/{{ $portfolio->portfolio_photo }}" alt="not found">
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('portfolio/edit') }}/{{ $portfolio->id }}" type="button" class="btn btn-primary">Edit</a>
                                        <a href="{{ url('portfolio/delete') }}/{{ $portfolio->id }}" type="button" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-danger">No Data Available</td>
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
                    Add Portfolio
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
                    <form method="post" action="{{ url('portfolio/insert') }}" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group">
                            <label>Short Text</label>
                            <input type="text" class="form-control" name="short_text">
                            @error('short_text')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Photo</label>
                            <input type="file" class="form-control" name="portfolio_photo">
                            @error('portfolio_photo')
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

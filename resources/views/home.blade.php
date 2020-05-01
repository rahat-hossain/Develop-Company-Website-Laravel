
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User List</div>

                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Account open at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        {{ $user->created_at }}
                                        <br>
                                        {{ $user->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

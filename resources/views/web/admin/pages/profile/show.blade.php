@extends('web.admin.layouts.app')

@section('title', 'Users')

@section('content')
<div class="card-header">
    <h3 class="card-title">Bordered Table</h3>
</div>
<div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Created Time</th>
                <th>Updated Time</th>
                <th>Action</th>
            </tr>
        </thead>
        @php
        $user_id = session(['user_id' => $user->id]);
        @endphp
        <tbody>
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->role->name ?? 'N/A' }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>
                    <a href="{{ route('admindoctor-profile.edit', ['user' => $user->id]) }}" class="btn btn-info d-inline">Edit</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

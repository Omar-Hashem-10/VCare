@extends('web.admin.layouts.app')

@section('title', 'Users')

@section('content')
<div class="card-header">
    <h3 class="card-title">Bordered Table</h3>
</div>
<div class="card-body">
    @if ($selected_role_name == 'superadmin' || $selected_role_name == 'admin' || $selected_role_name == 'doctor')
    <td><a href="{{ route('adminusers.create', ['role_id' => $selected_role]) }}" class="btn btn-primary my-3">Add New User</a></td>
@endif
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
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->role->name ?? 'N/A' }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>
                    <a href="{{ route('adminusers.edit', ['user' => $user->id, 'role_id' => $selected_role]) }}" class="btn btn-info d-inline">Edit</a>
                    <form action="{{ route('adminusers.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <nav class="mt-2" aria-label="navigation">
        {{ $users->links() }}
    </nav>
</div>
@endsection

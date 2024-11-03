@extends('web.admin.layouts.app')

@section('title', 'Doctor-Book')

@section('content')
<div class="card-header">
    <h3 class="card-title">Bordered Table</h3>
</div>
<!-- /.card-header -->
<div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Doctor Name</th>
                <th>User Name</th>
                <th>Patient Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Time</th>
                <th>Status</th>
                <th>Created Time</th>
                <th>Updated Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $book->doctor->name }}</td>
                <td>{{ $book->user->name ?? 'N/A' }}</td>
                <td>{{ $book->name ?? 'N/A' }}</td>
                <td>{{ $book->phone ?? 'N/A' }}</td>
                <td>{{ $book->email ?? 'N/A' }}</td>
                <td>{{ $book->time }}</td>
                <td>{{ $book->status }}</td>
                <td>{{ $book->created_at }}</td>
                <td>{{ $book->updated_at }}</td>
                <td>
                    <a href="{{ route('admindoctor-books.edit', $book->id) }}" class="btn btn-info d-inline">Edit</a>
                    <form action="{{ route('admindoctor-books.destroy', $book->id) }}" method="POST" class="d-inline">
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
    </nav>
</div>
@endsection

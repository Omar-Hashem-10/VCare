@extends('web.site.app')

@section('title', 'Books')

@section('content')
<div class="container">
    <h2 class="my-4">Books List</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Doctor Name</th>
                    <th>Major</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Time</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book->doctor ? $book->doctor->name : 'N/A' }}</td>
                    <td>{{ $book->doctor && $book->doctor->major ? $book->doctor->major->title : 'N/A' }}</td>
                    <td>{{ $book->name }}</td>
                    <td>{{ $book->phone }}</td>
                    <td>{{ $book->email }}</td>
                    <td>{{ $book->time }}</td>
                    <td>{{ $book->doctor->examination_price }}</td>
                    <td>
                        @if($book->status == 'pinned')
                            Pinned
                        @elseif($book->status == 'Booked' || $book->status == 'examined')
                            {{ $book->status }}
                        @endif
                    </td>

                    <td>
                        @if($book->status == 'pinned')
                            <a href="{{ route('site.patient-book.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                        @endif

                        @if($book->status == 'Booked' || $book->status == 'pinned')
                            <form action="{{ route('site.patient-book.destroy', $book->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .table {
        border-radius: 0.5rem;
        overflow: hidden;
    }

    th, td {
        vertical-align: middle;
    }
</style>
@endsection

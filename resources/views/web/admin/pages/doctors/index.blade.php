@extends('web.admin.layouts.app')

@section('title', 'Doctors')

@section('content')
<div class="card-header">
    <h3 class="card-title">
        Bordered Table
    </h3>
</div>
<!-- /.card-header -->
<div class="card-body">
    <td><a href="{{ route('admindoctors.create', ['major_id' => $majorId]) }}" class="btn btn-primary my-3">Add New Doctor</a></td>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Bio</th>
                <th>Major</th>
                <th>Experience Years</th>
                <th>Examination Price</th>
                <th>User Id</th>
                <th>Created Time</th>
                <th>Updated Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$doctor->name}}</td>
                <td><img class="profile-user-img img-fluid img-circle" src="{{FileHelper::get_file_url(asset($doctor->image))}}" alt=""></td>
                <td>{{$doctor->email}}</td>
                <td>{{$doctor->phone}}</td>
                <td>{{$doctor->bio}}</td>
                <td>{{$doctor->major->title ?? 'N/A'}}</td>
                <td>{{$doctor->experience_years}}</td>
                <td>{{$doctor->examination_price}}</td>
                <td>{{$doctor->user_id}}</td>
                <td>{{$doctor->created_at}}</td>
                <td>{{$doctor->updated_at}}</td>
                <td>
                    <a href="{{route('admindoctors.edit', $doctor->id)}}" class="btn btn-info d-inline">Edit</a>
                    <form action="{{route('admindoctors.destroy', $doctor->id)}}" method="POST" class="d-inline">
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
        {{$doctors->links()}}
    </nav>
</div>
@endsection

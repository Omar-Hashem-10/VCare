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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
        @php
        $doctor_id = session(['doctor_id' => $doctor->id]);
        @endphp
        <tbody>
            <tr>
                <td>{{$doctor->id}}</td>
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
                    <a href="{{route('admindoctor-information.edit', ['doctor' => $doctor->id])}}" class="btn btn-info d-inline">Edit</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

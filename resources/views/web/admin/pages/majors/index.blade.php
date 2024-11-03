@extends('web.admin.layouts.app')


@section('title', 'Majors')

@section('content')

<div class="card-header">
    <h3 class="card-title">Bordered Table</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <td><a href="{{route('adminmajors.create')}}" class="btn btn-primary my-3">Add New Major</a></td>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Title</th>
          <th>Image</th>
          <th >Created Time</th>
          <th >Updated Time</th>
          <th >Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($majors as $major)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$major->title}}</td>
            <td><img  class="profile-user-img img-fluid img-circle" src="{{FileHelper::get_file_url(asset($major->image))}}" alt=""></td>
            <td>{{$major->created_at}}</td>
            <td>{{$major->updated_at}}</td>
            <td>
                <a href="{{route('adminmajors.edit', $major->id)}}" class="btn btn-info d-inline">Edit</a>
                <form action="{{route('adminmajors.destroy', $major->id)}}" method="POST" class="d-inline">
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
        {{$majors->links()}}
    </nav>
  </div>
</div>

@endsection

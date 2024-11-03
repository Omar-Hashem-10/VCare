@extends('web.admin.layouts.app')


@section('title', 'Info')

@section('content')

<div class="card-header">
    <h3 class="card-title">Bordered Table</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <td><a href="{{route('admininfo.create')}}" class="btn btn-primary my-3">Add New Info</a></td>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Title</th>
          <th>Description</th>
          <th>Image</th>
          <th >Created Time</th>
          <th >Updated Time</th>
          <th >Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($infos as $info)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$info->title}}</td>
            <td>{{$info->description}}</td>
            <td><img  class="profile-user-img img-fluid img-circle" src="{{FileHelper::get_file_url(asset($info->image))}}" alt=""></td>
            <td>{{$info->created_at}}</td>
            <td>{{$info->updated_at}}</td>
            <td>
                <a href="{{route('admininfo.edit', $info->id)}}" class="btn btn-info d-inline">Edit</a>
                <form action="{{route('admininfo.destroy', $info->id)}}" method="POST" class="d-inline">
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
        {{$infos->links()}}
    </nav>
  </div>
</div>

@endsection

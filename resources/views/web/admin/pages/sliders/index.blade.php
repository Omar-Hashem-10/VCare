@extends('web.admin.layouts.app')


@section('title', 'Slides')

@section('content')

<div class="card-header">
    <h3 class="card-title">Bordered Table</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <td><a href="{{route('adminsliders.create')}}" class="btn btn-primary my-3">Add New Slider</a></td>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Title</th>
          <th>Description</th>
          <th>Image</th>
          <th>Created Time</th>
          <th>Updated Time</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($sliders as $slider)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$slider->title}}</td>
            <td>{{$slider->description}}</td>
            <td><img  class="profile-user-img img-fluid img-circle" src="{{FileHelper::get_file_url(asset($slider->image))}}" alt=""></td>
            <td>{{$slider->created_at}}</td>
            <td>{{$slider->updated_at}}</td>
            <td>
                <a href="{{route('adminsliders.edit', $slider->id)}}" class="btn btn-info d-inline">Edit</a>
                <form action="{{route('adminsliders.destroy', $slider->id)}}" method="POST" class="d-inline">
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
        {{$sliders->links()}}
    </nav>
  </div>
</div>

@endsection

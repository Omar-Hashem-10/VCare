@extends('web.admin.layouts.app')


@section('title', 'About')

@section('content')

<div class="card-header">
    <h3 class="card-title">Bordered Table</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <td><a href="{{route('adminabout.create')}}" class="btn btn-primary my-3">Add New About</a></td>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Description</th>
          <th >Created Time</th>
          <th >Updated Time</th>
          <th >Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($abouts as $about)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$about->description}}</td>
            <td>{{$about->created_at}}</td>
            <td>{{$about->updated_at}}</td>
            <td>
                <a href="{{route('adminabout.edit', $about->id)}}" class="btn btn-info d-inline">Edit</a>
                <form action="{{route('adminabout.destroy', $about->id)}}" method="POST" class="d-inline">
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
        {{$abouts->links()}}
    </nav>
  </div>
</div>

@endsection

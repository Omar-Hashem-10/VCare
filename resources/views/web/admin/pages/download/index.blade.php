@extends('web.admin.layouts.app')


@section('title', 'Download')

@section('content')

<div class="card-header">
    <h3 class="card-title">Bordered Table</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <td><a href="{{route('admindownload.create')}}" class="btn btn-primary my-3">Add New Download</a></td>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Title</th>
          <th>Description</th>
          <th>Image</th>
          <th>Link Google Play</th>
          <th>Link App Store</th>
          <th >Created Time</th>
          <th >Updated Time</th>
          <th >Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($downloads as $download)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$download->title}}</td>
            <td>{{$download->description}}</td>
            <td>{{$download->link_google_play}}</td>
            <td>{{$download->link_app_store}}</td>
            <td><img  class="profile-user-img img-fluid img-circle" src="{{FileHelper::get_file_url(asset($download->image))}}" alt=""></td>
            <td>{{$download->created_at}}</td>
            <td>{{$download->updated_at}}</td>
            <td>
                <a href="{{route('admindownload.edit', $download->id)}}" class="btn btn-info d-inline">Edit</a>
                <form action="{{route('admindownload.destroy', $download->id)}}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

@extends('web.admin.layouts.app')

@section('title', 'Edit Major')

@section('content')
<div class="col-md-12 my-5">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Major</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{route('adminmajors.update', $major->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{old('title', $major->title)}}" placeholder="Enter Major Title">
            @error('title')
                <div class="text-danger">{{$message}}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="image">Image</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="image" id="image">
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
        @error('image')
            <div class="text-danger">{{$message}}</div>
        @enderror
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.card -->

  </div>
@endsection

@extends('web.admin.layouts.app')

@section('title', 'Edit About')

@section('content')
<div class="col-md-12 my-5">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit About</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{route('adminabout.update', $about->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{old('description', $about->description)}}" placeholder="Enter About Description">
            @error('description')
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

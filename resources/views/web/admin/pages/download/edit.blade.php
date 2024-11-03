@extends('web.admin.layouts.app')

@section('title', 'Edit Download')

@section('content')
<div class="col-md-12 my-5">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Download</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('admindownload.update', $download->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $download->title) }}" placeholder="Enter Info Title">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $download->description) }}" placeholder="Enter Info Description">
            @error('description')
                <div class="text-danger">{{ $message }}</div>
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
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="link_google_play">Google Play Link</label>
            <input type="url" class="form-control" id="link_google_play" name="link_google_play" value="{{ old('link_google_play', $download->link_google_play) }}" placeholder="Enter Google Play link">
            @error('link_google_play')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="link_app_store">App Store Link</label>
            <input type="url" class="form-control" id="link_app_store" name="link_app_store" value="{{ old('link_app_store', $download->link_app_store) }}" placeholder="Enter App Store link">
            @error('link_app_store')
                <div class="text-danger">{{ $message }}</div>
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

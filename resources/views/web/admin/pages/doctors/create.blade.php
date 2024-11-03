@extends('web.admin.layouts.app')

@section('title', 'Create Doctor')

@section('content')
<div class="col-md-12 my-5">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add New Doctor</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('admindoctors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Doctor Name">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Doctor Email">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter Doctor Phone">
            @error('phone')
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
        <div class="form-group">
            <label for="bio">Bio</label>
            <input type="text" class="form-control" id="bio" name="bio" value="{{ old('bio') }}" placeholder="Enter Doctor Bio">
            @error('bio')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        <div class="form-group">
            <label for="experience_years">Experience years</label>
            <input type="number" class="form-control" id="experience_years" name="experience_years" value="{{ old('experience_years') }}" placeholder="Enter Doctor Experience years">
            @error('experience_years')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="user_id">Select Existing Doctor</label>
            <select class="form-control" id="user_id" name="user_id">
                <option value="" disabled selected>Select an Existing Doctor</option>
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="examination_price">Examination Price</label>
            <input type="number" class="form-control" id="examination_price" name="examination_price" value="{{ old('examination_price') }}" placeholder="Enter Doctor Examination price">
            @error('examination_price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

        <!-- Hidden field for major_id -->
        <input type="hidden" name="major_id" value="{{ session('major_id') }}">

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

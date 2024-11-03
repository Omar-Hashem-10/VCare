@extends('web.admin.layouts.app')

@section('title', 'Create Appointment')

@section('content')
<div class="col-md-12 my-5">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add New Appointment</h3>
      </div>
      <form action="{{ route('adminappointments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="doctor_major" class="font-weight-bold">Doctor / Major</label>
                <select class="form-control" id="doctor_major" name="doctor_id">
                    <option value="">Select Doctor</option>
                    @if($selectedMajorId)
                        <optgroup label="{{ $majors_nav->firstWhere('id', $selectedMajorId)->title ?? 'Unknown Major' }}">
                            @foreach($doctors as $doctor)
                                @if($doctor->major_id == $selectedMajorId)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endif
                            @endforeach
                        </optgroup>
                    @endif
                </select>
                @error('doctor_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


          <div class="form-group">
            <label for="day">Day</label>
            <input type="date" class="form-control" id="day" name="appointment_date" value="{{ old('day') }}" placeholder="Enter Appointment Day">
            @error('appointment_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time') }}">
            @error('start_time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') }}">
            @error('end_time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
</div>
@endsection

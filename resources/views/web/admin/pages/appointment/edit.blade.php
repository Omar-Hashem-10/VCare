@extends('web.admin.layouts.app')

@section('title', 'Edit Appointment')

@section('content')
<div class="col-md-12 my-5">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Appointment</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('adminappointments.update', $appointment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="doctor_major" class="font-weight-bold">Doctor / Major</label>
                <select class="form-control" id="doctor_major" name="doctor_id" required>
                    <option value="">Select Doctor</option>
                    @if($selectedMajorId)
                        <optgroup label="{{ $majors_nav->firstWhere('id', $selectedMajorId)->title ?? 'Unknown Major' }}">
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ $doctor->id == $appointment->doctor_id ? 'selected' : '' }}>
                                    {{ $doctor->name }}
                                </option>
                            @endforeach
                        </optgroup>
                    @else
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ $doctor->id == $appointment->doctor_id ? 'selected' : '' }}>
                                {{ $doctor->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('doctor_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="appointment_date">Appointment Date</label>
                <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="{{ old('appointment_date', $appointment->appointment_date) }}" required>
                @error('appointment_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time', $appointment->start_time) }}" required>
                @error('start_time')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time', $appointment->end_time) }}" required>
                @error('end_time')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Update Appointment</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
</div>
@endsection

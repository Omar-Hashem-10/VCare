@extends('web.admin.layouts.app')

@section('title', 'Edit Doctor Book')

@section('content')
<div class="col-md-12 my-5">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Book</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('adminbooks.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="doctor_id">Doctor Name</label>
                    <select class="form-control" id="doctor_id" name="doctor_id">
                        @foreach($majors_nav as $major)
                            <optgroup label="{{ $major->name }}">
                                @foreach($major->doctors as $doctor)
                                    <option value="{{ $doctor->id }}"
                                        {{ $book->doctor_id == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('doctor_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Patient Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $book->name) }}" placeholder="Enter Patient Name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $book->email) }}" placeholder="Enter User Email">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $book->phone) }}" placeholder="Enter User Phone">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="pinned" {{ old('status', $book->status) == 'pinned' ? 'selected' : '' }}>Pinned</option>
                        <option value="Booked" {{ old('status', $book->status) == 'Booked' ? 'selected' : '' }}>Booked</option>
                        <option value="examined" {{ old('status', $book->status) == 'examined' ? 'selected' : '' }}>Examined</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Available Appointments Selection -->
                @php
    $storedTime = \Carbon\Carbon::parse($book->time)->format('Y-m-d H:i');
@endphp

<div class="mb-3">
    <label class="form-label required-label" for="time">Available Appointments</label>
    <select class="form-control @error('time') is-invalid @enderror" id="time" name="time">
        <option value="" disabled {{ old('time', $storedTime) ? '' : 'selected' }}>Select an Appointment</option>
        @foreach ($appointments as $appointment)
            <optgroup label="Appointment on {{ $appointment->appointment_date }}">
                @foreach ($timeSlots[$appointment->id] as $timeSlot)
                    @php
                        $formattedTimeSlot = \Carbon\Carbon::parse($timeSlot)->format('H:i');
                        $currentOption = "{$appointment->appointment_date} {$formattedTimeSlot}";
                    @endphp
                    <option value="{{ $currentOption }}"
                        {{ (old('time') == $currentOption || $storedTime == $currentOption) ? 'selected' : '' }}>
                        {{ $appointment->appointment_date }} - {{ $formattedTimeSlot }}
                    </option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
    @error('time')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                <!-- End of Available Appointments Selection -->

                <input type="hidden" name="user_id" value="{{ $book->user_id }}">
                @error('user_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
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

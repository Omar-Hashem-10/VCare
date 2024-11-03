@extends('web.site.app')

@section('title', 'Edit Book')

@section('content')
<div class="container">
    <h2 class="my-4">Edit Book</h2>
    <div class="card">
        @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        <div class="card-body">
            <form action="{{ route('site.patient-book.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $book->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $book->phone) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $book->email) }}" required>
                </div>

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

                <input type="hidden" name="doctor_id" value="{{ $book->doctor_id }}">
                <input type="hidden" name="user_id" value="{{ $book->user_id }}">
                <input type="hidden" name="status" value="{{ $book->status }}">

                <button type="submit" class="btn btn-primary">Update Book</button>
                <a href="{{ route('site.patient-book.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

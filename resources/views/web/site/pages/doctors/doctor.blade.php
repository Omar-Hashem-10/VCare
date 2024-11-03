@extends('web.site.app')

@section('title', 'Doctors')

@section('content')

<div class="container">
  <nav
    style="--bs-breadcrumb-divider: '>'"
    aria-label="breadcrumb"
    class="fw-bold my-4 h4"
  >
    <ol class="breadcrumb justify-content-center">
      <li class="breadcrumb-item">
        <a class="text-decoration-none" href="{{route('site.home')}}">Home</a>
      </li>
      <li class="breadcrumb-item">
        <a class="text-decoration-none" href="{{route('site.doctor')}}">Doctors</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        {{$doctor->name}}
      </li>
    </ol>
  </nav>

  <div class="d-flex flex-column gap-3 details-card doctor-details">
    <div class="details d-flex gap-2 align-items-center">
      <img
        src="{{FileHelper::get_file_url(asset($doctor->image))}}"
        alt="doctor"
        class="img-fluid rounded-circle"
        height="150"
        width="150"
      />
      <div class="details-info d-flex flex-column gap-3">
        <h4 class="card-title fw-bold">{{$doctor->name}}</h4>
        <h6 class="card-title fw-bold">
          {{'Major: ' . $doctor->major->title}}
        </h6>
        <h6 class="card-title fw-bold">
          {{'BIO: ' . $doctor->bio}}
        </h6>
        <h6 class="card-title fw-bold">
          {{'Examination Price: ' . $doctor->examination_price}}
        </h6>
      </div>
    </div>
    <hr />
    @php
    session(['doctor_id' => $doctor->id]);
    @endphp
    <form class="form" action="{{ route('site.book.store') }}" method="POST">
      @csrf
      <div class="form-items">

        <div class="mb-3">
          <label class="form-label required-label" for="name">Name</label>
          <input
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            id="name"
            name="name"
            value="{{ old('name') }}"
            placeholder="Enter your full name"
          />
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label required-label" for="phone">Phone</label>
          <input
            type="tel"
            class="form-control @error('phone') is-invalid @enderror"
            id="phone"
            name="phone"
            value="{{ old('phone') }}"
            placeholder="Enter your phone number"
          />
          @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label required-label" for="email">Email</label>
          <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            id="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Enter your email address"
          />
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
            <label class="form-label required-label" for="time">Available Appointments</label>
            <select class="form-control @error('time') is-invalid @enderror" id="time" name="time" required>
                @foreach ($appointments as $appointment)
    <optgroup label="Appointment on {{ $appointment->appointment_date }}">
        @foreach ($timeSlots[$appointment->id] as $timeSlot)
            @php
                $formattedTimeSlot = \Carbon\Carbon::parse($timeSlot)->format('H:i');
            @endphp
            <option value="{{ $appointment->appointment_date }} {{ $formattedTimeSlot }}">
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


      </div>

      <button type="submit" class="btn btn-primary w-100">
        Confirm Booking
      </button>
    </form>

  </div>
</div>

@endsection

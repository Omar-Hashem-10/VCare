@extends('web.admin.layouts.app')


@section('title', 'Appointment')


@section('content')
<div class="card-header">
    <h3 class="card-title">Bordered Table</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <td><a href="{{ route('admindoctor-appointment.create', ['doctor_id' => $doctor_id]) }}" class="btn btn-primary my-3">Add New Appointment</a></td>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Day</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Doctor</th>
          <th>Created Time</th>
          <th>Updated Time</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

          @foreach ($appointments as $appointment)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$appointment->appointment_date}}</td>
            <td>{{$appointment->start_time}}</td>
            <td>{{$appointment->end_time}}</td>
            <td>{{$appointment->doctor->name}}</td>
            <td>{{$appointment->created_at}}</td>
            <td>{{$appointment->updated_at}}</td>
            <td>
                <a href="{{route('admindoctor-appointment.edit', $appointment->id)}}" class="btn btn-info d-inline">Edit</a>
                <form action="{{route('admindoctor-appointment.destroy', $appointment->id)}}" method="POST" class="d-inline">
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

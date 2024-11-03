@extends('web.admin.layouts.app')


@section('title', 'Contact')

@section('content')

<div class="card-header">
    <h3 class="card-title">Bordered Table</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Subject</th>
          <th>Message</th>
          <th >Created Time</th>
          <th >Updated Time</th>
          <th >Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($contacts as $contact)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$contact->name}}</td>
            <td>{{$contact->phone}}</td>
            <td>{{$contact->email}}</td>
            <td>{{$contact->subject}}</td>
            <td>{{$contact->message}}</td>
            <td>{{$contact->created_at}}</td>
            <td>{{$contact->updated_at}}</td>
            <td>
                <form action="{{route('admincontact.destroy', $contact->id)}}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <nav class="mt-2" aria-label="navigation">
        {{$contacts->links()}}
    </nav>
  </div>
</div>

@endsection

@extends('web.site.app')

@section('title', 'Profile')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">User Profile</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Name:</strong>
                </div>
                <div class="col-md-8">
                    {{ $user->name }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Email:</strong>
                </div>
                <div class="col-md-8">
                    {{ $user->email }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Phone:</strong>
                </div>
                <div class="col-md-8">
                    {{ $user->phone ?? 'N/A' }}
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('site.profile.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>
@endsection

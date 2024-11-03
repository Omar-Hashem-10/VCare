@extends('web.site.app')

@section('title', 'Major')

@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('site.home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">majors</li>
        </ol>
    </nav>
    <div class="majors-grid">
        @foreach ($majors as $major)
        <div class="card p-2" style="width: 18rem;">
            <img src="{{FileHelper::get_file_url(asset($major->image))}}" class="card-img-top rounded-circle card-image-circle"
                alt="major">
            <div class="card-body d-flex flex-column gap-1 justify-content-center">
                <h4 class="card-title fw-bold text-center">{{$major->title}}</h4>
                <a href="{{route('site.doctor.show', $major->id)}}" class="btn btn-outline-primary card-button">Browse Doctors</a>
            </div>
        </div>
        @endforeach
    </div>

    <nav class="mt-5" aria-label="navigation">
        {{$majors->links()}}
    </nav>
</div>
@endsection
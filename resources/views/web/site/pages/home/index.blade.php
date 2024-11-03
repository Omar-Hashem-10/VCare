@extends('web.site.app')

@section('title', 'Home')

@section('content')
<div class="container-fluid bg-blue text-white pt-3">
    <div class="container pb-5">
        @foreach ($sliders as $slider)
        <div class="row gap-2">
            <div class="col-sm order-sm-2">
                <img src="{{FileHelper::get_file_url(asset($slider->image))}}" class="img-fluid banner-img" alt="banner-image" height="200">
            </div>
            <div class="col-sm order-sm-1">
                <h1 class="h1">{{$slider->title}}</h1>
                <p>{{$slider->description}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="container">
    <h2 class="h1 fw-bold text-center my-4">Majors</h2>
    <div class="d-flex flex-wrap gap-4 justify-content-center">
        @foreach ($majors as $major)
        <div class="card p-2" style="width: 18rem;">
            <img src="{{FileHelper::get_file_url(asset($major->image))}}" class="card-img-top rounded-circle card-image-circle" alt="major">
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
    <h2 class="h1 fw-bold text-center my-4">Doctors</h2>
    <section class="splide home__slider__doctors mb-5">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($doctors as $doctor)
                <li class="splide__slide">
                    <div class="card p-2" style="width: 18rem;">
                        <img src="{{FileHelper::get_file_url(asset($doctor->image))}}" class="card-img-top rounded-circle card-image-circle" alt="major">
                        <div class="card-body d-flex flex-column gap-1 justify-content-center">
                            <h4 class="card-title fw-bold text-center">{{'Dr. ' . $doctor->name}}</h4>
                            <h6 class="card-title fw-bold text-center">{{$doctor->major ? $doctor->major->title : "Not Found"}}</h6>
                            <a href="./doctors/doctor.html" class="btn btn-outline-primary card-button">Book an appointment</a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
</div>
<div class="banner container d-block d-lg-grid d-md-block d-sm-block">
    @foreach ($infos as $info)
    <div class="info">
        <div class="info__details">
            <img src="{{FileHelper::get_file_url(asset($info->image))}}" alt="" width="50" height="50">
            <h4 class="title m-0">{{$info->title}}</h4>
            <p class="content">{{$info->description}}</p>
        </div>
    </div>
    @endforeach
    <div class="bottom--left bottom--content bg-blue text-white">
        @foreach ($downloads as $download)
        <h4 class="title">{{$download->title}}</h4>
        <p>{{$download->description}}</p>
        <div class="app-group">
            <div class="app">
                <a href="{{ $download->link_google_play }}" target="_blank">
                    <img src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/google-play-logo.svg" alt="">Google Play
                </a>
            </div>
            <div class="app">
                <a href="{{ $download->link_app_store }}" target="_blank">
                    <img src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/apple-logo.svg" alt="">App Store
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="bottom--right bg-blue text-white">
        @foreach ($downloads as $download)
        <img src="{{FileHelper::get_file_url(asset($download->image))}}" class="img-fluid banner-img" alt="Download Image">
        @endforeach
    </div>
</div>
@endsection

@push('footer-scripts')
<script src="{{asset('site/scripts/home.js')}}"></script>
@endpush

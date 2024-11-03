@extends('web.site.app')

@section('title', 'Contact')

@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('site.home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li>
        </ol>
    </nav>
    <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">
        <form class="form" action="{{ route('site.contact.store') }}" method="POST">
            @csrf

            <div class="form-items">
                <div class="mb-3">
                    <label class="form-label required-label" for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="phone">Phone</label>
                    <input type="tel" class="form-control" name="phone" id="phone">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label required-label" for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label required-label" for="subject">Subject</label>
                    <select class="form-control" id="subject" name="subject">
                        <option value="">Select Subject Type</option>
                        <option value="general_inquiry">General Inquiry</option>
                        <option value="technical_support">Technical Support</option>
                        <option value="feedback">Feedback</option>
                        <option value="other">Other</option>
                    </select>
                    @error('subject')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label required-label" for="message">Message</label>
                    <textarea class="form-control" id="message" name="message"></textarea>
                    @error('message')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</div>
@endsection

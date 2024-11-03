<nav class="navbar navbar-expand-lg navbar-expand-md bg-blue sticky-top">
    <div class="container">
        <div class="navbar-brand">
            <a class="fw-bold text-white m-0 text-decoration-none h3" href="{{ route('site.home') }}">VCare</a>
        </div>
        <button class="navbar-toggler btn-outline-light border-0 shadow-none" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <div class="d-flex gap-3 flex-wrap justify-content-center" role="group">
                <a type="button" class="btn btn-outline-light navigation--button" href="{{ route('site.home') }}">Home</a>
                <a type="button" class="btn btn-outline-light navigation--button" href="{{ route('site.major') }}">Majors</a>
                <a type="button" class="btn btn-outline-light navigation--button" href="{{ route('site.doctor') }}">Doctors</a>
                <a type="button" class="btn btn-outline-light navigation--button" href="{{ route('site.contact.index') }}">Contact</a>

                @if (auth()->check())
                    <a type="button" class="btn btn-outline-light navigation--button" href="{{ route('site.profile.index') }}">Profile</a>

                    @php
                        $userBooksCount = \App\Models\Book::where('user_id', auth()->user()->id)->count();
                    @endphp

                    @if ($userBooksCount > 0)
                        <a type="button" class="btn btn-outline-light navigation--button" href="{{ route('site.patient-book.index') }}">My Books</a>
                    @endif

                    <form action="{{ route('site.auth.logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-secondary">Logout</button>
                    </form>
                @else
                    <a type="button" class="btn btn-outline-light navigation--button" href="{{ route('site.auth.login.show') }}">Login</a>
                @endif
            </div>
        </div>
    </div>
</nav>

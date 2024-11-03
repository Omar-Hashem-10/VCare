@include('web.site.layouts.head')
<body>
    <div class="page-wrapper">
        @include('web.site.layouts.header')
        @yield('content')
    </div>
@include('web.site.layouts.footer')

@stack('footer-scripts')

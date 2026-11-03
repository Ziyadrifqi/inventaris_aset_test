<!DOCTYPE html>
<html lang="id">

<head>
    @include('partials.head')
</head>

<body class="d-flex flex-column min-vh-100">
    @include('partials.navbar')

    <main class="container py-4 py-md-5 flex-grow-1">
        @include('partials.alerts')
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.scripts')
</body>

</html>

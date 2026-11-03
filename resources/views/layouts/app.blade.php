<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Inventaris Aset') - Inventaris Aset</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --accent: #2f5bea;
            --accent-dark: #2447c4;
            --accent-soft: #eef2ff;
            --ink: #1e2430;
            --muted: #6b7280;
            --line: #e5e7eb;
            --surface: #f6f7f9;

            --bs-primary: var(--accent);
            --bs-primary-rgb: 47, 91, 234;
            --bs-body-font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
            --bs-body-color: var(--ink);
            --bs-body-bg: var(--surface);
            --bs-border-color: var(--line);
            --bs-border-radius: .6rem;
            --bs-link-color: var(--accent);
            --bs-link-hover-color: var(--accent-dark);
        }

        body {
            -webkit-font-smoothing: antialiased;
            font-size: .94rem;
        }

        /* Buttons */
        .btn {
            font-weight: 500;
            border-radius: .55rem;
        }

        .btn-primary {
            --bs-btn-bg: var(--accent);
            --bs-btn-border-color: var(--accent);
            --bs-btn-hover-bg: var(--accent-dark);
            --bs-btn-hover-border-color: var(--accent-dark);
            --bs-btn-active-bg: var(--accent-dark);
            --bs-btn-active-border-color: var(--accent-dark);
            --bs-btn-disabled-bg: var(--accent);
            --bs-btn-disabled-border-color: var(--accent);
        }

        .btn-outline-primary {
            --bs-btn-color: var(--accent);
            --bs-btn-border-color: var(--accent);
            --bs-btn-hover-bg: var(--accent);
            --bs-btn-hover-border-color: var(--accent);
            --bs-btn-active-bg: var(--accent-dark);
            --bs-btn-active-border-color: var(--accent-dark);
        }

        /* Navbar */
        .app-nav {
            background: #fff;
            border-bottom: 1px solid var(--line);
            padding-block: .6rem;
        }

        .app-brand {
            display: inline-flex;
            align-items: center;
            gap: .65rem;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -.01em;
            text-decoration: none;
        }

        .app-brand:hover {
            color: var(--ink);
        }

        .app-brand-mark {
            width: 32px;
            height: 32px;
            border-radius: .5rem;
            background: var(--accent);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .app-nav .nav-link {
            color: var(--muted);
            font-weight: 500;
            padding: .45rem .8rem;
            border-radius: .5rem;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
        }

        .app-nav .nav-link:hover {
            color: var(--ink);
            background: var(--surface);
        }

        .app-nav .nav-link.active {
            color: var(--accent);
            background: var(--accent-soft);
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: .6rem;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--accent-soft);
            color: var(--accent);
            font-weight: 600;
            font-size: .8rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
        }

        .user-meta {
            line-height: 1.2;
        }

        .user-meta .name {
            font-weight: 600;
            font-size: .86rem;
            color: var(--ink);
        }

        .user-meta .role {
            font-size: .72rem;
            color: var(--muted);
            text-transform: capitalize;
        }

        /* Cards & tables, supaya halaman lain ikut rapi tanpa diubah satu-satu */
        .card {
            border: 1px solid var(--line);
            border-radius: .8rem;
            box-shadow: 0 1px 2px rgba(16, 24, 40, .04);
        }

        .table {
            --bs-table-bg: transparent;
        }

        .table> :not(caption)>*>* {
            padding: .8rem 1rem;
        }

        .table thead th {
            font-size: .72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: var(--muted);
            background: var(--surface);
            border-bottom: 1px solid var(--line);
        }

        .form-control,
        .form-select {
            border-color: #d8dce3;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 .2rem rgba(47, 91, 234, .15);
        }

        .form-label {
            font-weight: 500;
            font-size: .85rem;
        }

        /* Alert */
        .app-alert {
            display: flex;
            align-items: center;
            gap: .7rem;
            background: #fff;
            border: 1px solid var(--line);
            border-left: 4px solid #16a34a;
            border-radius: .6rem;
            padding: .8rem 1rem;
            box-shadow: 0 1px 2px rgba(16, 24, 40, .04);
        }

        .app-alert i.lead-icon {
            color: #16a34a;
            font-size: 1.1rem;
        }

        .app-alert .btn-close {
            margin-left: auto;
            font-size: .7rem;
        }

        .app-footer {
            color: var(--muted);
            font-size: .78rem;
        }
    </style>
    @stack('styles')
</head>

<body>
    @auth
        <nav class="navbar navbar-expand-md app-nav sticky-top">
            <div class="container">
                <a class="app-brand" href="/">
                    <span class="app-brand-mark"><i class="bi bi-box-seam"></i></span>
                    Inventaris Aset
                </a>
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#nav" aria-label="Menu">
                    <i class="bi bi-list fs-3"></i>
                </button>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="navbar-nav me-auto ms-md-3 mt-3 mt-md-0 gap-1">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                                <i class="bi bi-grid"></i> Daftar Aset
                            </a>
                        </li>
                    </ul>
                    <div class="user-chip mt-3 mt-md-0 pt-3 pt-md-0 border-top border-md-0">
                        <span class="user-avatar">{{ mb_substr(auth()->user()->name, 0, 1) }}</span>
                        <div class="user-meta me-2">
                            <div class="name">{{ auth()->user()->name }}</div>
                            <div class="role">{{ auth()->user()->role }}</div>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="ms-auto ms-md-0">
                            @csrf
                            <button class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1">
                                <i class="bi bi-box-arrow-right"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    @endauth

    <main class="container py-4 py-md-5">
        @if (session('success'))
            <div class="app-alert alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill lead-icon"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        @yield('content')
    </main>

    @auth
        <footer class="container pb-4 app-footer text-center">
            &copy; {{ date('Y') }} {{ config('app.name') }}
        </footer>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>

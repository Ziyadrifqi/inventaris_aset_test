<nav class="navbar navbar-expand-md app-nav sticky-top">
    <div class="container">
        <a class="app-brand" href="{{ route('assets.index') }}">
            <span class="app-brand-mark"><i class="bi bi-box-seam"></i></span>
            Inventaris Aset
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Menu">
            <i class="bi bi-list fs-3"></i>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto ms-md-3 mt-3 mt-md-0 gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('assets.*') ? 'active' : '' }}"
                        href="{{ route('assets.index') }}">
                        <i class="bi bi-grid"></i> Daftar Aset
                    </a>
                </li>
            </ul>

            <div class="user-chip">
                <span class="user-avatar">{{ mb_substr(auth()->user()->name, 0, 1) }}</span>
                <div class="user-meta me-2">
                    <div class="name">{{ auth()->user()->name }}</div>
                    <div class="role">{{ auth()->user()->role }}</div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

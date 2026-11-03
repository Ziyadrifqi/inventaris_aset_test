@extends('layouts.app')
@section('title', 'Login')

@push('styles')
    <style>
        .login-wrapper {
            min-height: 100vh;
            background: var(--surface);
        }

        .login-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 12px 32px rgba(16, 24, 40, .08);
        }

        .login-image-side {
            position: relative;
            background: var(--accent-soft);
            border-right: 1px solid var(--line);
            min-height: 100%;
        }

        .login-image-side img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .login-form-side {
            padding: 3rem 2.75rem;
        }

        .login-brand {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .login-brand .mark {
            width: 32px;
            height: 32px;
            border-radius: .5rem;
            background: var(--accent);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .input-group-text {
            background: #fff;
            color: var(--muted);
            border-color: #d8dce3;
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .btn {
            border-color: var(--accent);
        }

        .input-group .form-control:focus {
            box-shadow: none;
        }

        .input-group:focus-within {
            border-radius: .6rem;
            box-shadow: 0 0 0 .2rem rgba(47, 91, 234, .15);
        }

        .btn-toggle {
            border-color: #d8dce3;
            color: var(--muted);
            background: #fff;
        }

        .btn-toggle:hover {
            background: #fff;
            color: var(--ink);
            border-color: #d8dce3;
        }

        @media (max-width: 575.98px) {
            .login-form-side {
                padding: 2rem 1.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="login-wrapper d-flex align-items-center justify-content-center p-3 position-fixed top-0 start-0 w-100"
        style="z-index: 1; overflow-y: auto;">
        <div class="col-12 col-md-10 col-lg-9 col-xl-8">
            <div class="login-card">
                <div class="row g-0">

                    {{-- Kiri: ilustrasi --}}
                    <div class="col-md-5 d-none d-md-block login-image-side">
                        <img src="{{ asset('images/login-illustration.jpg') }}" width="626" height="626"
                            alt="Ilustrasi login">
                    </div>

                    {{-- Kanan: form --}}
                    <div class="col-md-7">
                        <div class="login-form-side h-100 d-flex flex-column justify-content-center">
                            <div class="login-brand">
                                <span class="mark"><i class="bi bi-box-seam"></i></span>
                                Inventaris Aset
                            </div>

                            <h1 class="h4 fw-bold mb-1">Selamat datang kembali</h1>
                            <p class="text-muted mb-4">Masuk untuk melanjutkan ke dashboard.</p>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Masukkan E-mail Anda" autocomplete="username" autofocus>
                                    </div>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Masukkan password" autocomplete="current-password">
                                        <button class="btn btn-toggle" type="button" onclick="togglePassword()"
                                            tabindex="-1" aria-label="Tampilkan password">
                                            <i class="bi bi-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label small" for="remember">Ingat saya</label>
                                </div>

                                <button class="btn btn-primary w-100 py-2">
                                    Masuk <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <p class="text-center text-muted small mt-3 mb-0">
                &copy; {{ date('Y') }} {{ config('app.name') }}
            </p>
        </div>
    </div>

    @push('scripts')
        <script>
            function togglePassword() {
                const input = document.getElementById('password');
                const icon = document.getElementById('toggleIcon');
                const show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                icon.classList.toggle('bi-eye', !show);
                icon.classList.toggle('bi-eye-slash', show);
            }
        </script>
    @endpush
@endsection

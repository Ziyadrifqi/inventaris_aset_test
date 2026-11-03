@if (session('success'))
    <div class="app-alert alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle-fill lead-icon"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif

@if (session('error'))
    <div class="app-alert is-error alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-exclamation-circle-fill lead-icon"></i>
        <div>{{ session('error') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
@endif

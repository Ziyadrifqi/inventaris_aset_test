@extends('layouts.app')
@section('title', 'Edit Aset')

@section('content')
    <div class="mb-3">
        <a href="{{ route('assets.index') }}" class="back-link text-muted text-decoration-none small fw-medium">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke daftar
        </a>
    </div>

    <form method="POST" action="{{ route('assets.update', $asset) }}" novalidate class="card form-card overflow-hidden">
        @method('PUT')
        <div class="form-head">
            <h1>Edit Aset</h1>
            <div class="text-muted small">Perbarui data aset <span class="asset-code">{{ $asset->kode }}</span></div>
        </div>
        <div class="form-body">
            @include('assets._form')
        </div>
        <div class="form-foot d-flex flex-column-reverse flex-sm-row justify-content-sm-end gap-2">
            <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary">Batal</a>
            <button class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> Simpan Perubahan</button>
        </div>
    </form>
@endsection

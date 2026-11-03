@extends('layouts.app')
@section('title', 'Daftar Aset')

@push('styles')
    <style>
        .page-head h1 {
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: -.02em;
        }

        .filter-bar .form-control,
        .filter-bar .form-select {
            background-color: #fff;
        }

        .search-wrap {
            position: relative;
        }

        .search-wrap i {
            position: absolute;
            left: .85rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
        }

        .search-wrap .form-control {
            padding-left: 2.4rem;
        }

        .asset-name {
            font-weight: 600;
            color: var(--ink);
        }

        .num {
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
        }

        .table-hover>tbody>tr:hover>* {
            --bs-table-hover-bg: #fafbff;
        }

        .empty-state {
            padding: 3.5rem 1rem;
            text-align: center;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 2rem;
            display: block;
            margin-bottom: .5rem;
            opacity: .6;
        }

        .btn-detail {
            --bs-btn-color: var(--accent);
            --bs-btn-border-color: transparent;
            --bs-btn-hover-bg: var(--accent-soft);
            --bs-btn-hover-color: var(--accent-dark);
            --bs-btn-hover-border-color: transparent;
            --bs-btn-active-bg: var(--accent-soft);
            --bs-btn-active-color: var(--accent-dark);
            --bs-btn-active-border-color: transparent;
        }
    </style>
@endpush

@section('content')
    <div class="page-head d-flex flex-wrap justify-content-between align-items-end gap-2 mb-4">
        <div>
            <h1 class="mb-1">Daftar Aset</h1>
            <div class="text-muted small">
                @if ($assets->total() > 0)
                    Menampilkan {{ $assets->firstItem() }}-{{ $assets->lastItem() }} dari {{ $assets->total() }} aset
                @else
                    0 aset ditemukan
                @endif
            </div>
        </div>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('assets.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah Aset
            </a>
        @endif
    </div>

    <form method="GET" class="filter-bar row g-2 mb-3">
        <div class="col-12 col-md-4">
            <div class="search-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                    placeholder="Cari nama atau kode...">
            </div>
        </div>
        <div class="col-6 col-md-3">
            <select name="category_id" class="form-select">
                <option value="">Semua kategori</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}" @selected(request('category_id') == $c->id)>{{ $c->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua status</option>
                @foreach (\App\Models\Asset::STATUSES as $s)
                    <option value="{{ $s }}" @selected(request('status') == $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-2 d-grid d-md-flex gap-2">
            <button class="btn btn-primary flex-md-fill">Cari</button>
            <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary" title="Reset filter">
                <i class="bi bi-arrow-counterclockwise"></i><span class="d-md-none ms-1">Reset</span>
            </a>
        </div>
    </form>

    <div class="card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 1%">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th class="text-end">Nilai</th>
                        <th class="text-end"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assets as $asset)
                        <tr>
                            <td class="text-muted num">{{ $assets->firstItem() + $loop->index }}</td>
                            <td><span class="asset-code">{{ $asset->kode }}</span></td>
                            <td class="asset-name">{{ $asset->nama }}</td>
                            <td>{{ $asset->category->nama }}</td>
                            <td class="text-muted">{{ $asset->lokasi }}</td>
                            <td>
                                <span
                                    class="badge badge-soft bg-{{ $asset->status_badge }}-subtle text-{{ $asset->status_badge }}-emphasis">
                                    {{ ucfirst($asset->status) }}
                                </span>
                            </td>
                            <td class="text-end num">Rp {{ number_format($asset->nilai, 0, ',', '.') }}</td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('assets.show', $asset) }}" class="btn btn-sm btn-detail">
                                    Detail <i class="bi bi-chevron-right small"></i>
                                </a>

                                @if (auth()->user()->isAdmin())
                                    <a href="{{ route('assets.edit', $asset) }}" class="btn btn-sm btn-outline-secondary"
                                        title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-action="{{ route('assets.destroy', $asset) }}"
                                        data-label="{{ $asset->kode }} - {{ $asset->nama }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    Tidak ada aset yang cocok.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-center justify-content-md-end">
        {{ $assets->links() }}
    </div>

    @if (auth()->user()->isAdmin())
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form method="POST" id="deleteForm" class="modal-content">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body text-center p-4">
                        <span
                            class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger-subtle text-danger mb-3"
                            style="width:56px;height:56px;font-size:1.6rem">
                            <i class="bi bi-trash"></i>
                        </span>
                        <h2 class="h5 fw-bold">Hapus aset?</h2>
                        <p class="text-muted mb-0">
                            <strong id="deleteLabel"></strong><br>
                            akan dihapus dan tidak bisa dikembalikan.
                        </p>
                    </div>
                    <div class="modal-footer border-0 justify-content-center gap-2 pt-0 pb-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Ya, hapus</button>
                    </div>
                </form>
            </div>
        </div>

        @push('scripts')
            <script>
                document.getElementById('deleteModal').addEventListener('show.bs.modal', function(e) {
                    const btn = e.relatedTarget;
                    document.getElementById('deleteForm').action = btn.dataset.action;
                    document.getElementById('deleteLabel').textContent = btn.dataset.label;
                });
            </script>
        @endpush
    @endif
@endsection

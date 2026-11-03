@extends('layouts.app')
@section('title', 'Detail Aset')

@push('styles')
    <style>
        .back-link {
            color: var(--muted);
            text-decoration: none;
            font-weight: 500;
            font-size: .88rem;
        }

        .back-link:hover {
            color: var(--ink);
        }

        .detail-head {
            padding: 1.5rem 1.75rem;
            border-bottom: 1px solid var(--line);
        }

        .detail-head h1 {
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: -.02em;
        }

        .asset-code {
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            font-size: .82rem;
            color: var(--muted);
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: .35rem;
            padding: .15rem .45rem;
        }

        .badge-soft {
            font-weight: 500;
            padding: .4em .75em;
            border-radius: 999px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0;
        }

        .detail-item {
            padding: 1.1rem 1.75rem;
            border-bottom: 1px solid var(--line);
        }

        .detail-item:nth-last-child(-n+2) {
            border-bottom: 0;
        }

        .detail-label {
            font-size: .72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: var(--muted);
            margin-bottom: .2rem;
        }

        .detail-value {
            font-weight: 500;
            color: var(--ink);
        }

        .detail-value.big {
            font-size: 1.2rem;
            font-weight: 700;
            font-variant-numeric: tabular-nums;
        }

        @media (max-width: 575.98px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .detail-item:nth-last-child(2) {
                border-bottom: 1px solid var(--line);
            }

            .detail-head,
            .detail-item {
                padding-inline: 1.25rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="mb-3">
        <a href="{{ route('assets.index') }}" class="back-link">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke daftar
        </a>
    </div>

    <div class="card overflow-hidden" style="max-width: 820px;">
        <div class="detail-head d-flex flex-wrap justify-content-between align-items-start gap-2">
            <div>
                <span class="asset-code">{{ $asset->kode }}</span>
                <h1 class="mt-2 mb-0">{{ $asset->nama }}</h1>
            </div>
            <span class="badge badge-soft bg-{{ $asset->status_badge }}-subtle text-{{ $asset->status_badge }}-emphasis">
                {{ ucfirst($asset->status) }}
            </span>
        </div>

        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">Kategori</div>
                <div class="detail-value">{{ $asset->category->nama }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Lokasi</div>
                <div class="detail-value">{{ $asset->lokasi }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Tanggal Beli</div>
                <div class="detail-value">{{ $asset->tanggal_beli->format('d M Y') }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Nilai</div>
                <div class="detail-value big">Rp {{ number_format($asset->nilai, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
@endsection

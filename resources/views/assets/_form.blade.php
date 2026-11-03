@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label for="kode" class="form-label">Kode</label>
        <input type="text" id="kode" name="kode" value="{{ old('kode', $asset->kode) }}"
            class="form-control @error('kode') is-invalid @enderror" placeholder="Contoh: AST-013">
        @error('kode')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $asset->nama) }}"
            class="form-control @error('nama') is-invalid @enderror">
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="category_id" class="form-label">Kategori</label>
        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
            <option value="">-- Pilih kategori --</option>
            @foreach ($categories as $c)
                <option value="{{ $c->id }}" @selected(old('category_id', $asset->category_id) == $c->id)>{{ $c->nama }}</option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="lokasi" class="form-label">Lokasi</label>
        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $asset->lokasi) }}"
            class="form-control @error('lokasi') is-invalid @enderror">
        @error('lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-4">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
            @foreach (\App\Models\Asset::STATUSES as $s)
                <option value="{{ $s }}" @selected(old('status', $asset->status) == $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-4">
        <label for="tanggal_beli" class="form-label">Tanggal Beli</label>
        <input type="date" id="tanggal_beli" name="tanggal_beli"
            value="{{ old('tanggal_beli', $asset->tanggal_beli?->format('Y-m-d')) }}"
            class="form-control @error('tanggal_beli') is-invalid @enderror">
        @error('tanggal_beli')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-4">
        <label for="nilai" class="form-label">Nilai (Rp)</label>
        <input type="number" step="0.01" min="0" id="nilai" name="nilai"
            value="{{ old('nilai', $asset->nilai) }}" class="form-control @error('nilai') is-invalid @enderror">
        @error('nilai')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mt-4 d-flex flex-column flex-sm-row gap-2">
    <button class="btn btn-primary">
        <i class="bi bi-check-lg me-1"></i> Simpan
    </button>
    <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>

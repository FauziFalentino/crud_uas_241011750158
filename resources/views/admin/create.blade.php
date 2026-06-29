@extends('layouts.app')

@section('title', 'Tambah Merchandise')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Navigation Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item active text-secondary fw-semibold" aria-current="page">Tambah Merchandise</li>
            </ol>
        </nav>

        <div class="card border-0 rounded-4 shadow-sm overflow-hidden mb-5">
            <!-- Header -->
            <div class="card-header bg-dark text-white py-4 px-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-25 rounded-3 p-2 text-primary-light">
                        <i class="fa-solid fa-plus-circle fs-3 text-white"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold font-heading">Tambah Merchandise Event</h4>
                        <p class="mb-0 text-white-50 small">Masukkan informasi detail data barang merchandise baru di bawah ini.</p>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="card-body p-4 p-md-5 bg-white">
                <form action="{{ route('admin.merchandise.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <!-- Nama Barang -->
                        <div class="col-12">
                            <label for="nama_barang" class="form-label fw-semibold text-secondary small">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="nama_barang" 
                                   id="nama_barang" 
                                   class="form-control bg-light @error('nama_barang') is-invalid @enderror" 
                                   value="{{ old('nama_barang') }}" 
                                   placeholder="Masukkan nama merchandise (contoh: Kaos Event Merdeka)" 
                                   required>
                            @error('nama_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Event Terkait -->
                        <div class="col-12">
                            <label for="event_terkait" class="form-label fw-semibold text-secondary small">Event Terkait <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="event_terkait" 
                                   id="event_terkait" 
                                   class="form-control bg-light @error('event_terkait') is-invalid @enderror" 
                                   value="{{ old('event_terkait') }}" 
                                   placeholder="Nama event yang berhubungan (contoh: Festival Musik 2026)" 
                                   required>
                            @error('event_terkait')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div class="col-md-6">
                            <label for="harga" class="form-label fw-semibold text-secondary small">Harga Barang (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">Rp</span>
                                <input type="number" 
                                       name="harga" 
                                       id="harga" 
                                       class="form-control bg-light @error('harga') is-invalid @enderror" 
                                       value="{{ old('harga') }}" 
                                       placeholder="Contoh: 150000" 
                                       min="0" 
                                       required>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Stok -->
                        <div class="col-md-6">
                            <label for="stok" class="form-label fw-semibold text-secondary small">Stok Awal <span class="text-danger">*</span></label>
                            <input type="number" 
                                   name="stok" 
                                   id="stok" 
                                   class="form-control bg-light @error('stok') is-invalid @enderror" 
                                   value="{{ old('stok') }}" 
                                   placeholder="Contoh: 50" 
                                   min="0" 
                                   required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto / Gambar -->
                        <div class="col-12">
                            <label for="gambar" class="form-label fw-semibold text-secondary small">Foto Merchandise <span class="text-danger">*</span></label>
                            <input type="file" 
                                   name="gambar" 
                                   id="gambar" 
                                   class="form-control bg-light @error('gambar') is-invalid @enderror" 
                                   accept="image/*" 
                                   required>
                            <div class="form-text text-muted small">Format yang didukung: JPEG, PNG, JPG, GIF. Ukuran maksimum file: 2MB.</div>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-3 mt-5 pt-4 border-top">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-custom-outline">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-custom-primary">
                            <i class="fa-solid fa-save me-2"></i>Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

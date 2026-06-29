@extends('layouts.app')

@section('title', 'Katalog Merchandise')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col-md-8">
        <h1 class="display-5 text-dark fw-bold mb-2" style="font-family: var(--font-heading);">Katalog Merchandise Event</h1>
        <p class="text-muted fs-5">Daftar koleksi merchandise resmi dari berbagai event menarik kami.</p>
    </div>
    <div class="col-md-4 text-md-end">
        <span class="badge bg-secondary py-2 px-3 fs-6 rounded-pill">Total: {{ $merchandises->count() }} Item</span>
    </div>
</div>

@if($merchandises->isEmpty())
    <div class="card border-0 rounded-4 shadow-sm py-5 text-center my-4 glass-panel">
        <div class="card-body">
            <i class="fa-solid fa-box-open text-muted mb-3" style="font-size: 4rem;"></i>
            <h3 class="text-dark fw-semibold">Belum Ada Merchandise</h3>
            <p class="text-muted">Maaf, saat ini katalog sedang kosong. Silakan kembali lagi nanti.</p>
            @auth
                <a href="{{ route('admin.merchandise.create') }}" class="btn btn-custom-primary mt-2">
                    <i class="fa-solid fa-plus me-2"></i>Tambah Merchandise Pertama
                </a>
            @endauth
        </div>
    </div>
@else
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 mb-5">
        @foreach($merchandises as $merch)
            <div class="col">
                <div class="card card-custom h-100 border-0">
                    <!-- Image Wrapper with ratio and object-fit -->
                    <div class="position-relative" style="height: 240px; overflow: hidden; background-color: #f1f5f9;">
                        @if($merch->gambar)
                            <img src="{{ asset($merch->gambar) }}" class="w-100 h-100 object-fit-cover" alt="{{ $merch->nama_barang }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center w-100 h-100 bg-light text-muted">
                                <i class="fa-solid fa-image fs-1"></i>
                            </div>
                        @endif
                        
                        <!-- Event Badge -->
                        <span class="position-absolute top-0 start-0 bg-dark text-white text-xs px-3 py-1.5 rounded-bottom-end shadow-sm" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px;">
                            <i class="fa-solid fa-calendar-day me-1"></i>{{ $merch->event_terkait }}
                        </span>
                        
                        <!-- Stock Status Badge -->
                        <span class="position-absolute top-0 end-0 m-2 shadow-sm">
                            @if($merch->stok == 0)
                                <span class="badge bg-danger rounded-pill py-1.5 px-2.5">Habis</span>
                            @elseif($merch->stok < 5)
                                <span class="badge bg-warning text-dark rounded-pill py-1.5 px-2.5">Stok Tipis ({{ $merch->stok }})</span>
                            @else
                                <span class="badge bg-success rounded-pill py-1.5 px-2.5">Ready ({{ $merch->stok }})</span>
                            @endif
                        </span>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title text-dark fw-bold mb-1 text-truncate" title="{{ $merch->nama_barang }}">
                            {{ $merch->nama_barang }}
                        </h5>
                        <p class="text-muted small mb-3">Event: <span class="fw-semibold text-secondary">{{ $merch->event_terkait }}</span></p>
                        
                        <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted d-block small" style="font-size: 0.75rem;">Harga</span>
                                <span class="text-primary-dark fw-extrabold fs-5 font-heading">
                                    Rp{{ number_format($merch->harga, 0, ',', '.') }}
                                </span>
                            </div>
                            <div>
                                <span class="text-muted d-block text-end small" style="font-size: 0.75rem;">Stok</span>
                                <span class="fw-semibold text-dark d-block text-end">{{ $merch->stok }} pcs</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection

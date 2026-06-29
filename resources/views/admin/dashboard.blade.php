@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('styles')
<style>
    /* Dashboard Specific Styles */
    .sidebar {
        background-color: var(--secondary);
        color: #fff;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: var(--shadow-md);
    }
    .sidebar .nav-link {
        color: #94a3b8;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background-color: rgba(99, 102, 241, 0.15);
        color: var(--primary-light);
    }
    .sidebar .nav-link i {
        width: 24px;
    }
    .table-container {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
    }
    .thumbnail-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }
</style>
@endsection

@section('content')
<div class="row g-4">
    <!-- Sidebar Navigation -->
    <div class="col-lg-3 col-xl-2">
        <div class="sidebar mb-4">
            <h5 class="fw-bold mb-4 text-white font-heading px-2">Menu Admin</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-gauge"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.merchandise.create') }}">
                        <i class="fa-solid fa-plus"></i>Tambah Baru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('catalog') }}">
                        <i class="fa-solid fa-eye"></i>Lihat Katalog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.merchandise.pdf') }}">
                        <i class="fa-solid fa-file-pdf"></i>Ekspor PDF
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content Panel -->
    <div class="col-lg-9 col-xl-10">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('catalog') }}" class="text-decoration-none text-muted">UAS Merch</a></li>
                        <li class="breadcrumb-item active text-secondary fw-semibold" aria-current="page">Admin Dashboard</li>
                    </ol>
                </nav>
                <h1 class="h2 text-dark fw-bold mb-0">Kelola Data Merchandise</h1>
            </div>
            
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.merchandise.pdf') }}" class="btn btn-custom-outline">
                    <i class="fa-solid fa-file-pdf me-2 text-danger"></i>Export PDF
                </a>
                <a href="{{ route('admin.merchandise.create') }}" class="btn btn-custom-primary">
                    <i class="fa-solid fa-plus me-2"></i>Tambah Merchandise
                </a>
            </div>
        </div>

        <!-- DataTable Container -->
        <div class="table-container">
            <div class="table-responsive">
                <table id="merchandiseTable" class="table table-hover align-middle w-100" style="border-collapse: collapse;">
                    <thead>
                        <tr class="table-light border-bottom">
                            <th class="py-3 px-3 text-secondary text-uppercase small" style="width: 5%">ID</th>
                            <th class="py-3 text-secondary text-uppercase small" style="width: 10%">Gambar</th>
                            <th class="py-3 text-secondary text-uppercase small">Nama Barang</th>
                            <th class="py-3 text-secondary text-uppercase small">Event Terkait</th>
                            <th class="py-3 text-secondary text-uppercase small">Harga</th>
                            <th class="py-3 text-secondary text-uppercase small" style="width: 10%">Stok</th>
                            <th class="py-3 text-secondary text-uppercase text-center small" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($merchandises as $merch)
                            <tr class="border-bottom">
                                <td class="px-3 fw-semibold text-secondary">#{{ $merch->id_barang }}</td>
                                <td>
                                    @if($merch->gambar)
                                        <img src="{{ asset($merch->gambar) }}" class="thumbnail-img" alt="{{ $merch->nama_barang }}">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-light thumbnail-img text-muted">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block">{{ $merch->nama_barang }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border py-1.5 px-2.5">{{ $merch->event_terkait }}</span>
                                </td>
                                <td class="fw-semibold text-primary-dark">
                                    Rp{{ number_format($merch->harga, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if($merch->stok == 0)
                                        <span class="badge bg-danger rounded-pill">Habis</span>
                                    @elseif($merch->stok < 5)
                                        <span class="badge bg-warning text-dark rounded-pill">{{ $merch->stok }} pcs</span>
                                    @else
                                        <span class="badge bg-success rounded-pill">{{ $merch->stok }} pcs</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.merchandise.edit', $merch->id_barang) }}" class="btn btn-sm btn-outline-primary rounded-3 px-2.5" title="Edit Data">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.merchandise.destroy', $merch->id_barang) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus merchandise {{ $merch->nama_barang }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-3 px-2.5" title="Hapus Data">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <!-- Empty row fallback handled by DataTables automatically, but good to have here as well -->
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#merchandiseTable').DataTable({
            responsive: true,
            order: [[0, 'desc']], // Order by ID descending by default
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
            },
            columnDefs: [
                { targets: [1, 6], orderable: false } // Disable sorting on image and actions
            ]
        });
    });
</script>
@endsection

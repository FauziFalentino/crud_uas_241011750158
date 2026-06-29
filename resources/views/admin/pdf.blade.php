<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Merchandise Event</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #334155;
            padding-bottom: 15px;
        }
        .header h2 {
            margin: 0 0 5px 0;
            color: #0f172a;
            font-size: 22px;
            text-transform: uppercase;
        }
        .header p {
            margin: 0;
            color: #64748b;
            font-size: 12px;
        }
        .meta-info {
            margin-bottom: 20px;
            font-size: 11px;
            color: #475569;
        }
        .meta-info table {
            width: 100%;
        }
        .meta-info td {
            padding: 2px 0;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .report-table th {
            background-color: #0f172a;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
            padding: 10px;
            border: 1px solid #1e293b;
            text-align: left;
        }
        .report-table td {
            padding: 10px;
            border: 1px solid #e2e8f0;
            vertical-align: middle;
        }
        .report-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .thumbnail {
            width: 45px;
            height: 45px;
            border-radius: 4px;
        }
        .price {
            text-align: right;
            font-weight: bold;
            color: #4f46e5;
        }
        .stock {
            text-align: center;
        }
        .badge-danger {
            color: #ef4444;
            font-weight: bold;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
        }
        .total-summary {
            margin-top: 20px;
            text-align: right;
            font-size: 13px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Data Merchandise Event</h2>
        <p>Ujian Akhir Semester (UAS) Rekayasa Web - NIM 241011750158</p>
    </div>

    <div class="meta-info">
        <table>
            <tr>
                <td style="width: 15%;"><strong>Dicetak Oleh</strong></td>
                <td style="width: 35%;">: Administrator (UAS Merch)</td>
                <td style="width: 20%;"><strong>Tanggal Cetak</strong></td>
                <td>: {{ date('d F Y, H:i') }} WIB</td>
            </tr>
            <tr>
                <td><strong>Database</strong></td>
                <td>: db_uas_241011750158</td>
                <td><strong>Jumlah Item</strong></td>
                <td>: {{ $merchandises->count() }} Barang</td>
            </tr>
        </table>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th style="width: 8%; text-align: center;">ID</th>
                <th style="width: 12%; text-align: center;">Foto</th>
                <th style="width: 35%;">Nama Barang</th>
                <th style="width: 20%;">Event Terkait</th>
                <th style="width: 15%; text-align: right;">Harga</th>
                <th style="width: 10%; text-align: center;">Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($merchandises as $merch)
                <tr>
                    <td style="text-align: center; font-weight: bold; color: #64748b;">#{{ $merch->id_barang }}</td>
                    <td style="text-align: center;">
                        @if($merch->gambar && file_exists(public_path($merch->gambar)))
                            <img src="{{ public_path($merch->gambar) }}" class="thumbnail" alt="Foto">
                        @else
                            <span style="color: #cbd5e1; font-size: 9px;">Tidak ada foto</span>
                        @endif
                    </td>
                    <td><strong style="color: #1e293b;">{{ $merch->nama_barang }}</strong></td>
                    <td>{{ $merch->event_terkait }}</td>
                    <td class="price">Rp{{ number_format($merch->harga, 0, ',', '.') }}</td>
                    <td class="stock">
                        @if($merch->stok == 0)
                            <span class="badge-danger">Habis</span>
                        @else
                            {{ $merch->stok }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-summary">
        Total Nilai Aset Stok: Rp{{ number_format($merchandises->sum(fn($m) => $m->harga * $m->stok), 0, ',', '.') }}
    </div>

    <div class="footer">
        Halaman 1 dari 1 - Dokumen ini dibuat otomatis oleh Sistem CRUD UAS Laravel.
    </div>

</body>
</html>

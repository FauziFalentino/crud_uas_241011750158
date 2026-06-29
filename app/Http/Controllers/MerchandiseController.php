<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource for public catalog.
     */
    public function catalog()
    {
        $merchandises = Merchandise::latest()->get();
        return view('catalog', compact('merchandises'));
    }

    /**
     * Display a listing of the resource for administrative dashboard.
     */
    public function dashboard()
    {
        $merchandises = Merchandise::latest()->get();
        return view('admin.dashboard', compact('merchandises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'   => 'required|string|max:255',
            'event_terkait' => 'required|string|max:255',
            'harga'         => 'required|integer|min:0',
            'stok'          => 'required|integer|min:0',
            'gambar'        => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_barang.required'   => 'Nama barang wajib diisi.',
            'event_terkait.required' => 'Event terkait wajib diisi.',
            'harga.required'         => 'Harga wajib diisi.',
            'harga.integer'          => 'Harga harus berupa angka.',
            'harga.min'              => 'Harga tidak boleh negatif.',
            'stok.required'          => 'Stok wajib diisi.',
            'stok.integer'           => 'Stok harus berupa angka.',
            'stok.min'               => 'Stok tidak boleh negatif.',
            'gambar.required'        => 'Gambar wajib diunggah.',
            'gambar.image'           => 'File harus berupa gambar.',
            'gambar.mimes'           => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'gambar.max'             => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Ensure path exists
            $path = public_path('uploads/merchandise');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true, true);
            }
            
            $file->move($path, $filename);
            $data['gambar'] = 'uploads/merchandise/' . $filename;
        }

        Merchandise::create($data);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Data merchandise berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $merchandise = Merchandise::findOrFail($id);
        return view('admin.edit', compact('merchandise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $merchandise = Merchandise::findOrFail($id);

        $request->validate([
            'nama_barang'   => 'required|string|max:255',
            'event_terkait' => 'required|string|max:255',
            'harga'         => 'required|integer|min:0',
            'stok'          => 'required|integer|min:0',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_barang.required'   => 'Nama barang wajib diisi.',
            'event_terkait.required' => 'Event terkait wajib diisi.',
            'harga.required'         => 'Harga wajib diisi.',
            'harga.integer'          => 'Harga harus berupa angka.',
            'harga.min'              => 'Harga tidak boleh negatif.',
            'stok.required'          => 'Stok wajib diisi.',
            'stok.integer'           => 'Stok harus berupa angka.',
            'stok.min'               => 'Stok tidak boleh negatif.',
            'gambar.image'           => 'File harus berupa gambar.',
            'gambar.mimes'           => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'gambar.max'             => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            // Delete old file
            if ($merchandise->gambar && File::exists(public_path($merchandise->gambar))) {
                File::delete(public_path($merchandise->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $path = public_path('uploads/merchandise');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true, true);
            }
            
            $file->move($path, $filename);
            $data['gambar'] = 'uploads/merchandise/' . $filename;
        }

        $merchandise->update($data);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Data merchandise berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $merchandise = Merchandise::findOrFail($id);

        // Delete image file if exists
        if ($merchandise->gambar && File::exists(public_path($merchandise->gambar))) {
            File::delete(public_path($merchandise->gambar));
        }

        $merchandise->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Data merchandise berhasil dihapus!');
    }

    /**
     * Export the resource list as PDF.
     */
    public function exportPDF()
    {
        $merchandises = Merchandise::oldest('nama_barang')->get();
        
        $pdf = Pdf::loadView('admin.pdf', compact('merchandises'));
        
        // Custom paper size or orientation
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->download('laporan_merchandise_' . date('Ymd_His') . '.pdf');
    }
}

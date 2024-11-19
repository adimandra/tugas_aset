<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Kategori;

class AssetController extends Controller
{
    // Menampilkan daftar aset
    public function index() {
        $assets = Asset::with('kategori')->get();
        return view('assets.index', compact('assets'));
    }

    public function create() {
        $kategori = Kategori::orderBy('id', 'desc')->get();
        $kodeAset = $this->generateUniqueKodeAset();

        return view('assets.create', compact('kodeAset', 'kategori'));
    }

    // Fungsi untuk menghasilkan kode aset unik
    protected function generateUniqueKodeAset()
    {
        do {
            $lastAsset = Asset::orderBy('id', 'desc')->first();
            $nextId = $lastAsset ? $lastAsset->id + 1 : 1;
            $kodeAset = 'AST' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        } while (Asset::where('kode_aset', $kodeAset)->exists());

        return $kodeAset;
    }

    // Menyimpan aset baru
    public function store(Request $request) {
        $request->validate([
            'nama_aset' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'kategori_id' => 'required'
        ]);

        $kodeAset = $this->generateUniqueKodeAset();
        $fileName = null;

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Gambar'), $fileName);
        }

        Asset::create([
            'kode_aset' => $kodeAset,
            'nama_aset' => $request->input('nama_aset'),
            'keterangan' => $request->input('keterangan'),
            'link_aset' => $fileName,
            'tipe_file' => $file->getClientMimeType(),
            'gambar' => $fileName,
            'kategori_id' => $request->input('kategori_id'),
        ]);

        return redirect()->route('assets.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    // Menampilkan formulir untuk mengedit aset
    public function edit($id) {
        $asset = Asset::findOrFail($id);
        $kategori = Kategori::all();

        return view('assets.edit', compact('asset', 'kategori'));
    }

    // Memperbarui aset
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_aset' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'kategori_id' => 'required'
        ]);

        $asset = Asset::findOrFail($id);

        // Proses gambar jika di-upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Gambar'), $filename);

            // Hapus gambar lama jika ada
            if ($asset->gambar && file_exists(public_path('Gambar/' . $asset->gambar))) {
                unlink(public_path('Gambar/' . $asset->gambar));
            }

            // Update data gambar
            $asset->gambar = $filename;
            $asset->link_aset = $filename;
            $asset->tipe_file = $file->getClientMimeType();
        }

        // Update data lainnya
        $asset->nama_aset = $request->input('nama_aset');
        $asset->keterangan = $request->input('keterangan');
        $asset->kategori_id = $request->kategori_id;

        $asset->save();

        return redirect()->route('assets.index')->with('success', 'Data aset berhasil di edit');
    }

    // Menghapus aset (Soft delete dan rename gambar)
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);

        // Hapus gambar lama jika ada
        if ($asset->gambar && file_exists(public_path('Gambar/' . $asset->gambar))) {
            $oldFilePath = public_path('Gambar/' . $asset->gambar);
            $newFileName = 'deleted_' . $asset->gambar;
            $newFilePath = public_path('Gambar/' . $newFileName);

            // Ganti nama file
            rename($oldFilePath, $newFilePath);

            // Simpan hanya nama file
            $asset->gambar = $newFileName;
            $asset->link_aset = $newFileName; // Simpan hanya nama file
            $asset->save();
        }

        // Hapus record dari database
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset berhasil dihapus.');
    }

    // Menampilkan formulir untuk memperbarui aset
    public function perbarui($id)
    {
        $aset = Asset::find($id);

        if (!$aset) {
            return redirect()->route('assets.index')->with('error', 'Aset tidak ditemukan');
        }

        return view('assets.perbarui', compact('aset'));
    }

    // Menyimpan gambar baru
    public function simpanGambar(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'asset_id' => 'required|integer',
        ]);

        $image = $request->file('profile_picture');
        $imagePath = $image->store('images', 'public');

        $assetId = $request->input('asset_id');
        $asset = Asset::findOrFail($assetId);

        if ($asset) {
            // Hapus gambar lama jika ada
            if ($asset->gambar && file_exists(public_path('Gambar/' . $asset->gambar))) {
                unlink(public_path('Gambar/' . $asset->gambar));
            }

            // Simpan gambar baru
            $asset->gambar = basename($imagePath);
            $asset->link_aset = basename($imagePath);
            $asset->save();

            return redirect()->route('assets.index')->with('success', 'Gambar berhasil diperbarui.');
        }

        return redirect()->back()->withErrors('Gagal update gambar.');
    }

    // Mengupdate hanya gambar tanpa mengubah data lainnya
    public function updateGambar(Request $request, $id)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $asset = Asset::findOrFail($id);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Gambar'), $filename);

            // Hapus gambar lama jika ada
            if ($asset->gambar && file_exists(public_path('Gambar/' . $asset->gambar))) {
                unlink(public_path('Gambar/' . $asset->gambar));
            }

            // Update data gambar
            $asset->gambar = $filename;
            $asset->link_aset = $filename; // Simpan hanya nama file
            $asset->tipe_file = $file->getClientMimeType();
        }

        // Simpan perubahan
        $asset->save();

        return redirect()->route('assets.index')->with('success', 'Gambar aset berhasil diperbarui.');
    }

    public function restore($id)
    {
        $asset = Asset::withTrashed()->findOrFail($id);

        if ($asset->link_aset && strpos($asset->link_aset, 'deleted_') === 0) {
            $deletedFilePath = public_path('Gambar/' . $asset->link_aset);
            $originalFileName = substr($asset->link_aset, 8);
            $originalFilePath = public_path('Gambar/' . $originalFileName);

            if (file_exists($deletedFilePath)) {
                rename($deletedFilePath, $originalFilePath);

                $asset->link_aset = $originalFileName;
                $asset->save();
            }
        }

        $asset->restore();

        return redirect()->route('assets.index')->with('success', 'Asset berhasil dipulihkan.');
    }

    public function show($id)
    {
        // Temukan aset berdasarkan ID
        $asset = Asset::findOrFail($id);

        // Kirim data asset ke tampilan 'assets.show'
        return view('assets.show', compact('asset'));
    }
}

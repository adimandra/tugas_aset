<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('kategori.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|unique:data_kategori,kategori',
            'keterangan' => 'nullable|string'
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan detail kategori tertentu
    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.show', compact('kategori'));
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {

        $kategori = Kategori::findOrFail($id);
        
        return view('kategori.edit', compact('kategori'));
    }

    // Memperbarui kategori
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $request->validate([
            'kategori' => 'required|unique:data_kategori,kategori,' . $id,
            'keterangan' => 'nullable|string'
        ]);


        $kategori->update($request->only('kategori', 'keterangan'));

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

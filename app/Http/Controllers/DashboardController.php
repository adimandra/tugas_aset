<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        $label_kategori = array();
        $count_data = array();
        $kategories = Kategori::get();
        foreach ($kategories as $value) {
            $label_kategori[] = $value->kategori;

            // $getAssetByCategory = Asset::where('kategori_id', $value->id)->count();
            $count_data[] = Asset::where('kategori_id', $value->id)->count();

        }

        // Mengarahkan ke tampilan beranda
        return view('beranda', compact('label_kategori', 'count_data'));
    }
}


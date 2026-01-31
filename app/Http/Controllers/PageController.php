<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kategori;
use App\Models\Setting;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{


    public function index(Request $request)
    {
        $kategoriId = $request->get('kategori'); // optional filter

        $fasilitas = Fasilitas::with('kategori')
            ->when($kategoriId, function ($query) use ($kategoriId) {
                $query->where('id_kategori', $kategoriId);
            })
            ->get();

        // tambahkan photo_url untuk JS
        $fasilitas->map(function ($item) {
            $item->photo_url = Storage::url($item->foto);
            return $item;
        });

        return view('pages.index', [
            'title'      => 'Home',
            'fasilitas'  => $fasilitas,
            'kategoris'  => Kategori::all(),
            'kategoriId' => $kategoriId
        ]);
    }

    public function maps()
    {
        $fasilitas = Fasilitas::all();
        $fasilitas->map(function ($item) {
            $item->photo_url = Storage::url($item->foto);
            return $item;
        });
        $data = [
            'title' => 'Maps',
            'fasilitas' => $fasilitas,
        ];
        return view('pages.maps', $data);
    }


    public function fasilitas()
    {
        $data = [
            'title' => 'Fasilitas Wisata',
            'fasilitas' => Fasilitas::latest()->paginate(6)
        ];
        return view('pages.fasilitas', $data);
    }
    public function detail($slug)
    {
        $fasilitas = Fasilitas::where('slug', $slug)->first();
        $data = [
            'title' => 'Fasilitas : ' . $fasilitas->nama,
            'fasilitas' => $fasilitas,
        ];
        return view('pages.detail-fasilitas', $data);
    }
}

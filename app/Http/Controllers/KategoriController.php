<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Kategori',

        ];
        return view('admin.kategori.index', $data);
    }
    public function getKategoriDataTable()
    {
        $kategori = Kategori::orderByDesc('id');

        return DataTables::of($kategori)
            ->addColumn('action', function ($fasilitas) {
                return view('admin.kategori.components.actions', compact('fasilitas'));
            })

            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',

        ]);

        $fasilitasData = [
            'kategori' => $request->input('kategori'),

        ];


        // If updating an existing record
        if ($request->filled('id')) {
            $Fasilitas = Kategori::find($request->input('id'));

            if (!$Fasilitas) {
                return response()->json(['message' => 'kategori not found'], 404);
            }

            $Fasilitas->update($fasilitasData);
            $message = 'Kategori updated successfully';
        }
        // If creating a new record
        else {
            Kategori::create($fasilitasData);
            $message = 'kategori created successfully';
        }

        return response()->json(['message' => $message]);
    }

    public function destroy($id)
    {
        $fasilitas = Kategori::find($id);

        if (!$fasilitas) {
            return response()->json(['message' => 'Kategori not found'], 404);
        }

        $fasilitas->delete();



        return response()->json(['message' => 'kategori deleted successfully']);
    }
    public function edit($id)
    {
        $fasilitas = Kategori::find($id);

        if (!$fasilitas) {
            return response()->json(['message' => 'kategori not found'], 404);
        }

        return response()->json($fasilitas);
    }
}

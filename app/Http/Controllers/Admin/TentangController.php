<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class TentangController extends Controller
{
    // Menampilkan halaman tentang
    public function index()
    {
        $setting = Setting::first();
        $tentang = Tentang::count();

        return view('admin.tentang.index', compact('setting', 'tentang'));
    }

    // Proses menampilkan data Tentang dengan datatable
    public function listData()
    {
        $data = Tentang::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('gambar', function($row) {
                if ($row->gambar <> '') {
                    $img = '<img src="'.url($row->gambar).'" width="50">';
                } else {
                    $img = '<i class="text-danger">Belum ada gambar</i>';
                }
                return $img;
            })
            ->addColumn('deskripsi', function($row) {
                $text = $row->deskripsi;
                return $text;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('admin.tentang.edit', $row->id).'" class="btn btn-primary btn-sm mr-2">
                        <i class="fas fa-edit"></i>
                    </a>';

                return $btn;
            })
            ->rawColumns(['action', 'gambar', 'deskripsi'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah Tentang
    public function create()
    {
        $setting = Setting::first();

        return view('admin.tentang.add', compact('setting'));
    }

    // Proses tambah Tentang
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|mimes:png,jpg,jpeg,svg,webp'
        ], 
        [
            'required' => ':attribute wajib diisi !!',
            'mimes' => ':attribute format yang diizinkan :mimes'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $gambar = $request->file('gambar');
        $namagambar = 'Tentang-'.str_replace(' ', '-', $request->get('judul')).Str::random(5).'.'.$gambar->extension();
        $gambar->move(public_path('images/'), $namagambar);
        $gambarNama = 'images/'.$namagambar;

        Tentang::create([
            'judul' => $request->get('judul'),
            'deskripsi' => $request->get('deskripsi'),
            'gambar' => $gambarNama
        ]);

        return redirect()->route('admin.tentang')->with('berhasil', 'Berhasil menambahkan Tentang baru.');
    }

    // Menampilkan halaman edit Tentang
    public function edit($id)
    {
        $setting = Setting::first();
        $tentang = Tentang::find($id);

        return view('admin.tentang.edit', compact('setting', 'tentang'));
    }

    // Proses mengupdate Tentang
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'mimes:png,jpg,jpeg,svg,webp'
        ], 
        [
            'required' => ':attribute wajib diisi !!',
            'mimes' => ':attribute format yang diizinkan :mimes'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        if ($request->gambar <> '') {
            $gambar = $request->file('gambar');
            $namagambar = 'Tentang-'.str_replace(' ', '-', $request->get('judul')).Str::random(5).'.'.$gambar->extension();
            $gambar->move(public_path('images/'), $namagambar);
            $gambarNama = 'images/'.$namagambar;
        }

        $kategori = Tentang::find($id);
        $kategori->judul = $request->get('judul');
        $kategori->deskripsi = $request->get('deskripsi');
        if ($request->gambar <> '') {
            File::delete($kategori->gambar);

            $kategori->gambar = $gambarNama;
        }
        $kategori->save();

        return redirect()->route('admin.tentang')->with('berhasil', 'Berhasil mengupdate Tentang.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AllHelper;
use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PengirimanController extends Controller
{
    // Menampilkan halaman pengiriman
    public function index()
    {
        $setting = Setting::first();

        return view('admin.pengiriman.index', compact('setting'));
    }

    // Proses menampilkan data pengiriman dengan datatables
    public function listData()
    {
        $data = Pengiriman::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('biaya', function($row) {
                $hrg = AllHelper::rupiah($row->biaya);
                return $hrg;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('admin.pengiriman.edit', $row->id).'" class="btn btn-primary btn-sm mr-2">
                        <i class="fas fa-edit"></i>
                    </a>';
                $btn .= '<a href="'.route('admin.pengiriman.delete', $row->id).'" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </a>';

                return $btn;
            })
            ->rawColumns(['action', 'biaya'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah pengiriman
    public function create()
    {
        $setting = Setting::first();

        return view('admin.pengiriman.add', compact('setting'));
    }

    // Proses menambahkan pengiriman
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'biaya' => 'required'
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        Pengiriman::create([
            'nama_pengiriman' => $request->get('nama'),
            'biaya' => str_replace(',', '', $request->get('biaya'))
        ]);

        return redirect()->route('admin.pengiriman')->with('berhasil', 'Berhasil menambahkan pengiriman baru.');
    }

    // Menampilkan halaman edit pengiriman
    public function edit($id)
    {
        $setting = Setting::first();
        $pengiriman = Pengiriman::find($id);

        return view('admin.pengiriman.edit', compact('setting', 'pengiriman'));
    }

    // Proses mengupdate pengiriman
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'biaya' => 'required'
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $pengiriman = Pengiriman::find($id);
        $pengiriman->nama_pengiriman = $request->get('nama');
        $pengiriman->biaya = str_replace(',', '', $request->get('biaya'));
        $pengiriman->save();

        return redirect()->route('admin.pengiriman')->with('berhasil', 'Berhasil mengupdate pengiriman.');
    }

    // Proses menghapus pengiriman
    public function destroy($id)
    {
        $pengiriman = Pengiriman::find($id);
        $pengiriman->delete();

        return redirect()->route('admin.pengiriman')->with('berhasil', 'Berhasil menghapus pengiriman.');
    }
}

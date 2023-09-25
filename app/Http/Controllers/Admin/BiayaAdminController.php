<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AllHelper;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BiayaAdminController extends Controller
{
    // Menampilkan halaman biaya admin
    public function index()
    {
        $setting = Setting::first();

        return view('admin.biayaadmin.index', compact('setting'));
    }

    // Proses menampilkan data biayaadmin dengan datatables
    public function listData()
    {
        $data = Setting::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('saldo', function($row) {
                $hrg = AllHelper::rupiah($row->saldo);
                return $hrg;
            })
            ->addColumn('biaya_admin', function($row) {
                $biaya = $row->biaya_admin.'%';
                return $biaya;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('admin.biayaadmin.edit', $row->id).'" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>';

                return $btn;
            })
            ->rawColumns(['action', 'saldo', 'biaya_admin'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman edit biayaadmin
    public function edit($id)
    {
        $setting = Setting::find($id);

        return view('admin.biayaadmin.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'biaya_admin' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $setting = Setting::find($id);
        $setting->biaya_admin = $request->get('biaya_admin');
        $setting->save();

        return redirect()->route('admin.biayaadmin')->with('berhasil', 'Berhasil mengupdate biaya admin.');
    }
}

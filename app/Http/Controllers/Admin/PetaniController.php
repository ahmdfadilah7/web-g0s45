<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PetaniController extends Controller
{
    // Menampilkan halaman petani
    public function index()
    {
        $setting = Setting::first();

        return view('admin.petani.index', compact('setting'));
    }

    // Proses menampilkan data petani dengan datatables
    public function listData()
    {
        $data = User::where('role', 'petani');
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('admin.petani.edit', $row->id).'" class="btn btn-primary btn-sm mr-2">
                        <i class="fas fa-edit"></i>
                    </a>';
                $btn .= '<a href="'.route('admin.petani.delete', $row->id).'" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah petani
    public function create()
    {
        $setting = Setting::first();

        return view('admin.petani.add', compact('setting'));
    }

    // Proses menambahkan petani
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_petani' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|unique:profiles,no_telp',
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8'
        ],
        [
            'required' => ':attribute wajib diisi !!',
            'unique' => ':attribute sudah ada !!',
            'min' => ':attribute minimal :min karakter !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $user = new User;
        $user->name = $request->get('nama_petani');
        $user->email = $request->get('email');
        $user->role = 'petani';
        $user->username = $request->get('username');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        if ($request->foto <> '') {
            $foto = $request->file('foto');
            $namafoto = 'Profile-'.str_replace(' ', '-', $request->get('nama_petani')).Str::random(5).'.'.$foto->extension();
            $foto->move(public_path('images/'), $namafoto);
            $fotoNama = 'images/'.$namafoto;
        }

        Profile::create([
            'user_id' => $user->id,
            'no_telp' => $request->get('no_telp'),
            'jns_kelamin' => $request->get('jenis_kelamin'),
            'tmpt_lahir' => $request->get('tempat_lahir'),
            'tgl_lahir' => $request->get('tanggal_lahir'),
            'alamat' => $request->get('alamat'),
            'foto' => $fotoNama,
        ]);

        return redirect()->route('admin.petani')->with('berhasil', 'Berhasil menambahkan petani baru.');
    }

    // Menampilkan halaman edit petani
    public function edit($id)
    {
        $setting = Setting::first();
        $user = User::find($id);

        return view('admin.petani.edit', compact('setting', 'user'));
    }

    // Proses mengupdate petani
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_petani' => 'required',
            'email' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'username' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!',
            'unique' => ':attribute sudah ada !!',
            'min' => ':attribute minimal :min karakter !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $user = User::find($id);
        $user->name = $request->get('nama_petani');
        $user->email = $request->get('email');
        $user->username = $request->get('username');
        if ($request->password <> '') {
            $user->password = Hash::make($request->get('password'));
        }
        $user->save();

        if ($request->foto <> '') {
            $foto = $request->file('foto');
            $namafoto = 'Profile-'.str_replace(' ', '-', $request->get('nama_petani')).Str::random(5).'.'.$foto->extension();
            $foto->move(public_path('images/'), $namafoto);
            $fotoNama = 'images/'.$namafoto;
        }

        $profile = Profile::where('user_id', $id)->first();
        $profile->no_telp = $request->get('no_telp');
        $profile->jns_kelamin = $request->get('jenis_kelamin');
        $profile->tmpt_lahir = $request->get('tempat_lahir');
        $profile->tgl_lahir = $request->get('tanggal_lahir');
        $profile->alamat = $request->get('alamat');
        if ($request->foto <> '') {
            $profile->foto = $fotoNama;
        }
        $profile->save();

        return redirect()->route('admin.petani')->with('berhasil', 'Berhasil mengupdate petani.');
    }

    // Proses menghapus petani
    public function destroy($id)
    {
        $user = User::where('role', 'petani')
            ->find($id);
        $user->delete();

        return redirect()->route('admin.petani')->with('berhasil', 'Berhasil menghapus petani.');
    }
}

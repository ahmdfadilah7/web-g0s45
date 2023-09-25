<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    // Menampilkan halaman setting
    public function index()
    {
        $setting = Setting::first();

        return view('admin.setting.index', compact('setting'));
    }

    // Proses menampilkan data setting dengan datatables
    public function listData()
    {
        $data = Setting::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('logo', function($row) {
                if ($row->logo <> '') {
                    $img = '<img src="'.url($row->logo).'" width="50">';
                } else {
                    $img = '<i class="text-danger">Belum ada gambar</i>';
                }
                return $img;
            })
            ->addColumn('favicon', function($row) {
                if ($row->favicon <> '') {
                    $img = '<img src="'.url($row->favicon).'" width="50">';
                } else {
                    $img = '<i class="text-danger">Belum ada gambar</i>';
                }
                return $img;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('admin.setting.edit', $row->id).'" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>';

                return $btn;
            })
            ->rawColumns(['action', 'logo', 'favicon', 'bg_login', 'bg_register'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman edit setting
    public function edit($id)
    {
        $setting = Setting::find($id);

        return view('admin.setting.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_website' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required',
            'alamat' => 'required',
            'google_maps' => 'required',
            'logo' => 'mimes:jpg,jpeg,png,svg,webp',
            'favicon' => 'mimes:jpg,jpeg,png,svg,webp',
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'youtube' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        if ($request->logo <> '') {
            $logo = $request->file('logo');
            $namalogo = 'Logo-'.str_replace(' ', '-', $request->get('nama_website')).Str::random(5).'.'.$logo->extension();
            $logo->move(public_path('images/'), $namalogo);
            $logoNama = 'images/'.$namalogo;
        }

        if ($request->favicon <> '') {
            $favicon = $request->file('favicon');
            $namafavicon = 'Favicon-'.str_replace(' ', '-', $request->get('nama_website')).Str::random(5).'.'.$favicon->extension();
            $favicon->move(public_path('images/'), $namafavicon);
            $faviconNama = 'images/'.$namafavicon;
        }

        if ($request->bg_header_home <> '') {
            $bg_header_home = $request->file('bg_header_home');
            $namabg_header_home = 'BG-Header-Home-'.str_replace(' ', '-', $request->get('nama_website')).Str::random(5).'.'.$bg_header_home->extension();
            $bg_header_home->move(public_path('images/'), $namabg_header_home);
            $bg_header_homeNama = 'images/'.$namabg_header_home;
        }

        if ($request->bg_header_page <> '') {
            $bg_header_page = $request->file('bg_header_page');
            $namabg_header_page = 'BG-Header-Page-'.str_replace(' ', '-', $request->get('nama_website')).Str::random(5).'.'.$bg_header_page->extension();
            $bg_header_page->move(public_path('images/'), $namabg_header_page);
            $bg_header_pageNama = 'images/'.$namabg_header_page;
        }

        $setting = Setting::find($id);
        $setting->nama_website = $request->get('nama_website');
        $setting->email = $request->get('email');
        $setting->no_telp = $request->get('no_telp');
        $setting->alamat = $request->get('alamat');
        $setting->google_maps = $request->get('google_maps');
        $setting->judul_header_home = $request->get('judul_header_home');
        if ($request->logo <> '') {
            $setting->logo = $logoNama;
        }
        if ($request->favicon <> '') {
            $setting->favicon = $faviconNama;
        }
        if ($request->favicon <> '') {
            $setting->favicon = $faviconNama;
        }
        if ($request->bg_header_home <> '') {
            $setting->bg_header_home = $bg_header_homeNama;
        }
        if ($request->bg_header_page <> '') {
            $setting->bg_header_page = $bg_header_pageNama;
        }
        $setting->facebook = $request->get('facebook');
        $setting->twitter = $request->get('twitter');
        $setting->instagram = $request->get('instagram');
        $setting->youtube = $request->get('youtube');
        $setting->save();

        return redirect()->route('admin.setting')->with('berhasil', 'Berhasil mengupdate setting.');
    }
    
}

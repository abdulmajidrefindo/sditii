<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Http\Requests\StoreProfilSekolahRequest;
use App\Http\Requests\UpdateProfilSekolahRequest;
use Illuminate\Http\Request;

class ProfilSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = ProfilSekolah::first();
        return view('/profilSekolah/indexProfilSekolah',
        [
            'profil'=>$profil
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profilSekolah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfilSekolahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfilSekolahRequest $request)
    {
        $profilSekolah = ProfilSekolah::create([
            'nama_sekolah' => $request->get('nama_sekolah'),
            'alamat_sekolah' => $request->get('alamat_sekolah'),
            'email_sekolah' => $request->get('email_sekolah'),
            'kontak_sekolah' => $request->get('kontak_sekolah'),
            'website_sekolah' => $request->get('website_sekolah')
        ]);
        if ($profilSekolah) {
            return response()->json(['success' => 'Data berhasil disimpan!']);
        } else {
            return response()->json(['errors' => 'Data gagal disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProfilSekolah  $profilSekolah
     * @return \Illuminate\Http\Response
     */
    public function show(ProfilSekolah $profilSekolah)
    {
        $profil = ProfilSekolah::first();

        return view('/profilSekolah/indexProfilSekolah', compact('profil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfilSekolah  $profilSekolah
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfilSekolah $profilSekolah)
    {
        $id = $profilSekolah->id;
        $profilSekolah = ProfilSekolah::find($id);
        return response()->json($profilSekolah);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfilSekolahRequest  $request
     * @param  \App\Models\ProfilSekolah  $profilSekolah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfilSekolah $profilSekolah)
    {
        //validate message
        $messages = [
            'nama_sekolah.required' => 'Nama sekolah wajib diisi!',
            'alamat_sekolah.required' => 'Alamat sekolah wajib diisi!',
            'email_sekolah.required' => 'Email sekolah wajib diisi!',
            'kontak_sekolah.required' => 'Kontak sekolah wajib diisi!',
            'website_sekolah.required' => 'Website sekolah wajib diisi!'
        ];

        //validate request
        $request->validate([
            'nama_sekolah' => 'required',
            'alamat_sekolah' => 'required',
            'email_sekolah' => 'required|email',
            'kontak_sekolah' => 'required',
            'website_sekolah' => 'required'
        ], $messages);

        $profilSekolah->update($request->all());
        $profil = ProfilSekolah::first();
        if ($profilSekolah) {
            $success = "Data berhasil disimpan!";
            return view('/profilSekolah/indexProfilSekolah', compact('profil', 'success'));
        } else {
            $errors = "Data gagal disimpan!";
            return view('/profilSekolah/indexProfilSekolah', compact('profil', 'errors'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfilSekolah  $profilSekolah
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfilSekolah $profilSekolah)
    {
        $profilSekolah->delete();
        return response()->json(['success' => 'Data berhasil dihapus!']);
    }
}

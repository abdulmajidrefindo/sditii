<?php

namespace App\Http\Controllers;

use App\Models\IlmanWaaRuuhan;
use App\Models\Kelas;
use App\Models\Guru;

use App\Http\Requests\StoreIlmanWaaRuuhanRequest;
use App\Http\Requests\UpdateIlmanWaaRuuhanRequest;

use Yajra\DataTables\DataTables;
use Yajra\DataTables\Utilities\Request;

class IlmanWaaRuuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {

        $data_kelas = Kelas::all()->except(7);

        $kelas_id = $request->kelas_id;
        if ($kelas_id == null) {
            $siswa = IlmanWaaRuuhan::all();
        } else {
            $siswa = IlmanWaaRuuhan::where('kelas_id', $kelas_id)->get();
        }

        

        return view('dataIlmanWaaRuuhan.indexIlmanWaaRuuhan', compact('siswa', 'data_kelas'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIlmanWaaRuuhanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIlmanWaaRuuhanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IlmanWaaRuuhan  $ilmanWaaRuuhan
     * @return \Illuminate\Http\Response
     */
    public function show(IlmanWaaRuuhan $dataIlmanWaaRuuhan)
    {
        $data_guru = Guru::all();
        $data_iwr = IlmanWaaRuuhan::with('kelas','guru')->where('id', $dataIlmanWaaRuuhan->id)->first();
        return view('dataIlmanWaaRuuhan.showIlmanWaaRuuhan', compact('data_iwr', 'data_guru'));
        //return response()->json($data_iwr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IlmanWaaRuuhan  $ilmanWaaRuuhan
     * @return \Illuminate\Http\Response
     */
    public function edit(IlmanWaaRuuhan $ilmanWaaRuuhan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIlmanWaaRuuhanRequest  $request
     * @param  \App\Models\IlmanWaaRuuhan  $ilmanWaaRuuhan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIlmanWaaRuuhanRequest $request, IlmanWaaRuuhan $dataIlmanWaaRuuhan)
    {

        

        $rules = [
            'pencapaian' => 'required',
            'guru_id' => 'required',
        ];
        $messages = [
            'pencapaian.required' => 'Pencapaian tidak boleh kosong',
            'guru_id.required' => 'Guru tidak boleh kosong',
        ];
        $request->validate($rules, $messages);

        try {
            $dataIlmanWaaRuuhan->update([
                'pencapaian' => $request->pencapaian,
                'guru_id' => $request->guru_id,
            ]);
            return response()->json(['success' => 'Data berhasil disimpan!', 'status' => '200']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Data gagal disimpan!', 'status' => '500']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IlmanWaaRuuhan  $ilmanWaaRuuhan
     * @return \Illuminate\Http\Response
     */
    public function destroy(IlmanWaaRuuhan $ilmanWaaRuuhan)
    {
        //
    }

    public function getTable(Request $request){
        if ($request->ajax()) {

            if ($request->kelas_id == null) {
                $data = IlmanWaaRuuhan::with('kelas','guru')->get();
            } else {
                $data = IlmanWaaRuuhan::with('kelas','guru')->where('kelas_id', $request->kelas_id)->get();
            }
            
            return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn = '<a href="'. route('dataIlmanWaaRuuhan.show', $row) .'" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Detail" class="btn btn-sm btn-success mx-1 shadow detail"><i class="fas fa-sm fa-fw fa-eye"></i> Detail</a>';
                // $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-danger mx-1 shadow delete"><i class="fas fa-sm fa-fw fa-trash"></i> Delete</a>';
                
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

}

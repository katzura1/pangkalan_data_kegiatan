<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kegiatan',
        ];
        return view('pages.kegiatan.index')->with($data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kegiatan'
        ];
        return view('pages.kegiatan.create')->with($data);
    }

    public function data()
    {
        $items = Kegiatan::select('kegiatans.*', 'users.name')->join('users', 'users.id', '=', 'kegiatans.id_user')->get();
        $data = $items->toArray();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        return response()->json($final, 200);
    }

    public function save(Request $request)
    {
        return $request->all();
        $data_validator = [
            'nama_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required',
            'lokasi_kegiatan' => 'required',
            'pelaksana_kegiatan' => 'required',
            'nama_pimpinan' => 'required',
            'pendamping' => 'required',
            'deskripsi_kegiatan' => 'required',
            'kegiatan.*' => 'required|image',
        ];

        $validator = Validator::make($request->all(), $data_validator);

        if ($validator->fails()) {
            $response = [
                'code' => 400,
                'message' => $validator->errors(),
                'data' => [],
            ];
        } else {
        }
        return response()->json($response, 200);
    }

    public function update(Request $request)
    {
    }
}

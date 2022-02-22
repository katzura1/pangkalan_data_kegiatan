<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\KegiatanFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

    public function edit($id)
    {
        Kegiatan::findOrFail($id);
        $item = Kegiatan::with('kegiatan_foto')->where('id', $id)->first();
        $data = [
            'title' => 'Edit Kegiatan',
            'item' => $item,
        ];
        return view('pages.kegiatan.edit')->with($data);
    }

    public function detail($id)
    {
        Kegiatan::findOrFail($id);
        $item = Kegiatan::with('kegiatan_foto')->where('id', $id)->first();
        $data = [
            'title' => 'Detail Kegiatan',
            'item' => $item,
        ];
        return view('pages.kegiatan.detail')->with($data);
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
        // return $request->all();
        $data_validator = [
            'nama_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required',
            'lokasi_kegiatan' => 'required',
            'pelaksana_kegiatan' => 'required',
            'nama_pimpinan' => 'required',
            'pendamping' => 'required',
            'deskripsi_kegiatan' => 'required',
            'kegiatan.*' => 'required|image|max:2048',
        ];

        $validator = Validator::make($request->all(), $data_validator);

        if ($validator->fails()) {
            $response = [
                'code' => 400,
                'message' => $validator->errors(),
                'data' => [],
            ];
        } else {
            $data = [
                'nama_kegiatan' => $request->nama_kegiatan,
                'tanggal_kegiatan' => $request->tanggal_kegiatan,
                'lokasi_kegiatan' => $request->lokasi_kegiatan,
                'pelaksana_kegiatan' => $request->pelaksana_kegiatan,
                'nama_pimpinan' => $request->nama_pimpinan,
                'pendamping' => $request->pendamping,
                'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
                'id_user' => session()->get('pangkalan_id'),
            ];

            // Kegiatan::beginTransaction();
            try {
                DB::beginTransaction();
                $kegiatan = Kegiatan::updateOrCreate(['id' => $request->id], $data);
                // return $kegiatan;

                if ($request->hasFile('kegiatan')) {
                    // $_data = [];
                    $files = $request->file('kegiatan');
                    foreach ($files as $file) {
                        $_data = [
                            'kegiatan_id' => $kegiatan['id'],
                            'foto' => $file->storeAs('assets/kegiatan', 'kegiatan_' . date("YmdHis_") . gettimeofday()["usec"] . '.' . $file->extension(), 'public'),
                        ];
                        KegiatanFoto::create($_data);
                    }
                }
                DB::commit();
                $kegiatan = Kegiatan::find($kegiatan['id'])->with('kegiatan_fotos');
                $response = [
                    'code' => 200,
                    'message' => 'Data berhasil disimpan',
                    'data' => $kegiatan,
                ];
            } catch (\Exception $e) {
                DB::rollback();
                $response = [
                    'code' => 400,
                    'message' => $e->getMessage(),
                    'data' => [],
                ];
            }
        }
        return response()->json($response, 200);
    }

    public function delete(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $item = Kegiatan::find($id);
            $item->delete();
            KegiatanFoto::where('kegiatan_id', $id)->delete();
            DB::commit();
            $response = [
                'code' => 200,
                'message' => 'Data berhasil dihapus',
                'data' => [],
            ];
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'code' => 400,
                'message' => $e->getMessage(),
                'data' => [],
            ];
        }
        return response()->json($response, 200);
    }

    public function delete_foto(Request $request, $id, $idp)
    {
        $item = KegiatanFoto::findOrFail($id);
        $item->delete();

        return redirect('/kegiatan/edit/' . $idp);
    }

    public function pdf($id)
    {
        //get data
        $item = Kegiatan::with('kegiatan_foto')->where('id', $id)->first();
        // dd($item);
        if ($item == null) {
            abort('404');
        }

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pages.kegiatan.view', ['item' => $item]);
        return $pdf->stream();
    }
}

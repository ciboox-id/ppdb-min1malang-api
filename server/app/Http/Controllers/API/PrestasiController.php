<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestasi = Prestasi::all();

        if ($prestasi) {
            return ApiFormatter::createApi('200', 'Berhasil mengambil data ayah', $prestasi);
        }

        return ApiFormatter::createApi('404', 'Gagal mengambil data ayah');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_prestasi = $request->all();
        $data = [];
        // dd($data_prestasi);

        for ($i = 0; $i < count($data_prestasi); $i++) {
            if (empty($data_prestasi)) {
                return ApiFormatter::createApi('404', 'gagal memasukkan data prestasi');
            }

            $data[] = [
                'prestasi' => $data_prestasi[$i]['prestasi'],
                'tingkat' => $data_prestasi[$i]['tingkat'],
                'id_user' => $data_prestasi[$i]['id_user']
            ];
        }

        // dd($data);

        $prestasi = Prestasi::upsert($data, ['prestasi', 'tingkat']);
        return ApiFormatter::createApi('200', 'berhasil memasukkan data prestasi', $prestasi);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}

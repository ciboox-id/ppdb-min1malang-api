<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Father;
use Exception;
use Illuminate\Http\Request;

class FatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $father = Father::all();

        if ($father) {
            return ApiFormatter::createApi('200', 'Berhasil mengambil data ayah', $father);
        }

        return ApiFormatter::createApi('404', 'Gagal mengambil data ayah', $father);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Father $father)
    {
        $fatherData = Father::find($father);

        if (is_null($fatherData)) {
            return ApiFormatter::createApi('404', 'Data ayah tidak ditemukan', null);
        }

        return ApiFormatter::createApi('200', 'Berhasil mengambil data ayah', $fatherData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Father $father)
    {
        $validation = $request->validate([
            "nama_lengkap_ayah" => 'nullable',
            'nik_ayah' => 'nullable',
            "pekerjaan_ayah" => 'nullable',
            'nama_kantor_ayah' => 'nullable',
            'penghasilan_ayah' => 'nullable',
            "no_telp" => 'max:25|nullable',
        ]);

        try {
            $father->update($validation);

            return ApiFormatter::createApi('200', 'Berhasil menyimpan data ayah', $validation);
        } catch (Exception $error) {
            return ApiFormatter::createApi('400', 'Gagal menyimpan data ayah', null);
        }
    }
}

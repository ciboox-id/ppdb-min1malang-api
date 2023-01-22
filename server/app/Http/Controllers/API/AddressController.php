<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $address = Address::all();

        if ($address) {
            return ApiFormatter::createApi('200', 'Berhasil mengambil data alamat', $address);
        }

        return ApiFormatter::createApi('404', 'Gagal mengambil data alamat', $address);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        $addressData = Address::find($address);

        if (is_null($addressData)) {
            return ApiFormatter::createApi('404', 'Data alamat tidak ditemukan', null);
        }

        return ApiFormatter::createApi('200', 'Berhasil mengambil data ayah', $addressData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $validation = $request->validate([
            "no_kk" => 'nullable',
            'kelurahan' => 'nullable',
            "kecamatan" => 'nullable',
            'kota_kab' => 'nullable',
            'kode_post' => 'nullable',
            "telp_rumah" => 'max:25|nullable',
        ]);

        $address->update($validation);

        return ApiFormatter::createApi('200', 'Berhasil menyimpan data alamat', $validation);
    }
}

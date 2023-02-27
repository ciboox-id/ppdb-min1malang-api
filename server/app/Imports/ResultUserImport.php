<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ResultUserImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $validator = Validator::make($row, [
            'kemandirian' => 'required',
            'umum' => 'required',
            'agama' => 'required',
            'prestasi' => 'required',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $user = User::where('email', $row['email'])->first();

        if ($user) {
            $user->score->mandiri = $row['kemandirian'];
            $user->score->umum = $row['umum'];
            $user->score->agama = $row['agama'];
            $user->score->uji_tahfidz = $row['tahfidz'];
            $user->score->prestasi = $row['prestasi'];

            $user->score->save();

            $user->kelas = $row['kelas'];
            $user->lolos = $row['lolos'] == "DITERIMA" ? true : false;
            $user->save();
        }

        return $user;
    }
}

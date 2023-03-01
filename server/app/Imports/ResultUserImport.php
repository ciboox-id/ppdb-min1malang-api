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
            'kemandirian' => 'nullable',
            'umum' => 'nullable',
            'agama' => 'nullable',
            'prestasi' => 'nullable',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $user = User::where('email', $row['email'])->first();

        if ($user) {
            $user->score->mandiri = $row['kemandirian'];
            $user->score->umum = $row['umum'];
            $user->score->agama = $row['agama'];
            $user->score->uji_tahfidz = $row['tahfidz'] ?? 0;
            $user->score->prestasi = $row['prestasi'] ?? 0;

            $user->score->save();

            $user->kelas = $row['kelas'];
            $user->lolos = strtolower($row['lolos']) == "diterima" ? true : false;

            if (str_contains(strtolower($row['lolos']), "cadangan")) {
                $cadangan = explode(" ",$row['lolos']);

                $user->lolos = false;
                $user->is_backup = true;
                $user->kelas = $cadangan[1];
            }
            $user->save();
        }

        return $user;
    }
}

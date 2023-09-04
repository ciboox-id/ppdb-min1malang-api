<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PemetaanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $users = User::where('role', '!=', 'admin')->where('is_verif', true)->with(['latestPemetaan', 'score'])->get()->sortBy(function ($user) {
            return $user->latestPemetaan->id ?? null;
        });

        $data = [];
        $i = 0;

        foreach ($users as $user) {
            $i++;
            if(!$user->score) {
                continue;
            }
            $pemetaan = $user->latestPemetaan->id ?? null;
            $data[] = [
                'id' => $i,
                'nama_lengkap' => $user->nama_lengkap,
                'email' => $user->email,
                'jalur' => $user->jalur,
                'jenis_kelamin' => $user->jenis_kelamin,
                'no_pemetaan' => $pemetaan,
                'kemandirian' => $user->score->mandiri,
                'umum' => $user->score->umum,
                'nama validator umum' => $user->score->name_validator_umum,
                'agama' => $user->score->agama,
                'nama validator agama' => $user->score->name_validator_agama,
                'tahfidz' => $user->score->uji_tahfidz,
                'nama validator tahfidz' => $user->score->name_validator_tahfidz,
                'prestasi' => $user->score->prestasi,
                'waktu' => $user->score->updated_at
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return ['id', 'nama_lengkap', 'email', 'jalur', 'jenis_kelamin', 'no_pemetaan', 'kemandirian', 'umum', 'nama validator umum', 'agama', 'nama validator agama', 'tahfidz', 'nama validator tahfidz', 'prestasi', 'waktu'];
    }
}

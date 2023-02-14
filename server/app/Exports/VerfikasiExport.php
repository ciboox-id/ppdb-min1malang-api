<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VerfikasiExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $users = User::where('role', '!=', 'admin')->with('latestPemetaan')->get()->sortBy(function ($user) {
            return $user->latestPemetaan->id;
        });
        $data = [];
        $i = 0;

        foreach ($users as $user) {
            $i++;
            $pemetaan = $user->latestPemetaan->id;
            $data[] = [
                'id' => $i,
                'nama_lengkap' => $user->nama_lengkap,
                'email' => $user->email,
                'nisn' => $user->nisn,
                'jalur' => $user->jalur,
                'no_pemetaan' => $pemetaan
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return ['id', 'nama_lengkap', 'email', 'nisn','jalur', 'no_pemetaan'];
    }
}

<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::where('role', 'siswa')->get(['id', 'nama_lengkap', 'email', 'nisn', 'jenis_kelamin', 'alamat_siswa', 'tempat_lahir', 'tanggal_lahir', 'anak_ke', 'gol_darah']);
    }

    public function headings(): array
    {
        return ['id', 'nama_lengkap', 'email', 'nisn', 'jenis_kelamin', 'alamat_siswa', 'tempat_lahir', 'tanggal_lahir', 'anak_ke', 'gol_darah'];
    }
}

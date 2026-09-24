<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class PegawaiImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (
                empty($row['nip_pegawai']) ||
                empty($row['nama_pegawai'])
            ) {
                continue;
            }

            $nip = trim((string) $row['nip_pegawai']);

            $data = [
                'name' => trim((string) $row['nama_pegawai']),
                'jabatan' => $this->nullableTrim($row['jabatan'] ?? null),
                'bidang' => $this->nullableTrim($row['unit_kerja'] ?? $row['bidang'] ?? null),
                'pangkat_golongan' => $this->nullableTrim($row['pangakatgol'] ?? $row['pangkatgol'] ?? null),
                'tanggal_lahir' => $this->parseTanggalLahir($row['tanggal_lahir'] ?? null),
                'jenis_kelamin' => $this->nullableTrim($row['jenis_kelamin'] ?? null),
                'pendidikan' => $this->nullableTrim($row['pendidikan'] ?? null),
                'pendidikan_detail' => $this->nullableTrim($row['pendidikan2'] ?? null),
                'golongan_darah' => $this->nullableTrim($row['gol_darah'] ?? null),
            ];

            $email = $this->nullableTrim($row['email'] ?? null);

            if ($email !== null) {
                $data['email'] = $email;
            }

            $pegawai = User::where('nip', $nip)
                ->where('role', 'pegawai')
                ->first();

            if ($pegawai) {

                /*
                |--------------------------------------------------------------------------
                | NIP Sudah Ada
                |--------------------------------------------------------------------------
                |
                | Update data pegawai tanpa mengganti password.
                |
                */

                $pegawai->update($data);

            } else {

                /*
                |--------------------------------------------------------------------------
                | Pegawai Baru
                |--------------------------------------------------------------------------
                */

                User::create(array_merge($data, [
                    'nip' => $nip,
                    'role' => 'pegawai',
                    'status' => 'aktif',
                    'password' => User::passwordDefault(),
                    'must_change_password' => true,
                ]));
            }
        }
    }

    /**
     * Rapikan nilai string dari Excel, kosongkan jika blank.
     */
    private function nullableTrim($value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }

    /**
     * Excel menyimpan tanggal sebagai serial number, bukan string tanggal.
     */
    private function parseTanggalLahir($value): ?string
    {
        if (empty($value)) {
            return null;
        }

        if (is_numeric($value)) {
            return ExcelDate::excelToDateTimeObject($value)->format('Y-m-d');
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Throwable $e) {
            return null;
        }
    }
}

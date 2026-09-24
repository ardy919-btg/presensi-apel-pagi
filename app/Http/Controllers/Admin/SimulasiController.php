<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\AttendanceSetting;
use App\Models\DriveSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SimulasiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Pengaturan Apel Pagi
    |--------------------------------------------------------------------------
    */

    public function edit(): View
    {
        $pengaturan = AttendanceSetting::current();

        $driveSetting = DriveSetting::current();

        $jumlahDataSimulasi = Absensi::where(
            'is_simulasi',
            true
        )->count();

        return view(
            'admin.simulasi.edit',
            compact(
                'pengaturan',
                'driveSetting',
                'jumlahDataSimulasi'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Simpan Pengaturan Simulasi
    |--------------------------------------------------------------------------
    */

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([

            'simulasi_aktif' => [
                'sometimes',
                'boolean',
            ],

            'simulasi_tanggal_mulai' => [
                'nullable',
                'date',
            ],

            'simulasi_tanggal_selesai' => [
                'nullable',
                'date',
                'after_or_equal:simulasi_tanggal_mulai',
            ],

            'simulasi_jam_mulai' => [
                'nullable',
                'date_format:H:i',
            ],

            'simulasi_jam_selesai' => [
                'nullable',
                'date_format:H:i',
                'after:simulasi_jam_mulai',
            ],

        ], [
            'simulasi_tanggal_selesai.after_or_equal' => 'Tanggal selesai simulasi harus setelah atau sama dengan tanggal mulai.',
            'simulasi_jam_selesai.after' => 'Jam selesai simulasi harus setelah jam mulai simulasi.',
        ]);


        $pengaturan = AttendanceSetting::current();

        $pengaturan->update([

            'simulasi_aktif' => $request->boolean('simulasi_aktif'),

            'simulasi_tanggal_mulai' => $validated['simulasi_tanggal_mulai'] ?? null,

            'simulasi_tanggal_selesai' => $validated['simulasi_tanggal_selesai'] ?? null,

            'simulasi_jam_mulai' => $validated['simulasi_jam_mulai'] ?? null,

            'simulasi_jam_selesai' => $validated['simulasi_jam_selesai'] ?? null,
        ]);


        return redirect()
            ->route('admin.simulasi.edit')
            ->with(
                'success',
                'Pengaturan simulasi Apel Pagi berhasil disimpan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Matikan Simulasi Dengan Cepat
    |--------------------------------------------------------------------------
    */

    public function nonaktifkan(): RedirectResponse
    {
        AttendanceSetting::current()->update([
            'simulasi_aktif' => false,
        ]);

        return redirect()
            ->route('admin.simulasi.edit')
            ->with(
                'success',
                'Simulasi Apel Pagi dinonaktifkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Hapus Seluruh Data Absensi Hasil Simulasi
    |--------------------------------------------------------------------------
    */

    public function hapusData(): RedirectResponse
    {
        $jumlah = Absensi::where(
            'is_simulasi',
            true
        )->delete();

        return redirect()
            ->route('admin.simulasi.edit')
            ->with(
                'success',
                $jumlah > 0
                    ? $jumlah . ' data absensi hasil simulasi berhasil dihapus.'
                    : 'Tidak ada data absensi hasil simulasi yang perlu dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Simpan Lokasi & Radius Kantor
    |--------------------------------------------------------------------------
    */

    public function updateLokasi(Request $request): RedirectResponse
    {
        $validated = $request->validate([

            'office_latitude' => [
                'required',
                'numeric',
                'between:-90,90',
            ],

            'office_longitude' => [
                'required',
                'numeric',
                'between:-180,180',
            ],

            'office_radius' => [
                'required',
                'integer',
                'min:10',
                'max:5000',
            ],

        ], [
            'office_latitude.required' => 'Latitude kantor wajib diisi.',
            'office_longitude.required' => 'Longitude kantor wajib diisi.',
            'office_radius.required' => 'Radius toleransi wajib diisi.',
        ]);


        AttendanceSetting::current()->update($validated);


        return redirect()
            ->route('admin.simulasi.edit')
            ->with(
                'success',
                'Lokasi dan radius kantor berhasil disimpan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Simpan Retensi Data Absensi
    |--------------------------------------------------------------------------
    */

    public function updateRetensi(Request $request): RedirectResponse
    {
        $validated = $request->validate([

            'retensi_aktif' => [
                'sometimes',
                'boolean',
            ],

            'retensi_jumlah_absen' => [
                'required_if:retensi_aktif,1',
                'nullable',
                'integer',
                'min:1',
                'max:1000',
            ],

        ], [
            'retensi_jumlah_absen.required_if' => 'Jumlah retensi wajib diisi ketika retensi diaktifkan.',
        ]);


        AttendanceSetting::current()->update([

            'retensi_jumlah_absen' => $request->boolean('retensi_aktif')
                ? $validated['retensi_jumlah_absen']
                : null,
        ]);


        return redirect()
            ->route('admin.simulasi.edit')
            ->with(
                'success',
                'Pengaturan retensi data absensi berhasil disimpan.'
            );
    }
}

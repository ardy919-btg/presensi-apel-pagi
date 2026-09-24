<?php

namespace App\Http\Controllers\Pegawai;

use App\Helpers\AttendanceTime;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use App\Services\AttendanceRetentionService;
use App\Services\GoogleDriveService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AbsensiController extends Controller
{
    /**
     * Menampilkan status absensi Apel Pagi pegawai.
     */
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Gunakan Waktu Aplikasi / Simulasi
        |--------------------------------------------------------------------------
        */

        $today = AttendanceTime::today();

        $absensiHariIni = null;


        /*
        |--------------------------------------------------------------------------
        | Absensi Hari Ini Hanya Berlaku Hari Senin (Atau Saat Simulasi Aktif)
        |--------------------------------------------------------------------------
        */

        if (AttendanceTime::apelDiizinkanHariIni()) {
            $absensiHariIni = Absensi::where(
                'user_id',
                $user->id
            )
                ->whereDate(
                    'tanggal',
                    $today
                )
                ->first();
        }


        return view(
            'pegawai.absensi.index',
            compact('absensiHariIni')
        );
    }


    /**
     * Menampilkan riwayat absensi Apel Pagi pegawai.
     */
    public function riwayat()
    {
        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Riwayat Apel Pagi Senin + Hasil Simulasi
        |--------------------------------------------------------------------------
        |
        | DAYOFWEEK MySQL:
        |
        | 1 = Minggu
        | 2 = Senin
        |
        | Data simulasi bisa bertanggal hari apa saja, jadi ikut ditampilkan
        | di luar filter Senin supaya pegawai bisa melihat hasil uji cobanya.
        |
        */

        $riwayatAbsensi = Absensi::where(
            'user_id',
            $user->id
        )
            ->where(function ($query) {

                $query->whereRaw('DAYOFWEEK(tanggal) = 2')
                    ->orWhere('is_simulasi', true);
            })
            ->orderBy(
                'tanggal',
                'desc'
            )
            ->orderBy(
                'jam_masuk',
                'desc'
            )
            ->paginate(10);


        /*
        |--------------------------------------------------------------------------
        | Rekap Absensi Seluruh Pegawai Hari Ini
        |--------------------------------------------------------------------------
        |
        | Hanya dihitung saat hari apel berlangsung (Senin / simulasi aktif).
        |
        */

        $isSenin = AttendanceTime::apelDiizinkanHariIni();
        $today = AttendanceTime::today();

        $rekapBidang = collect();
        $rekapStatus = [
            'hadir' => 0,
            'tidak_hadir' => 0,
            'izin' => 0,
            'sakit' => 0,
            'dinas_luar' => 0,
            'cuti' => 0,
            'lainnya' => 0,
            'alpha' => 0,
        ];


        /*
        |--------------------------------------------------------------------------
        | Jumlah Pegawai Aktif
        |--------------------------------------------------------------------------
        |
        | Dihitung dari tabel users (role pegawai, status aktif), baik yang
        | sudah maupun belum mengisi absensi hari ini.
        |
        */

        $totalPegawaiAktif = User::where('role', 'pegawai')
            ->where('status', 'aktif')
            ->count();

        $totalPegawaiPerBidang = User::where('role', 'pegawai')
            ->where('status', 'aktif')
            ->get()
            ->groupBy(
                fn ($user) => $user->bidang ?: 'Tanpa Bidang'
            )
            ->map
            ->count();


        if ($isSenin) {

            $absensiHariIniSemua = Absensi::with('user')
                ->whereDate('tanggal', $today)
                ->get();

            $rekapBidang = $absensiHariIniSemua
                ->groupBy(
                    fn ($absensi) => $absensi->user->bidang ?: 'Tanpa Bidang'
                )
                ->map(function ($grup) {

                    return $grup->whereIn(
                        'status',
                        ['hadir', 'terlambat']
                    )->count();
                })
                ->union(
                    $totalPegawaiPerBidang->map(fn () => 0)
                )
                ->map(function ($hadir, $bidang) use ($totalPegawaiPerBidang) {

                    $totalBidang = $totalPegawaiPerBidang[$bidang] ?? 0;

                    return [
                        'hadir' => $hadir,
                        'tidak_hadir' => max($totalBidang - $hadir, 0),
                    ];
                })
                ->sortKeys();

            foreach ($absensiHariIniSemua as $absensi) {

                if (in_array($absensi->status, ['hadir', 'terlambat'])) {
                    $rekapStatus['hadir']++;
                } elseif (array_key_exists($absensi->status, $rekapStatus)) {
                    $rekapStatus[$absensi->status]++;
                }
            }

            $rekapStatus['tidak_hadir'] = max(
                $totalPegawaiAktif - $rekapStatus['hadir'],
                0
            );
        }


        return view(
            'pegawai.absensi.riwayat',
            compact(
                'riwayatAbsensi',
                'isSenin',
                'rekapBidang',
                'rekapStatus',
                'totalPegawaiAktif',
                'totalPegawaiPerBidang'
            )
        );
    }


    /**
     * Proses pengiriman absensi Apel Pagi.
     */
    public function masuk(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Gunakan Waktu Aplikasi / Simulasi
        |--------------------------------------------------------------------------
        */

        $now = AttendanceTime::now();

        $today = AttendanceTime::today();


        /*
        |--------------------------------------------------------------------------
        | Absensi Hanya Hari Senin (Atau Saat Simulasi Aktif)
        |--------------------------------------------------------------------------
        */

        if (! AttendanceTime::apelDiizinkanHariIni()) {
            return redirect()
                ->route('pegawai.absensi.index')
                ->with(
                    'error',
                    'Absensi Apel Pagi hanya dapat dilakukan pada hari Senin.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Batas Waktu Absensi
        |--------------------------------------------------------------------------
        |
        | ATTENDANCE_END_TIME = 07:45
        |
        | Mulai pukul 07:45 WITA absensi sudah ditutup.
        |
        */

        $jamTutup = AttendanceTime::jamSelesai();


        $batasAbsensi = $today
            ->copy()
            ->setTimeFromTimeString(
                $jamTutup
            );


        if ($now->greaterThanOrEqualTo($batasAbsensi)) {
            return redirect()
                ->route('pegawai.absensi.index')
                ->with(
                    'error',
                    'Absensi Apel Pagi telah ditutup pada pukul '
                    . $batasAbsensi->format('H:i')
                    . ' WITA.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Data Pegawai
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Cek Apakah Sudah Mengirim Absensi
        |--------------------------------------------------------------------------
        */

        $absensiSudahAda = Absensi::where(
            'user_id',
            $user->id
        )
            ->whereDate(
                'tanggal',
                $today
            )
            ->exists();


        if ($absensiSudahAda) {
            return redirect()
                ->route('pegawai.absensi.index')
                ->with(
                    'error',
                    'Anda sudah mengirim absensi Apel Pagi hari ini.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi Pilihan Kehadiran
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'kehadiran' => [
                'required',

                Rule::in([
                    'hadir',
                    'tidak_hadir',
                ]),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Jika Pegawai Hadir
        |--------------------------------------------------------------------------
        */

        if ($request->kehadiran === 'hadir') {
            return $this->prosesHadir(
                $request,
                $user,
                $today,
                $now
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Jika Pegawai Tidak Hadir
        |--------------------------------------------------------------------------
        */

        return $this->prosesTidakHadir(
            $request,
            $user,
            $today,
            $now
        );
    }


    /**
     * Proses pegawai yang hadir Apel Pagi.
     */
    private function prosesHadir(
        Request $request,
        $user,
        Carbon $today,
        Carbon $now
    ) {
        /*
        |--------------------------------------------------------------------------
        | Validasi GPS + Selfie
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'latitude' => [
                'required',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'required',
                'numeric',
                'between:-180,180',
            ],

            'foto' => [
                'required',
                'string',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Hitung Jarak Pegawai Dengan Kantor
        |--------------------------------------------------------------------------
        */

        $jarak = $this->hitungJarak(
            (float) $request->latitude,
            (float) $request->longitude
        );


        $radiusKantor = AttendanceTime::officeRadius();


        if ($jarak > $radiusKantor) {
            return redirect()
                ->route('pegawai.absensi.index')
                ->withInput()
                ->with(
                    'error',
                    'Anda berada di luar radius kantor. Jarak Anda sekitar '
                    . round($jarak)
                    . ' meter.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Waktu Mulai Apel
        |--------------------------------------------------------------------------
        |
        | ATTENDANCE_START_TIME = 07:30
        |
        | Sampai pukul 07:30:00 = Hadir
        | Setelah pukul 07:30:00 = Terlambat
        |
        */

        $jamApel = AttendanceTime::jamMulai();


        $batasTerlambat = $today
            ->copy()
            ->setTimeFromTimeString(
                $jamApel
            );


        /*
        |--------------------------------------------------------------------------
        | Tentukan Status
        |--------------------------------------------------------------------------
        */

        $status = $now->greaterThan(
            $batasTerlambat
        )
            ? 'terlambat'
            : 'hadir';


        /*
        |--------------------------------------------------------------------------
        | Simpan Selfie
        |--------------------------------------------------------------------------
        */

        $fotoApel = $this->simpanFotoBase64(
            $request->foto,
            'apel',
            $user->id
        );


        /*
        |--------------------------------------------------------------------------
        | Simpan Absensi Apel
        |--------------------------------------------------------------------------
        */

        Absensi::create([

            'user_id' =>
                $user->id,

            'tanggal' =>
                $today->toDateString(),

            'jam_masuk' =>
                $now->format('H:i:s'),

            'foto_masuk' =>
                $fotoApel['value'],

            'foto_masuk_storage' =>
                $fotoApel['storage'],

            'latitude_masuk' =>
                $request->latitude,

            'longitude_masuk' =>
                $request->longitude,

            'status' =>
                $status,

            'alasan_tidak_hadir' =>
                null,

            'keterangan' =>
                null,

            'is_simulasi' =>
                AttendanceTime::simulasiAktif(),

        ]);


        app(AttendanceRetentionService::class)->terapkan($user);


        return redirect()
            ->route('pegawai.absensi.index')
            ->with(
                'success',
                $status === 'terlambat'
                    ? 'Absensi Apel Pagi berhasil dikirim. Anda tercatat terlambat.'
                    : 'Absensi Apel Pagi berhasil dikirim. Anda tercatat hadir.'
            );
    }


    /**
     * Proses pegawai yang tidak hadir Apel Pagi.
     */
    private function prosesTidakHadir(
        Request $request,
        $user,
        Carbon $today,
        Carbon $now
    ) {
        /*
        |--------------------------------------------------------------------------
        | Validasi Alasan Tidak Hadir
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'alasan_tidak_hadir' => [
                'required',

                Rule::in([
                    'izin',
                    'sakit',
                    'dinas_luar',
                    'cuti',
                    'lainnya',
                ]),
            ],

            'keterangan' => [
                'required',
                'string',
                'max:1000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Tentukan Status
        |--------------------------------------------------------------------------
        */

        $status = $request->alasan_tidak_hadir;


        /*
        |--------------------------------------------------------------------------
        | Simpan Absensi Tidak Hadir
        |--------------------------------------------------------------------------
        */

        Absensi::create([

            'user_id' =>
                $user->id,

            'tanggal' =>
                $today->toDateString(),

            'jam_masuk' =>
                $now->format('H:i:s'),

            'foto_masuk' =>
                null,

            'latitude_masuk' =>
                null,

            'longitude_masuk' =>
                null,

            'status' =>
                $status,

            'alasan_tidak_hadir' =>
                $request->alasan_tidak_hadir,

            'keterangan' =>
                trim($request->keterangan),

            'is_simulasi' =>
                AttendanceTime::simulasiAktif(),

        ]);


        app(AttendanceRetentionService::class)->terapkan($user);


        return redirect()
            ->route('pegawai.absensi.index')
            ->with(
                'success',
                'Keterangan tidak hadir Apel Pagi berhasil dikirim.'
            );
    }


    /**
     * Menghitung jarak pegawai dengan kantor dalam meter.
     */
    private function hitungJarak(
        float $latitudePegawai,
        float $longitudePegawai
    ): float {

        $latitudeKantor = AttendanceTime::officeLatitude();

        $longitudeKantor = AttendanceTime::officeLongitude();


        /*
        |--------------------------------------------------------------------------
        | Radius Bumi Dalam Meter
        |--------------------------------------------------------------------------
        */

        $earthRadius = 6371000;


        /*
        |--------------------------------------------------------------------------
        | Konversi Koordinat Ke Radian
        |--------------------------------------------------------------------------
        */

        $latFrom = deg2rad(
            $latitudeKantor
        );


        $lonFrom = deg2rad(
            $longitudeKantor
        );


        $latTo = deg2rad(
            $latitudePegawai
        );


        $lonTo = deg2rad(
            $longitudePegawai
        );


        /*
        |--------------------------------------------------------------------------
        | Selisih Koordinat
        |--------------------------------------------------------------------------
        */

        $latDelta =
            $latTo - $latFrom;


        $lonDelta =
            $lonTo - $lonFrom;


        /*
        |--------------------------------------------------------------------------
        | Rumus Haversine
        |--------------------------------------------------------------------------
        */

        $angle = 2 * asin(
            sqrt(
                pow(
                    sin($latDelta / 2),
                    2
                )
                +
                cos($latFrom)
                *
                cos($latTo)
                *
                pow(
                    sin($lonDelta / 2),
                    2
                )
            )
        );


        return $angle * $earthRadius;
    }


    /**
     * Menyimpan selfie Base64 ke Google Drive (jika sudah terhubung) atau
     * storage lokal. Mengembalikan ['value' => path/file ID, 'storage' => 'drive'|'local'].
     */
    private function simpanFotoBase64(
        string $fotoBase64,
        string $tipe,
        int $userId
    ): array {

        /*
        |--------------------------------------------------------------------------
        | Validasi Format Base64
        |--------------------------------------------------------------------------
        */

        if (
            !preg_match(
                '/^data:image\/(jpeg|jpg|png);base64,/',
                $fotoBase64,
                $matches
            )
        ) {
            abort(
                422,
                'Format foto selfie tidak valid.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Pisahkan Data Base64
        |--------------------------------------------------------------------------
        */

        $fotoBase64 = substr(
            $fotoBase64,
            strpos(
                $fotoBase64,
                ','
            ) + 1
        );


        $fotoBase64 = str_replace(
            ' ',
            '+',
            $fotoBase64
        );


        /*
        |--------------------------------------------------------------------------
        | Decode Base64
        |--------------------------------------------------------------------------
        */

        $fotoDecoded = base64_decode(
            $fotoBase64,
            true
        );


        if ($fotoDecoded === false) {
            abort(
                422,
                'Foto selfie tidak dapat diproses.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Maksimal Ukuran Selfie 5 MB
        |--------------------------------------------------------------------------
        */

        if (
            strlen(
                $fotoDecoded
            ) > 5 * 1024 * 1024
        ) {
            abort(
                422,
                'Ukuran foto selfie terlalu besar.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Tentukan Ekstensi
        |--------------------------------------------------------------------------
        */

        $extension =
            $matches[1] === 'png'
                ? 'png'
                : 'jpg';


        /*
        |--------------------------------------------------------------------------
        | Buat Nama File
        |--------------------------------------------------------------------------
        |
        | Nama file mengikuti waktu simulasi jika test mode aktif.
        |
        */

        $namaFile =
            $userId
            . '_'
            . AttendanceTime::now()->format(
                'Ymd_His'
            )
            . '_'
            . $tipe
            . '.'
            . $extension;


        /*
        |--------------------------------------------------------------------------
        | Google Drive (Kalau Sudah Terhubung)
        |--------------------------------------------------------------------------
        */

        $googleDrive = app(GoogleDriveService::class);

        if ($googleDrive->configured()) {

            $mimeType = $extension === 'png' ? 'image/png' : 'image/jpeg';

            $fileId = $googleDrive->upload(
                $fotoDecoded,
                $namaFile,
                $mimeType
            );

            if ($fileId) {
                return [
                    'value' => $fileId,
                    'storage' => 'drive',
                ];
            }

            // Upload ke Drive gagal -- lanjut simpan lokal sebagai fallback.
        }


        /*
        |--------------------------------------------------------------------------
        | Folder Penyimpanan (Lokal)
        |--------------------------------------------------------------------------
        */

        $path =
            'absensi/'
            . $tipe
            . '/'
            . $namaFile;


        Storage::disk(
            'public'
        )->put(
            $path,
            $fotoDecoded
        );


        return [
            'value' => $path,
            'storage' => 'local',
        ];
    }

}
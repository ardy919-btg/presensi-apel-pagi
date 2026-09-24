<x-app-layout>

    <x-slot name="header">
        <div>

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Pengaturan Apel Pagi
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Lokasi kantor, simulasi, dan retensi data absensi.
            </p>

        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">




            {{-- NOTIFIKASI ERROR --}}
            @if($errors->any())

                <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">

                    <ul class="list-disc list-inside">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- ========================= --}}
            {{-- LOKASI & RADIUS KANTOR --}}
            {{-- ========================= --}}

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6">

                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                    Lokasi & Radius Kantor
                </h3>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Titik koordinat dan jarak toleransi yang dipakai untuk
                    memverifikasi lokasi pegawai saat mengisi Apel Pagi.
                </p>

                <form
                    method="POST"
                    action="{{ route('admin.pengaturan.lokasi.update') }}"
                    class="mt-4 space-y-4"
                >

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Latitude
                            </label>

                            <input
                                type="text"
                                inputmode="decimal"
                                name="office_latitude"
                                value="{{ old('office_latitude', $pengaturan->office_latitude ?? config('attendance.latitude')) }}"
                                placeholder="mis. 0.123456"
                                class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('office_latitude')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                        </div>


                        <div>

                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Longitude
                            </label>

                            <input
                                type="text"
                                inputmode="decimal"
                                name="office_longitude"
                                value="{{ old('office_longitude', $pengaturan->office_longitude ?? config('attendance.longitude')) }}"
                                placeholder="mis. 117.123456"
                                class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('office_longitude')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                        </div>


                        <div>

                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Radius (meter)
                            </label>

                            <input
                                type="number"
                                min="10"
                                max="5000"
                                name="office_radius"
                                value="{{ old('office_radius', $pengaturan->office_radius ?? config('attendance.radius', 150)) }}"
                                class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('office_radius')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                        </div>

                    </div>

                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Cara dapatkan koordinat: buka Google Maps, klik-kanan
                        (atau tap-lama di HP) tepat di titik gedung kantor,
                        salin dua angka yang muncul.
                    </p>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition"
                    >
                        Simpan Lokasi Kantor
                    </button>

                </form>

            </div>


            {{-- STATUS SAAT INI --}}
            @if(\App\Helpers\AttendanceTime::simulasiAktif())

                <div
                    class="
                        mb-6
                        rounded-xl
                        border
                        border-amber-300
                        bg-amber-50
                        dark:bg-amber-900/20
                        dark:border-amber-800
                        p-5
                    "
                >

                    <div class="flex items-start justify-between gap-4">

                        <div class="flex items-start gap-3">

                            <span class="text-xl leading-none">🧪</span>

                            <div>

                                <p class="text-sm font-semibold text-amber-800 dark:text-amber-300">
                                    Simulasi sedang berlaku
                                </p>

                                <p class="mt-1 text-sm text-amber-700 dark:text-amber-400">
                                    Pegawai bisa mengisi Apel Pagi hari ini
                                    walau bukan hari Senin.

                                    @if($pengaturan->simulasi_tanggal_mulai || $pengaturan->simulasi_tanggal_selesai)

                                        Jadwal:
                                        <strong>
                                            {{ optional($pengaturan->simulasi_tanggal_mulai)->translatedFormat('d M Y') ?? 'sekarang' }}
                                            &ndash;
                                            {{ optional($pengaturan->simulasi_tanggal_selesai)->translatedFormat('d M Y') ?? 'sampai dimatikan manual' }}
                                        </strong>.

                                    @endif

                                </p>

                            </div>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('admin.simulasi.nonaktifkan') }}"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="
                                    px-3 py-1.5
                                    text-sm
                                    font-medium
                                    text-amber-800
                                    bg-white
                                    border
                                    border-amber-300
                                    rounded-lg
                                    hover:bg-amber-100
                                    transition
                                    whitespace-nowrap
                                "
                            >
                                Nonaktifkan
                            </button>
                        </form>

                    </div>

                </div>

            @elseif($pengaturan->simulasi_aktif)

                <div
                    class="
                        mb-6
                        rounded-xl
                        border
                        border-gray-300
                        bg-gray-50
                        dark:bg-gray-900/40
                        dark:border-gray-700
                        p-5
                        text-sm
                        text-gray-600
                        dark:text-gray-300
                    "
                >
                    Simulasi diaktifkan tapi tanggal hari ini berada di luar
                    jadwal yang diatur di bawah, jadi belum berlaku.
                </div>

            @endif


            {{-- PENJELASAN --}}
            <div
                class="
                    mb-6
                    p-4
                    rounded-lg
                    bg-blue-50
                    dark:bg-blue-900/20
                    text-sm
                    text-blue-700
                    dark:text-blue-300
                "
            >
                Seluruh alur Apel Pagi (batas waktu, status Hadir/Terlambat,
                dan Alpha otomatis) normalnya hanya berjalan pada hari Senin.
                Selama mode simulasi ini berlaku, pegawai bisa mengisi
                Apel Pagi <strong>di hari apa pun</strong> -- supaya bisa
                uji coba aplikasi kapan saja sebelum hari Senin sesungguhnya
                tiba. Setelah simulasi dimatikan, sistem otomatis kembali
                membatasi pengisian Apel Pagi khusus hari Senin.
            </div>


            {{-- FORM --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">

                <form
                    method="POST"
                    action="{{ route('admin.simulasi.update') }}"
                    x-data="{ aktif: {{ old('simulasi_aktif', $pengaturan->simulasi_aktif) ? 'true' : 'false' }} }"
                >

                    @csrf
                    @method('PUT')


                    {{-- Toggle Aktif --}}
                    <div class="mb-6">

                        <label class="inline-flex items-center gap-3 cursor-pointer">

                            <input
                                type="checkbox"
                                name="simulasi_aktif"
                                value="1"
                                x-model="aktif"
                                class="w-5 h-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                @if(old('simulasi_aktif', $pengaturan->simulasi_aktif)) checked @endif
                            >

                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                Aktifkan Mode Simulasi
                            </span>

                        </label>

                    </div>


                    <div x-show="aktif" style="display: none;" class="space-y-5">

                        {{-- Jadwal / Tahap Simulasi --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Jadwal Simulasi (opsional)
                            </label>

                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Kosongkan kedua tanggal kalau ingin simulasi
                                langsung aktif sekarang dan berlaku terus
                                sampai Anda matikan manual.
                            </p>

                            <div class="mt-2 grid grid-cols-2 gap-4">

                                <div>

                                    <label class="block text-xs text-gray-500 dark:text-gray-400">
                                        Mulai
                                    </label>

                                    <input
                                        type="date"
                                        name="simulasi_tanggal_mulai"
                                        value="{{ old('simulasi_tanggal_mulai', optional($pengaturan->simulasi_tanggal_mulai)->format('Y-m-d')) }}"
                                        class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500"
                                    >

                                    @error('simulasi_tanggal_mulai')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                </div>


                                <div>

                                    <label class="block text-xs text-gray-500 dark:text-gray-400">
                                        Selesai
                                    </label>

                                    <input
                                        type="date"
                                        name="simulasi_tanggal_selesai"
                                        value="{{ old('simulasi_tanggal_selesai', optional($pengaturan->simulasi_tanggal_selesai)->format('Y-m-d')) }}"
                                        class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500"
                                    >

                                    @error('simulasi_tanggal_selesai')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- Jam Mulai & Selesai --}}
                        <div class="grid grid-cols-2 gap-4">

                            <div>

                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Jam Mulai (opsional)
                                </label>

                                <input
                                    type="time"
                                    name="simulasi_jam_mulai"
                                    value="{{ old('simulasi_jam_mulai', optional($pengaturan->simulasi_jam_mulai)->format('H:i')) }}"
                                    class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500"
                                >

                                @error('simulasi_jam_mulai')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                            </div>


                            <div>

                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Jam Selesai (opsional)
                                </label>

                                <input
                                    type="time"
                                    name="simulasi_jam_selesai"
                                    value="{{ old('simulasi_jam_selesai', optional($pengaturan->simulasi_jam_selesai)->format('H:i')) }}"
                                    class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500"
                                >

                                @error('simulasi_jam_selesai')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                            </div>

                        </div>

                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Kosongkan jam mulai/selesai untuk memakai jam Apel Pagi
                            normal ({{ config('attendance.start_time', '07:30') }}
                            &ndash; {{ config('attendance.end_time', '07:45') }} WITA).
                            Isi kalau ingin uji coba di luar jam tersebut
                            (mis. siang hari).
                        </p>

                    </div>


                    <div class="mt-6 flex gap-3">

                        <button
                            type="submit"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition"
                        >
                            Simpan Pengaturan
                        </button>

                    </div>

                </form>

            </div>


            {{-- HAPUS DATA SIMULASI --}}
            <div
                class="
                    mt-6
                    bg-white
                    dark:bg-gray-800
                    shadow
                    rounded-lg
                    p-6
                "
            >

                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                    Data Absensi Hasil Simulasi
                </h3>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">

                    @if($jumlahDataSimulasi > 0)

                        Ada
                        <strong>{{ $jumlahDataSimulasi }}</strong>
                        data absensi yang tercatat selama mode simulasi
                        aktif. Data ini ikut tersimpan seperti absensi
                        sungguhan, jadi sebaiknya dihapus setelah sesi
                        uji coba selesai supaya tidak tercampur dengan
                        rekap Apel Pagi yang asli.

                    @else

                        Belum ada data absensi hasil simulasi yang
                        tersimpan.

                    @endif

                </p>


                @if($jumlahDataSimulasi > 0)

                    <form
                        method="POST"
                        action="{{ route('admin.simulasi.hapus-data') }}"
                        class="mt-4"
                        data-confirm="Hapus semua data absensi hasil simulasi ({{ $jumlahDataSimulasi }} data)? Data absensi Apel Pagi asli tidak akan terpengaruh."
                        data-confirm-title="Hapus Data Simulasi"
                        data-confirm-text="Ya, Hapus"
                        data-confirm-variant="danger"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="
                                px-4 py-2
                                bg-red-600
                                hover:bg-red-700
                                text-white
                                text-sm
                                font-medium
                                rounded-lg
                                transition
                            "
                        >
                            Hapus Data Simulasi
                        </button>

                    </form>

                @endif

            </div>


            {{-- ========================= --}}
            {{-- RETENSI DATA ABSENSI --}}
            {{-- ========================= --}}

            <div
                class="mt-6 bg-white dark:bg-gray-800 shadow rounded-lg p-6"
                x-data="{ retensiAktif: {{ old('retensi_aktif', $pengaturan->retensi_jumlah_absen) ? 'true' : 'false' }} }"
            >

                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                    Retensi Data Absensi
                </h3>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Batasi berapa kali riwayat Apel Pagi Senin terakhir yang
                    disimpan per pegawai. Data & foto selfie yang lebih lama
                    dari batas ini akan dihapus otomatis setiap ada absensi
                    baru (data hasil simulasi tidak dihitung di sini).
                </p>

                <form
                    method="POST"
                    action="{{ route('admin.pengaturan.retensi.update') }}"
                    class="mt-4 space-y-4"
                >

                    @csrf
                    @method('PUT')

                    <label class="inline-flex items-center gap-3 cursor-pointer">

                        <input
                            type="checkbox"
                            name="retensi_aktif"
                            value="1"
                            x-model="retensiAktif"
                            class="w-5 h-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                            @if(old('retensi_aktif', $pengaturan->retensi_jumlah_absen)) checked @endif
                        >

                        <span class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                            Aktifkan Retensi
                        </span>

                    </label>

                    <div x-show="retensiAktif" style="display: none;">

                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Simpan berapa kali absen Senin terakhir
                        </label>

                        <input
                            type="number"
                            min="1"
                            max="1000"
                            name="retensi_jumlah_absen"
                            value="{{ old('retensi_jumlah_absen', $pengaturan->retensi_jumlah_absen ?? 10) }}"
                            class="mt-1 w-full sm:w-40 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('retensi_jumlah_absen')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition"
                    >
                        Simpan Retensi
                    </button>

                </form>

            </div>


            {{-- ========================= --}}
            {{-- PENYIMPANAN FOTO GOOGLE DRIVE --}}
            {{-- ========================= --}}

            <div class="mt-6 bg-white dark:bg-gray-800 shadow rounded-lg p-6">

                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                    Penyimpanan Foto Selfie (Google Drive)
                </h3>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Kalau terhubung, foto selfie Apel Pagi disimpan di Google
                    Drive (bukan disk server) supaya lebih hemat ruang
                    penyimpanan VPS. Kalau tidak terhubung, foto tetap
                    disimpan di server seperti biasa.
                </p>


                @if($driveSetting->terhubung())

                    <div
                        class="mt-4 flex items-center justify-between gap-4
                               p-4 rounded-lg bg-green-50 border border-green-200
                               dark:bg-green-900/20 dark:border-green-800"
                    >

                        <div>

                            <p class="text-sm font-semibold text-green-800 dark:text-green-300">
                                Terhubung
                                @if($driveSetting->connected_email)
                                    sebagai {{ $driveSetting->connected_email }}
                                @endif
                            </p>

                            <p class="mt-1 text-xs text-green-700 dark:text-green-400">
                                Sejak {{ $driveSetting->connected_at?->translatedFormat('d F Y, H:i') }} WITA.
                                Folder: "Absensi Apel BPKAD - Selfie".
                            </p>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('admin.drive.disconnect') }}"
                            data-confirm="Putuskan koneksi Google Drive? Foto selfie baru akan disimpan di server lokal, foto lama yang sudah ada di Drive tidak terhapus."
                            data-confirm-title="Putuskan Google Drive"
                            data-confirm-text="Ya, Putuskan"
                            data-confirm-variant="warning"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="px-3 py-1.5 text-sm font-medium text-red-700 bg-white border border-red-300 rounded-lg hover:bg-red-50 transition whitespace-nowrap"
                            >
                                Putuskan
                            </button>
                        </form>

                    </div>

                @else

                    <div class="mt-4">

                        <a
                            href="{{ route('admin.drive.connect') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition"
                        >
                            Hubungkan Google Drive
                        </a>

                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                            Anda akan diarahkan ke halaman izin Google --
                            login pakai akun Google yang akan menyimpan foto selfie.
                            @if(!config('services.google.client_id') || !config('services.google.client_secret'))
                                <span class="text-red-600 dark:text-red-400 font-medium">
                                    GOOGLE_CLIENT_ID / GOOGLE_CLIENT_SECRET belum diisi di server.
                                </span>
                            @endif
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>

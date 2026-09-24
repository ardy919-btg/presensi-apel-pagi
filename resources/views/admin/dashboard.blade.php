<x-app-layout>

    <x-slot name="header">
        <div>

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard Admin
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Ringkasan absensi Apel Pagi pegawai BPKAD.
            </p>

        </div>
    </x-slot>


    @php

        /*
        |--------------------------------------------------------------------------
        | Informasi Waktu Apel
        |--------------------------------------------------------------------------
        |
        | Menggunakan AttendanceTime agar dashboard mengikuti
        | waktu simulasi ketika ATTENDANCE_TEST_MODE aktif.
        |
        */

        $sekarang = \App\Helpers\AttendanceTime::now();

        $hariIni = \App\Helpers\AttendanceTime::today();


        $jamMulai = \App\Helpers\AttendanceTime::jamMulai();

        $jamTutup = \App\Helpers\AttendanceTime::jamSelesai();


        $waktuMulai = $hariIni
            ->copy()
            ->setTimeFromTimeString(
                $jamMulai
            );


        $waktuTutup = $hariIni
            ->copy()
            ->setTimeFromTimeString(
                $jamTutup
            );


        /*
        |--------------------------------------------------------------------------
        | Status Periode Absensi
        |--------------------------------------------------------------------------
        */

        if (!$isSenin) {

            $statusAbsensi = 'Tidak Ada Jadwal';

            $statusClass = '
                bg-gray-100 text-gray-700
                dark:bg-gray-700 dark:text-gray-300
            ';

        } elseif ($sekarang->lt($waktuMulai)) {

            $statusAbsensi = 'Belum Dimulai';

            $statusClass = '
                bg-blue-100 text-blue-700
                dark:bg-blue-900/40 dark:text-blue-300
            ';

        } elseif ($sekarang->lt($waktuTutup)) {

            $statusAbsensi = 'Absensi Dibuka';

            $statusClass = '
                bg-green-100 text-green-700
                dark:bg-green-900/40 dark:text-green-300
            ';

        } else {

            $statusAbsensi = 'Absensi Ditutup';

            $statusClass = '
                bg-red-100 text-red-700
                dark:bg-red-900/40 dark:text-red-300
            ';
        }

    @endphp


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <x-simulasi-banner />


            {{-- ========================= --}}
            {{-- SELAMAT DATANG --}}
            {{-- ========================= --}}

            <div class="mb-8">

                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Selamat datang,
                    {{ auth()->user()->name }}
                </h1>

                <p class="mt-2 text-gray-600 dark:text-gray-400">

                    {{
                        \App\Helpers\AttendanceTime::now()
                            ->locale('id')
                            ->translatedFormat('l, d F Y')
                    }}

                </p>

            </div>


            {{-- ========================= --}}
            {{-- INFORMASI JADWAL APEL --}}
            {{-- ========================= --}}

            @if($isSenin)

                <div
                    class="mb-6 rounded-xl border border-green-200
                           bg-green-50 p-5
                           dark:border-green-800 dark:bg-green-900/20"
                >

                    <div
                        class="flex flex-col sm:flex-row
                               sm:items-center sm:justify-between
                               gap-3"
                    >

                        <div>

                            <h3 class="font-semibold text-green-800 dark:text-green-300">
                                Apel Pagi Hari Ini
                            </h3>

                            <p class="mt-1 text-sm text-green-700 dark:text-green-400">
                                Hari ini adalah hari Senin dan merupakan jadwal
                                pelaksanaan Apel Pagi pegawai BPKAD.
                            </p>

                        </div>


                        <span
                            class="inline-flex self-start
                                   px-4 py-2 rounded-full
                                   text-sm font-semibold
                                   {{ $statusClass }}"
                        >
                            {{ $statusAbsensi }}
                        </span>

                    </div>

                </div>

            @else

                <div
                    class="mb-6 rounded-xl border border-blue-200
                           bg-blue-50 p-5
                           dark:border-blue-800 dark:bg-blue-900/20"
                >

                    <div
                        class="flex flex-col sm:flex-row
                               sm:items-center sm:justify-between
                               gap-3"
                    >

                        <div>

                            <h3 class="font-semibold text-blue-800 dark:text-blue-300">
                                Tidak Ada Apel Pagi Hari Ini
                            </h3>

                            <p class="mt-1 text-sm text-blue-700 dark:text-blue-400">
                                Absensi Apel Pagi hanya dilaksanakan setiap hari Senin.
                            </p>

                        </div>


                        <span
                            class="inline-flex self-start
                                   px-4 py-2 rounded-full
                                   text-sm font-semibold
                                   {{ $statusClass }}"
                        >
                            {{ $statusAbsensi }}
                        </span>

                    </div>

                </div>

            @endif


            {{-- ========================= --}}
            {{-- INFORMASI WAKTU APEL --}}
            {{-- ========================= --}}

            <div
                class="mb-8 rounded-xl border border-yellow-200
                       bg-yellow-50 p-5
                       dark:border-yellow-800 dark:bg-yellow-900/20"
            >

                <div>

                    <h3 class="font-semibold text-yellow-800 dark:text-yellow-300">
                        Jadwal Absensi Apel Pagi
                    </h3>

                    <p class="mt-1 text-sm text-yellow-700 dark:text-yellow-400">
                        Informasi waktu pelaksanaan dan batas pengisian absensi pegawai.
                    </p>

                </div>


                <div
                    class="mt-4 grid grid-cols-1
                           sm:grid-cols-2 lg:grid-cols-4
                           gap-4"
                >


                    {{-- HARI --}}
                    <div
                        class="rounded-lg bg-white p-4
                               border border-yellow-100
                               dark:bg-gray-800 dark:border-gray-700"
                    >

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Jadwal Apel
                        </p>

                        <p class="mt-1 text-xl font-bold text-gray-900 dark:text-white">
                            Setiap Senin
                        </p>

                    </div>


                    {{-- MULAI --}}
                    <div
                        class="rounded-lg bg-white p-4
                               border border-yellow-100
                               dark:bg-gray-800 dark:border-gray-700"
                    >

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Mulai Apel
                        </p>

                        <p class="mt-1 text-xl font-bold text-gray-900 dark:text-white">
                            {{ $waktuMulai->format('H:i') }} WITA
                        </p>

                    </div>


                    {{-- BATAS --}}
                    <div
                        class="rounded-lg bg-white p-4
                               border border-yellow-100
                               dark:bg-gray-800 dark:border-gray-700"
                    >

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Batas Absensi
                        </p>

                        <p class="mt-1 text-xl font-bold text-gray-900 dark:text-white">
                            {{ $waktuTutup->format('H:i') }} WITA
                        </p>

                    </div>


                    {{-- STATUS --}}
                    <div
                        class="rounded-lg bg-white p-4
                               border border-yellow-100
                               dark:bg-gray-800 dark:border-gray-700"
                    >

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Status Hari Ini
                        </p>

                        <div class="mt-2">

                            <span
                                class="inline-flex
                                       px-3 py-1 rounded-full
                                       text-sm font-semibold
                                       {{ $statusClass }}"
                            >
                                {{ $statusAbsensi }}
                            </span>

                        </div>

                    </div>

                </div>


                <div
                    class="mt-4 rounded-lg
                           bg-yellow-100/70
                           p-4
                           dark:bg-yellow-900/30"
                >

                    <p class="text-sm text-yellow-800 dark:text-yellow-300">

                        Pegawai yang mengirim absensi setelah pukul

                        <strong>
                            {{ $waktuMulai->format('H:i') }} WITA
                        </strong>

                        akan tercatat Terlambat.

                        Mulai pukul

                        <strong>
                            {{ $waktuTutup->format('H:i') }} WITA
                        </strong>

                        absensi ditutup dan pegawai yang belum memiliki
                        status akan tercatat Alpha secara otomatis.

                    </p>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- STATISTIK --}}
            {{-- ========================= --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">


                {{-- Pegawai Aktif --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Pegawai Aktif
                    </p>

                    <p class="mt-3 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $totalPegawai }}
                    </p>

                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Total pegawai aktif
                    </p>

                </div>


                {{-- Hadir --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Hadir Apel
                    </p>

                    <p class="mt-3 text-3xl font-bold text-green-600">
                        {{ $hadirHariIni }}
                    </p>

                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Hadir tepat waktu
                    </p>

                </div>


                {{-- Terlambat --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Terlambat
                    </p>

                    <p class="mt-3 text-3xl font-bold text-yellow-600">
                        {{ $terlambatHariIni }}
                    </p>

                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Terlambat mengikuti apel
                    </p>

                </div>


                {{-- Izin --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Izin
                    </p>

                    <p class="mt-3 text-3xl font-bold text-blue-600">
                        {{ $izinHariIni }}
                    </p>

                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Tidak hadir karena izin
                    </p>

                </div>


                {{-- Sakit --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Sakit
                    </p>

                    <p class="mt-3 text-3xl font-bold text-purple-600">
                        {{ $sakitHariIni }}
                    </p>

                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Tidak hadir karena sakit
                    </p>

                </div>


                {{-- Dinas Luar --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Dinas Luar
                    </p>

                    <p class="mt-3 text-3xl font-bold text-indigo-600">
                        {{ $dinasLuarHariIni ?? 0 }}
                    </p>

                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Tidak hadir karena tugas dinas
                    </p>

                </div>


                {{-- Cuti --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Cuti
                    </p>

                    <p class="mt-3 text-3xl font-bold text-teal-600">
                        {{ $cutiHariIni ?? 0 }}
                    </p>

                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Tidak hadir karena cuti
                    </p>

                </div>


                {{-- Lainnya --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Lainnya
                    </p>

                    <p class="mt-3 text-3xl font-bold text-orange-600">
                        {{ $lainnyaHariIni ?? 0 }}
                    </p>

                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Tidak hadir dengan alasan lainnya
                    </p>

                </div>


                {{-- Alpha --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Alpha
                    </p>

                    <p class="mt-3 text-3xl font-bold text-red-700 dark:text-red-400">
                        {{ $alphaHariIni }}
                    </p>

                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Tidak mengikuti apel tanpa keterangan
                    </p>

                </div>


                {{-- Belum Mengisi --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Belum Mengisi
                    </p>

                    <p class="mt-3 text-3xl font-bold text-gray-600 dark:text-gray-300">
                        {{ $belumAbsen }}
                    </p>

                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Belum memiliki status Apel Pagi
                    </p>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- MENU CEPAT --}}
            {{-- ========================= --}}

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm mb-8">

                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Menu Cepat
                    </h3>


                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-5">


                        {{-- Data Pegawai --}}
                        <a
                            href="{{ route('admin.pegawai.index') }}"
                            class="block p-5 rounded-xl
                                   border border-gray-200 dark:border-gray-700
                                   hover:bg-gray-50 dark:hover:bg-gray-700
                                   transition"
                        >

                            <h4 class="font-semibold text-gray-900 dark:text-white">
                                Data Pegawai
                            </h4>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Kelola akun dan data pegawai.
                            </p>

                        </a>


                        {{-- Riwayat Apel --}}
                        <a
                            href="{{ route('admin.absensi.index') }}"
                            class="block p-5 rounded-xl
                                   border border-gray-200 dark:border-gray-700
                                   hover:bg-gray-50 dark:hover:bg-gray-700
                                   transition"
                        >

                            <h4 class="font-semibold text-gray-900 dark:text-white">
                                Riwayat Apel
                            </h4>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Lihat data absensi, selfie, lokasi, dan keterangan pegawai.
                            </p>

                        </a>


                        {{-- QR Code --}}
                        <a
                            href="{{ route('admin.qrcode.index') }}"
                            class="block p-5 rounded-xl
                                   border border-gray-200 dark:border-gray-700
                                   hover:bg-gray-50 dark:hover:bg-gray-700
                                   transition"
                        >

                            <h4 class="font-semibold text-gray-900 dark:text-white">
                                QR Code Apel
                            </h4>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Lihat QR Code permanen untuk absensi Apel Pagi.
                            </p>

                        </a>

                    </div>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- RIWAYAT APEL TERBARU --}}
            {{-- ========================= --}}

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm">

                <div class="p-6">


                    <div
                        class="flex flex-col sm:flex-row
                               sm:items-center sm:justify-between
                               gap-3 mb-5"
                    >

                        <div>

                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Riwayat Apel Terbaru
                            </h3>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Lima data absensi Apel Pagi terbaru.
                            </p>

                        </div>


                        <a
                            href="{{ route('admin.absensi.index') }}"
                            class="text-sm font-semibold
                                   text-indigo-600 hover:text-indigo-800"
                        >
                            Lihat Semua
                        </a>

                    </div>


                    <div class="overflow-x-auto">

                        <table
                            class="min-w-full
                                   divide-y divide-gray-200
                                   dark:divide-gray-700"
                        >

                            <thead class="bg-gray-50 dark:bg-gray-700">

                                <tr>

                                    <th
                                        class="px-4 py-3 text-left
                                               text-xs font-semibold uppercase tracking-wider
                                               text-gray-600 dark:text-gray-300"
                                    >
                                        Pegawai
                                    </th>

                                    <th
                                        class="px-4 py-3 text-center
                                               text-xs font-semibold uppercase tracking-wider
                                               text-gray-600 dark:text-gray-300"
                                    >
                                        Tanggal Apel
                                    </th>

                                    <th
                                        class="px-4 py-3 text-center
                                               text-xs font-semibold uppercase tracking-wider
                                               text-gray-600 dark:text-gray-300"
                                    >
                                        Jam
                                    </th>

                                    <th
                                        class="px-4 py-3 text-center
                                               text-xs font-semibold uppercase tracking-wider
                                               text-gray-600 dark:text-gray-300"
                                    >
                                        Status
                                    </th>

                                    <th
                                        class="px-4 py-3 text-center
                                               text-xs font-semibold uppercase tracking-wider
                                               text-gray-600 dark:text-gray-300"
                                    >
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody
                                class="divide-y divide-gray-200
                                       dark:divide-gray-700"
                            >

                                @forelse($absensiTerbaru as $absensi)

                                    <tr
                                        class="hover:bg-gray-50
                                               dark:hover:bg-gray-700"
                                    >


                                        {{-- Pegawai --}}
                                        <td class="px-4 py-4">

                                            <div
                                                class="font-semibold
                                                       text-gray-900 dark:text-white"
                                            >
                                                {{ $absensi->user->name ?? '-' }}
                                            </div>

                                            <div
                                                class="text-xs
                                                       text-gray-500 dark:text-gray-400"
                                            >
                                                {{ $absensi->user->nip ?? '-' }}
                                            </div>

                                        </td>


                                        {{-- Tanggal --}}
                                        <td
                                            class="px-4 py-4 text-center
                                                   whitespace-nowrap
                                                   text-gray-700 dark:text-gray-300"
                                        >
                                            {{
                                                \Carbon\Carbon::parse(
                                                    $absensi->tanggal
                                                )
                                                ->locale('id')
                                                ->translatedFormat('d F Y')
                                            }}
                                        </td>


                                        {{-- Jam --}}
                                        <td
                                            class="px-4 py-4 text-center
                                                   whitespace-nowrap
                                                   text-gray-700 dark:text-gray-300"
                                        >

                                            @if($absensi->jam_masuk)

                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $absensi->jam_masuk
                                                    )->format('H:i')
                                                }}

                                            @else

                                                -

                                            @endif

                                        </td>


                                        {{-- Status --}}
                                        <td class="px-4 py-4 text-center">

                                            @if($absensi->status === 'hadir')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           rounded-full text-xs font-semibold
                                                           bg-green-100 text-green-700
                                                           dark:bg-green-900/40 dark:text-green-300"
                                                >
                                                    Hadir
                                                </span>

                                            @elseif($absensi->status === 'terlambat')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           rounded-full text-xs font-semibold
                                                           bg-yellow-100 text-yellow-700
                                                           dark:bg-yellow-900/40 dark:text-yellow-300"
                                                >
                                                    Terlambat
                                                </span>

                                            @elseif($absensi->status === 'izin')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           rounded-full text-xs font-semibold
                                                           bg-blue-100 text-blue-700
                                                           dark:bg-blue-900/40 dark:text-blue-300"
                                                >
                                                    Izin
                                                </span>

                                            @elseif($absensi->status === 'sakit')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           rounded-full text-xs font-semibold
                                                           bg-purple-100 text-purple-700
                                                           dark:bg-purple-900/40 dark:text-purple-300"
                                                >
                                                    Sakit
                                                </span>

                                            @elseif($absensi->status === 'dinas_luar')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           rounded-full text-xs font-semibold
                                                           bg-indigo-100 text-indigo-700
                                                           dark:bg-indigo-900/40 dark:text-indigo-300"
                                                >
                                                    Dinas Luar
                                                </span>

                                            @elseif($absensi->status === 'cuti')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           rounded-full text-xs font-semibold
                                                           bg-teal-100 text-teal-700
                                                           dark:bg-teal-900/40 dark:text-teal-300"
                                                >
                                                    Cuti
                                                </span>

                                            @elseif($absensi->status === 'lainnya')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           rounded-full text-xs font-semibold
                                                           bg-orange-100 text-orange-700
                                                           dark:bg-orange-900/40 dark:text-orange-300"
                                                >
                                                    Lainnya
                                                </span>

                                            @elseif($absensi->status === 'alpha')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           rounded-full text-xs font-semibold
                                                           bg-red-100 text-red-700
                                                           dark:bg-red-900/40 dark:text-red-300"
                                                >
                                                    Alpha
                                                </span>

                                            @else

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           rounded-full text-xs font-semibold
                                                           bg-gray-100 text-gray-700
                                                           dark:bg-gray-700 dark:text-gray-300"
                                                >
                                                    {{
                                                        ucfirst(
                                                            str_replace(
                                                                '_',
                                                                ' ',
                                                                $absensi->status
                                                            )
                                                        )
                                                    }}
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Detail --}}
                                        <td class="px-4 py-4 text-center">

                                            <a
                                                href="{{ route('admin.absensi.show', $absensi->id) }}"
                                                class="inline-flex px-3 py-2
                                                       bg-indigo-600 hover:bg-indigo-700
                                                       text-white text-xs font-semibold
                                                       rounded-lg"
                                            >
                                                Detail
                                            </a>

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td
                                            colspan="5"
                                            class="px-4 py-8 text-center
                                                   text-gray-500 dark:text-gray-400"
                                        >
                                            Belum ada data absensi Apel Pagi.
                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
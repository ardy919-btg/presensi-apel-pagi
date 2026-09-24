<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Detail Apel Pagi
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Informasi lengkap kehadiran Apel Pagi pegawai.
                </p>

            </div>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">


            {{-- ========================= --}}
            {{-- TOMBOL KEMBALI --}}
            {{-- ========================= --}}

            <div class="mb-6">

                <a
                    href="{{ route('admin.absensi.index') }}"
                    class="inline-flex items-center
                           px-4 py-2
                           bg-gray-600 hover:bg-gray-700
                           text-white
                           rounded-lg
                           transition"
                >
                    ← Kembali ke Riwayat Apel
                </a>

            </div>


            {{-- ========================= --}}
            {{-- DATA PEGAWAI --}}
            {{-- ========================= --}}

            <div
                class="bg-white dark:bg-gray-800
                       shadow-sm rounded-xl mb-6"
            >

                <div class="p-6">

                    <h3
                        class="text-lg font-semibold
                               text-gray-900 dark:text-white
                               mb-5"
                    >
                        Data Pegawai
                    </h3>


                    <div
                        class="grid grid-cols-1
                               md:grid-cols-2
                               gap-6"
                    >


                        {{-- Nama --}}
                        <div>

                            <p
                                class="text-sm
                                       text-gray-500 dark:text-gray-400"
                            >
                                Nama Pegawai
                            </p>

                            <p
                                class="mt-1 font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                {{ $absensi->user->name ?? '-' }}
                            </p>

                        </div>


                        {{-- NIP --}}
                        <div>

                            <p
                                class="text-sm
                                       text-gray-500 dark:text-gray-400"
                            >
                                NIP
                            </p>

                            <p
                                class="mt-1 font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                {{ $absensi->user->nip ?? '-' }}
                            </p>

                        </div>


                        {{-- Jabatan --}}
                        <div>

                            <p
                                class="text-sm
                                       text-gray-500 dark:text-gray-400"
                            >
                                Jabatan
                            </p>

                            <p
                                class="mt-1 font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                {{ $absensi->user->jabatan ?? '-' }}
                            </p>

                        </div>


                        {{-- Bidang --}}
                        <div>

                            <p
                                class="text-sm
                                       text-gray-500 dark:text-gray-400"
                            >
                                Bidang
                            </p>

                            <p
                                class="mt-1 font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                {{ $absensi->user->bidang ?? '-' }}
                            </p>

                        </div>


                        {{-- Pangkat / Golongan --}}
                        <div>

                            <p
                                class="text-sm
                                       text-gray-500 dark:text-gray-400"
                            >
                                Pangkat / Golongan
                            </p>

                            <p
                                class="mt-1 font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                {{ $absensi->user->pangkat_golongan ?? '-' }}
                            </p>

                        </div>


                        {{-- Tanggal Lahir --}}
                        <div>

                            <p
                                class="text-sm
                                       text-gray-500 dark:text-gray-400"
                            >
                                Tanggal Lahir
                            </p>

                            <p
                                class="mt-1 font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                {{ optional($absensi->user->tanggal_lahir)->format('d-m-Y') ?? '-' }}
                            </p>

                        </div>


                        {{-- Jenis Kelamin --}}
                        <div>

                            <p
                                class="text-sm
                                       text-gray-500 dark:text-gray-400"
                            >
                                Jenis Kelamin
                            </p>

                            <p
                                class="mt-1 font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                {{ $absensi->user->jenis_kelamin ?? '-' }}
                            </p>

                        </div>


                        {{-- Pendidikan --}}
                        <div>

                            <p
                                class="text-sm
                                       text-gray-500 dark:text-gray-400"
                            >
                                Pendidikan
                            </p>

                            <p
                                class="mt-1 font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                {{ $absensi->user->pendidikan ?? '-' }}
                                @if($absensi->user->pendidikan_detail)
                                    ({{ $absensi->user->pendidikan_detail }})
                                @endif
                            </p>

                        </div>


                        {{-- Golongan Darah --}}
                        <div>

                            <p
                                class="text-sm
                                       text-gray-500 dark:text-gray-400"
                            >
                                Golongan Darah
                            </p>

                            <p
                                class="mt-1 font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                {{ $absensi->user->golongan_darah ?? '-' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- INFORMASI APEL --}}
            {{-- ========================= --}}

            <div
                class="bg-white dark:bg-gray-800
                       shadow-sm rounded-xl mb-6"
            >

                <div class="p-6">

                    <h3
                        class="text-lg font-semibold
                               text-gray-900 dark:text-white
                               mb-5"
                    >
                        Informasi Apel Pagi
                    </h3>


                    <div
                        class="grid grid-cols-1
                               sm:grid-cols-2
                               lg:grid-cols-3
                               gap-6"
                    >


                        {{-- Tanggal --}}
                        <div>

                            <p
                                class="text-sm
                                       text-gray-500 dark:text-gray-400"
                            >
                                Tanggal Apel
                            </p>

                            <p
                                class="mt-2 font-semibold
                                       text-gray-900 dark:text-white"
                            >

                                {{
                                    \Carbon\Carbon::parse(
                                        $absensi->tanggal
                                    )
                                    ->locale('id')
                                    ->translatedFormat(
                                        'l, d F Y'
                                    )
                                }}

                            </p>

                        </div>


                        {{-- Jam Pengisian --}}
                        <div>

                            <p
                                class="text-sm
                                       text-gray-500 dark:text-gray-400"
                            >
                                Jam Pengisian
                            </p>

                            <p
                                class="mt-2 text-xl font-bold
                                       text-gray-900 dark:text-white"
                            >

                                @if($absensi->jam_masuk)

                                    {{
                                        \Carbon\Carbon::parse(
                                            $absensi->jam_masuk
                                        )->format('H:i')
                                    }}

                                    <span
                                        class="text-sm font-normal
                                               text-gray-500
                                               dark:text-gray-400"
                                    >
                                        WITA
                                    </span>

                                @else

                                    -

                                @endif

                            </p>

                        </div>


                        {{-- Status --}}
                        <div>

                            <p
                                class="text-sm
                                       text-gray-500 dark:text-gray-400
                                       mb-2"
                            >
                                Status Apel
                            </p>


                            @if($absensi->status === 'hadir')

                                <span
                                    class="inline-flex px-4 py-2
                                           rounded-full
                                           bg-green-100 text-green-700
                                           dark:bg-green-900/40
                                           dark:text-green-300
                                           font-semibold"
                                >
                                    Hadir
                                </span>


                            @elseif($absensi->status === 'terlambat')

                                <span
                                    class="inline-flex px-4 py-2
                                           rounded-full
                                           bg-yellow-100 text-yellow-700
                                           dark:bg-yellow-900/40
                                           dark:text-yellow-300
                                           font-semibold"
                                >
                                    Terlambat
                                </span>


                            @elseif($absensi->status === 'izin')

                                <span
                                    class="inline-flex px-4 py-2
                                           rounded-full
                                           bg-blue-100 text-blue-700
                                           dark:bg-blue-900/40
                                           dark:text-blue-300
                                           font-semibold"
                                >
                                    Izin
                                </span>


                            @elseif($absensi->status === 'sakit')

                                <span
                                    class="inline-flex px-4 py-2
                                           rounded-full
                                           bg-purple-100 text-purple-700
                                           dark:bg-purple-900/40
                                           dark:text-purple-300
                                           font-semibold"
                                >
                                    Sakit
                                </span>


                            @elseif($absensi->status === 'dinas_luar')

                                <span
                                    class="inline-flex px-4 py-2
                                           rounded-full
                                           bg-indigo-100 text-indigo-700
                                           dark:bg-indigo-900/40
                                           dark:text-indigo-300
                                           font-semibold"
                                >
                                    Dinas Luar
                                </span>


                            @elseif($absensi->status === 'cuti')

                                <span
                                    class="inline-flex px-4 py-2
                                           rounded-full
                                           bg-teal-100 text-teal-700
                                           dark:bg-teal-900/40
                                           dark:text-teal-300
                                           font-semibold"
                                >
                                    Cuti
                                </span>


                            @elseif($absensi->status === 'lainnya')

                                <span
                                    class="inline-flex px-4 py-2
                                           rounded-full
                                           bg-orange-100 text-orange-700
                                           dark:bg-orange-900/40
                                           dark:text-orange-300
                                           font-semibold"
                                >
                                    Lainnya
                                </span>


                            @elseif($absensi->status === 'alpha')

                                <span
                                    class="inline-flex px-4 py-2
                                           rounded-full
                                           bg-red-100 text-red-700
                                           dark:bg-red-900/40
                                           dark:text-red-300
                                           font-semibold"
                                >
                                    Alpha
                                </span>


                            @else

                                <span
                                    class="inline-flex px-4 py-2
                                           rounded-full
                                           bg-gray-100 text-gray-700
                                           dark:bg-gray-700
                                           dark:text-gray-300
                                           font-semibold"
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


                            @if($absensi->is_simulasi)

                                <p
                                    class="mt-2 text-xs font-semibold
                                           text-amber-600 dark:text-amber-400"
                                >
                                    🧪 Data hasil simulasi, bukan Apel Pagi sungguhan.
                                </p>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- KETERANGAN TIDAK HADIR --}}
            {{-- ========================= --}}

            @if(
                in_array(
                    $absensi->status,
                    [
                        'izin',
                        'sakit',
                        'dinas_luar',
                        'cuti',
                        'lainnya'
                    ]
                )
            )

                <div
                    class="bg-white dark:bg-gray-800
                           shadow-sm rounded-xl mb-6"
                >

                    <div class="p-6">

                        <h3
                            class="text-lg font-semibold
                                   text-gray-900 dark:text-white
                                   mb-5"
                        >
                            Keterangan Tidak Hadir
                        </h3>


                        <div
                            class="grid grid-cols-1
                                   md:grid-cols-3
                                   gap-6"
                        >


                            {{-- Alasan --}}
                            <div>

                                <p
                                    class="text-sm
                                           text-gray-500 dark:text-gray-400"
                                >
                                    Alasan
                                </p>

                                <p
                                    class="mt-2 font-semibold
                                           text-gray-900 dark:text-white"
                                >

                                    {{
                                        match(
                                            $absensi->alasan_tidak_hadir
                                        ) {
                                            'izin' => 'Izin',
                                            'sakit' => 'Sakit',
                                            'dinas_luar' => 'Dinas Luar',
                                            'cuti' => 'Cuti',
                                            'lainnya' => 'Lainnya',
                                            default => '-',
                                        }
                                    }}

                                </p>

                            </div>


                            {{-- Keterangan --}}
                            <div class="md:col-span-2">

                                <p
                                    class="text-sm
                                           text-gray-500 dark:text-gray-400"
                                >
                                    Keterangan Pegawai
                                </p>

                                <div
                                    class="mt-2 p-4
                                           bg-gray-50 dark:bg-gray-700
                                           rounded-lg
                                           text-gray-900 dark:text-gray-100
                                           whitespace-pre-line"
                                >
                                    {{ $absensi->keterangan ?: '-' }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ========================= --}}
            {{-- ALPHA --}}
            {{-- ========================= --}}

            @if($absensi->status === 'alpha')

                <div
                    class="mb-6 p-5
                           bg-red-50
                           dark:bg-red-900/20
                           border border-red-200
                           dark:border-red-800
                           rounded-xl"
                >

                    <h3
                        class="font-semibold
                               text-red-800 dark:text-red-300"
                    >
                        Tidak Mengisi Absensi Apel
                    </h3>

                    <p
                        class="mt-2 text-sm
                               text-red-700 dark:text-red-400"
                    >
                        Pegawai tidak mengirim status kehadiran
                        Apel Pagi sampai batas waktu yang ditentukan.
                    </p>

                </div>

            @endif


            {{-- ========================= --}}
            {{-- BUKTI KEHADIRAN --}}
            {{-- ========================= --}}

            @if(
                in_array(
                    $absensi->status,
                    [
                        'hadir',
                        'terlambat'
                    ]
                )
            )

                <div
                    class="grid grid-cols-1
                           md:grid-cols-2
                           gap-6"
                >


                    {{-- ========================= --}}
                    {{-- SELFIE APEL --}}
                    {{-- ========================= --}}

                    <div
                        class="bg-white dark:bg-gray-800
                               shadow-sm rounded-xl"
                    >

                        <div class="p-6">

                            <h3
                                class="text-lg font-semibold
                                       text-gray-900 dark:text-white
                                       mb-4"
                            >
                                Selfie Apel
                            </h3>


                            @if($absensi->foto_masuk)

                                <a
                                    href="{{ $absensi->foto_masuk_view_url }}"
                                    target="_blank"
                                >

                                    <img
                                        src="{{ $absensi->foto_masuk_url }}"
                                        alt="Selfie Apel"
                                        class="w-full
                                               max-h-[500px]
                                               object-contain
                                               bg-black
                                               rounded-lg
                                               hover:opacity-90
                                               transition"
                                    >

                                </a>

                                <p
                                    class="mt-3 text-sm
                                           text-gray-500 dark:text-gray-400"
                                >
                                    Klik foto untuk melihat ukuran penuh.
                                </p>

                            @else

                                <div
                                    class="flex items-center justify-center
                                           h-64
                                           bg-gray-100 dark:bg-gray-700
                                           rounded-lg
                                           text-gray-500 dark:text-gray-400"
                                >
                                    Selfie Apel tidak tersedia.
                                </div>

                            @endif

                        </div>

                    </div>


                    {{-- ========================= --}}
                    {{-- LOKASI APEL --}}
                    {{-- ========================= --}}

                    <div
                        class="bg-white dark:bg-gray-800
                               shadow-sm rounded-xl"
                    >

                        <div class="p-6">

                            <h3
                                class="text-lg font-semibold
                                       text-gray-900 dark:text-white
                                       mb-4"
                            >
                                Lokasi Apel
                            </h3>


                            @if(
                                $absensi->latitude_masuk &&
                                $absensi->longitude_masuk
                            )

                                <div class="space-y-4">

                                    <div>

                                        <p
                                            class="text-sm
                                                   text-gray-500
                                                   dark:text-gray-400"
                                        >
                                            Latitude
                                        </p>

                                        <p
                                            class="mt-1 font-semibold
                                                   text-gray-900
                                                   dark:text-white"
                                        >
                                            {{ $absensi->latitude_masuk }}
                                        </p>

                                    </div>


                                    <div>

                                        <p
                                            class="text-sm
                                                   text-gray-500
                                                   dark:text-gray-400"
                                        >
                                            Longitude
                                        </p>

                                        <p
                                            class="mt-1 font-semibold
                                                   text-gray-900
                                                   dark:text-white"
                                        >
                                            {{ $absensi->longitude_masuk }}
                                        </p>

                                    </div>


                                    <div class="pt-2">

                                        <a
                                            href="https://www.google.com/maps?q={{ $absensi->latitude_masuk }},{{ $absensi->longitude_masuk }}"
                                            target="_blank"
                                            class="inline-flex
                                                   items-center
                                                   justify-center
                                                   px-5 py-2.5
                                                   bg-blue-600
                                                   hover:bg-blue-700
                                                   text-white
                                                   font-semibold
                                                   rounded-lg
                                                   transition"
                                        >
                                            Buka Google Maps
                                        </a>

                                    </div>

                                </div>

                            @else

                                <div
                                    class="flex items-center justify-center
                                           h-64
                                           bg-gray-100 dark:bg-gray-700
                                           rounded-lg
                                           text-gray-500 dark:text-gray-400"
                                >
                                    Lokasi Apel tidak tersedia.
                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>
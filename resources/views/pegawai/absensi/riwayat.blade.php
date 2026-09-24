<x-app-layout>

    <x-slot name="header">
        <div
            class="flex flex-col
                   lg:flex-row lg:items-start
                   lg:justify-between
                   gap-4"
        >

            <div>

                <h2
                    class="font-semibold text-xl
                           text-gray-800 dark:text-gray-200
                           leading-tight"
                >
                    Riwayat Apel Pagi
                </h2>

                <p
                    class="mt-1 text-sm
                           text-gray-500 dark:text-gray-400"
                >
                    Riwayat absensi Apel Pagi Anda.
                </p>

            </div>


            {{-- ========================= --}}
            {{-- PANEL REKAP KESELURUHAN PEGAWAI --}}
            {{-- ========================= --}}

            @if($isSenin)

                <div
                    class="rounded-xl border border-gray-200
                           dark:border-gray-700
                           bg-white dark:bg-gray-800/60
                           px-4 py-3
                           lg:ml-auto"
                >

                    <div class="flex flex-wrap items-center gap-2">

                        <span
                            class="text-sm font-medium
                                   text-gray-600 dark:text-gray-400
                                   mr-1"
                        >
                            Jumlah Pegawai: {{ $totalPegawaiAktif }}
                        </span>

                        <span
                            class="inline-flex items-center gap-1
                                   px-3 py-1.5
                                   text-xs font-semibold
                                   rounded-full
                                   bg-green-100 text-green-700
                                   dark:bg-green-900/40
                                   dark:text-green-300"
                        >
                            Hadir: {{ $rekapStatus['hadir'] }}
                        </span>

                        <span
                            class="inline-flex items-center gap-1
                                   px-3 py-1.5
                                   text-xs font-semibold
                                   rounded-full
                                   bg-gray-200 text-red-600
                                   dark:bg-gray-700
                                   dark:text-red-400"
                        >
                            Tidak Hadir: {{ $rekapStatus['tidak_hadir'] }}
                        </span>

                    </div>


                    <div class="flex flex-wrap items-center gap-2 mt-2">

                        <span
                            class="inline-flex items-center gap-1
                                   px-3 py-1.5
                                   text-xs font-semibold
                                   rounded-full
                                   bg-blue-100 text-blue-700
                                   dark:bg-blue-900/40
                                   dark:text-blue-300"
                        >
                            Izin: {{ $rekapStatus['izin'] }}
                        </span>

                        <span
                            class="inline-flex items-center gap-1
                                   px-3 py-1.5
                                   text-xs font-semibold
                                   rounded-full
                                   bg-purple-100 text-purple-700
                                   dark:bg-purple-900/40
                                   dark:text-purple-300"
                        >
                            Sakit: {{ $rekapStatus['sakit'] }}
                        </span>

                        <span
                            class="inline-flex items-center gap-1
                                   px-3 py-1.5
                                   text-xs font-semibold
                                   rounded-full
                                   bg-indigo-100 text-indigo-700
                                   dark:bg-indigo-900/40
                                   dark:text-indigo-300"
                        >
                            Dinas Luar: {{ $rekapStatus['dinas_luar'] }}
                        </span>

                        <span
                            class="inline-flex items-center gap-1
                                   px-3 py-1.5
                                   text-xs font-semibold
                                   rounded-full
                                   bg-teal-100 text-teal-700
                                   dark:bg-teal-900/40
                                   dark:text-teal-300"
                        >
                            Cuti: {{ $rekapStatus['cuti'] }}
                        </span>

                        <span
                            class="inline-flex items-center gap-1
                                   px-3 py-1.5
                                   text-xs font-semibold
                                   rounded-full
                                   bg-orange-100 text-orange-700
                                   dark:bg-orange-900/40
                                   dark:text-orange-300"
                        >
                            Lainnya: {{ $rekapStatus['lainnya'] }}
                        </span>

                        <span
                            class="inline-flex items-center gap-1
                                   px-3 py-1.5
                                   text-xs font-semibold
                                   rounded-full
                                   bg-red-100 text-red-700
                                   dark:bg-red-900/40
                                   dark:text-red-300"
                        >
                            Alpha: {{ $rekapStatus['alpha'] }}
                        </span>

                    </div>

                </div>

            @endif

        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            {{-- ========================= --}}
            {{-- REKAP ABSENSI SELURUH PEGAWAI --}}
            {{-- ========================= --}}

            @if($isSenin)

                {{-- ========================= --}}
                {{-- REKAP PER BIDANG --}}
                {{-- ========================= --}}

                <div
                    class="mb-8 rounded-xl border border-gray-200
                           dark:border-gray-700
                           bg-white dark:bg-gray-800/60
                           p-4"
                >

                    <div class="flex flex-wrap justify-start gap-2">

                        @forelse($rekapBidang as $bidang => $jumlah)

                            <span
                                class="inline-flex items-center gap-1.5
                                       px-3 py-1.5
                                       text-xs font-medium
                                       rounded-full
                                       bg-gray-100 text-gray-700
                                       border border-gray-200
                                       dark:bg-gray-700
                                       dark:text-gray-200
                                       dark:border-gray-600"
                            >
                                <span class="font-semibold">
                                    {{ $bidang }}
                                    ({{ $totalPegawaiPerBidang[$bidang] ?? 0 }})
                                </span>

                                <span class="text-green-600 dark:text-green-400">
                                    Hadir: {{ $jumlah['hadir'] }}
                                </span>

                                <span class="text-gray-400">|</span>

                                <span class="text-red-600 dark:text-red-400">
                                    Tidak Hadir: {{ $jumlah['tidak_hadir'] }}
                                </span>
                            </span>

                        @empty

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Belum ada data absensi hari ini.
                            </span>

                        @endforelse

                    </div>

                </div>

            @else

                <div class="mb-6">

                    <h1
                        class="text-2xl font-bold
                               text-gray-900 dark:text-white"
                    >
                        Riwayat Apel
                    </h1>

                    <p
                        class="mt-1
                               text-gray-600 dark:text-gray-400"
                    >
                        Berikut adalah riwayat kehadiran Apel Pagi Anda.
                    </p>

                </div>

            @endif



            {{-- ========================= --}}
            {{-- TABEL --}}
            {{-- ========================= --}}

            <div
                class="bg-white dark:bg-gray-800
                       shadow-sm rounded-xl"
            >

                <div class="p-6">

                    <div class="overflow-x-auto">

                        <table
                            class="min-w-full
                                   divide-y divide-gray-200
                                   dark:divide-gray-700"
                        >

                            <thead
                                class="bg-gray-50
                                       dark:bg-gray-700"
                            >

                                <tr>

                                    <th
                                        class="px-4 py-3
                                               text-left
                                               text-xs font-semibold
                                               uppercase
                                               text-gray-600
                                               dark:text-gray-300"
                                    >
                                        Tanggal Apel
                                    </th>

                                    <th
                                        class="px-4 py-3
                                               text-center
                                               text-xs font-semibold
                                               uppercase
                                               text-gray-600
                                               dark:text-gray-300"
                                    >
                                        Jam
                                    </th>

                                    <th
                                        class="px-4 py-3
                                               text-center
                                               text-xs font-semibold
                                               uppercase
                                               text-gray-600
                                               dark:text-gray-300"
                                    >
                                        Status
                                    </th>

                                    <th
                                        class="px-4 py-3
                                               text-center
                                               text-xs font-semibold
                                               uppercase
                                               text-gray-600
                                               dark:text-gray-300"
                                    >
                                        Selfie
                                    </th>

                                    <th
                                        class="px-4 py-3
                                               text-center
                                               text-xs font-semibold
                                               uppercase
                                               text-gray-600
                                               dark:text-gray-300"
                                    >
                                        Lokasi
                                    </th>

                                    <th
                                        class="px-4 py-3
                                               text-left
                                               text-xs font-semibold
                                               uppercase
                                               text-gray-600
                                               dark:text-gray-300"
                                    >
                                        Keterangan
                                    </th>

                                </tr>

                            </thead>



                            <tbody
                                class="divide-y divide-gray-200
                                       dark:divide-gray-700"
                            >

                                @forelse($riwayatAbsensi as $absensi)

                                    <tr
                                        class="hover:bg-gray-50
                                               dark:hover:bg-gray-700"
                                    >


                                        {{-- ========================= --}}
                                        {{-- TANGGAL --}}
                                        {{-- ========================= --}}

                                        <td
                                            class="px-4 py-4
                                                   whitespace-nowrap
                                                   text-gray-700
                                                   dark:text-gray-300"
                                        >

                                            {{
                                                \Carbon\Carbon::parse(
                                                    $absensi->tanggal
                                                )
                                                ->locale('id')
                                                ->translatedFormat(
                                                    'd F Y'
                                                )
                                            }}

                                        </td>



                                        {{-- ========================= --}}
                                        {{-- JAM --}}
                                        {{-- ========================= --}}

                                        <td
                                            class="px-4 py-4
                                                   text-center
                                                   whitespace-nowrap
                                                   text-gray-700
                                                   dark:text-gray-300"
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



                                        {{-- ========================= --}}
                                        {{-- STATUS --}}
                                        {{-- ========================= --}}

                                        <td class="px-4 py-4 text-center">

                                            @if($absensi->status === 'hadir')

                                                <span
                                                    class="inline-flex
                                                           px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-green-100
                                                           text-green-700
                                                           dark:bg-green-900/40
                                                           dark:text-green-300"
                                                >
                                                    Hadir
                                                </span>


                                            @elseif($absensi->status === 'terlambat')

                                                <span
                                                    class="inline-flex
                                                           px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-yellow-100
                                                           text-yellow-700
                                                           dark:bg-yellow-900/40
                                                           dark:text-yellow-300"
                                                >
                                                    Terlambat
                                                </span>


                                            @elseif($absensi->status === 'izin')

                                                <span
                                                    class="inline-flex
                                                           px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-blue-100
                                                           text-blue-700
                                                           dark:bg-blue-900/40
                                                           dark:text-blue-300"
                                                >
                                                    Izin
                                                </span>


                                            @elseif($absensi->status === 'sakit')

                                                <span
                                                    class="inline-flex
                                                           px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-purple-100
                                                           text-purple-700
                                                           dark:bg-purple-900/40
                                                           dark:text-purple-300"
                                                >
                                                    Sakit
                                                </span>


                                            @elseif($absensi->status === 'dinas_luar')

                                                <span
                                                    class="inline-flex
                                                           px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-indigo-100
                                                           text-indigo-700
                                                           dark:bg-indigo-900/40
                                                           dark:text-indigo-300"
                                                >
                                                    Dinas Luar
                                                </span>


                                            @elseif($absensi->status === 'cuti')

                                                <span
                                                    class="inline-flex
                                                           px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-teal-100
                                                           text-teal-700
                                                           dark:bg-teal-900/40
                                                           dark:text-teal-300"
                                                >
                                                    Cuti
                                                </span>


                                            @elseif($absensi->status === 'lainnya')

                                                <span
                                                    class="inline-flex
                                                           px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-orange-100
                                                           text-orange-700
                                                           dark:bg-orange-900/40
                                                           dark:text-orange-300"
                                                >
                                                    Lainnya
                                                </span>


                                            @elseif($absensi->status === 'alpha')

                                                <span
                                                    class="inline-flex
                                                           px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-red-100
                                                           text-red-700
                                                           dark:bg-red-900/40
                                                           dark:text-red-300"
                                                >
                                                    Alpha
                                                </span>


                                            @else

                                                <span
                                                    class="inline-flex
                                                           px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-gray-100
                                                           text-gray-700
                                                           dark:bg-gray-700
                                                           dark:text-gray-300"
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



                                        {{-- ========================= --}}
                                        {{-- SELFIE --}}
                                        {{-- ========================= --}}

                                        <td class="px-4 py-4 text-center">

                                            @if($absensi->foto_masuk)

                                                <a
                                                    href="{{ $absensi->foto_masuk_view_url }}"
                                                    target="_blank"
                                                    class="inline-block"
                                                >

                                                    <img
                                                        src="{{ $absensi->foto_masuk_url }}"
                                                        alt="Selfie Apel"
                                                        class="w-14 h-14
                                                               mx-auto
                                                               object-cover
                                                               rounded-lg
                                                               border
                                                               border-gray-200
                                                               dark:border-gray-600
                                                               hover:opacity-80
                                                               transition"
                                                    >

                                                </a>

                                            @else

                                                <span
                                                    class="text-gray-400"
                                                >
                                                    -
                                                </span>

                                            @endif

                                        </td>



                                        {{-- ========================= --}}
                                        {{-- LOKASI --}}
                                        {{-- ========================= --}}

                                        <td class="px-4 py-4 text-center">

                                            @if(
                                                $absensi->latitude_masuk &&
                                                $absensi->longitude_masuk
                                            )

                                                <a
                                                    href="https://www.google.com/maps?q={{ $absensi->latitude_masuk }},{{ $absensi->longitude_masuk }}"
                                                    target="_blank"
                                                    class="inline-flex
                                                           px-3 py-2
                                                           text-xs
                                                           font-semibold
                                                           bg-blue-600
                                                           hover:bg-blue-700
                                                           text-white
                                                           rounded-lg
                                                           transition"
                                                >
                                                    Lihat Lokasi
                                                </a>

                                            @else

                                                <span
                                                    class="text-gray-400"
                                                >
                                                    -
                                                </span>

                                            @endif

                                        </td>



                                        {{-- ========================= --}}
                                        {{-- KETERANGAN --}}
                                        {{-- ========================= --}}

                                        <td
                                            class="px-4 py-4
                                                   min-w-52
                                                   text-sm
                                                   text-gray-700
                                                   dark:text-gray-300"
                                        >

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

                                                <div>

                                                    <p class="font-semibold">

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


                                                    <p
                                                        class="mt-1
                                                               text-gray-500
                                                               dark:text-gray-400"
                                                    >
                                                        {{
                                                            $absensi->keterangan
                                                            ?: '-'
                                                        }}
                                                    </p>

                                                </div>

                                            @elseif($absensi->status === 'alpha')

                                                <span
                                                    class="text-red-600
                                                           dark:text-red-400"
                                                >
                                                    Tanpa keterangan
                                                </span>

                                            @else

                                                <span
                                                    class="text-gray-400"
                                                >
                                                    -
                                                </span>

                                            @endif

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td
                                            colspan="6"
                                            class="px-4 py-10
                                                   text-center
                                                   text-gray-500
                                                   dark:text-gray-400"
                                        >
                                            Belum ada riwayat Apel Pagi.
                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>



                    {{-- ========================= --}}
                    {{-- PAGINATION --}}
                    {{-- ========================= --}}

                    @if($riwayatAbsensi->hasPages())

                        <div class="mt-6">

                            {{ $riwayatAbsensi->links() }}

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
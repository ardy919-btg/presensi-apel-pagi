<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Riwayat Apel Pagi Pegawai
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Data kehadiran Apel Pagi pegawai BPKAD.
                </p>

            </div>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">




            {{-- ========================= --}}
            {{-- FILTER --}}
            {{-- ========================= --}}

            <div
                class="mb-6
                       bg-white dark:bg-gray-800
                       shadow-sm sm:rounded-xl"
            >

                <div class="p-6">

                    <div class="mb-5">

                        <h3
                            class="text-lg font-semibold
                                   text-gray-900 dark:text-white"
                        >
                            Filter Riwayat Apel
                        </h3>

                        <p
                            class="mt-1 text-sm
                                   text-gray-500 dark:text-gray-400"
                        >
                            Cari data Apel Pagi berdasarkan pegawai,
                            tanggal, atau status.
                        </p>

                    </div>


                    <form
                        action="{{ route('admin.absensi.index') }}"
                        method="GET"
                    >

                        <div
                            class="grid grid-cols-1
                                   md:grid-cols-2
                                   lg:grid-cols-4
                                   gap-4"
                        >


                            {{-- Nama / NIP --}}
                            <div>

                                <label
                                    for="pegawai"
                                    class="block mb-2
                                           text-sm font-medium
                                           text-gray-700 dark:text-gray-300"
                                >
                                    Nama / NIP Pegawai
                                </label>

                                <input
                                    type="text"
                                    name="pegawai"
                                    id="pegawai"
                                    value="{{ request('pegawai') }}"
                                    placeholder="Cari nama atau NIP..."
                                    class="w-full rounded-lg
                                           border-gray-300
                                           dark:border-gray-600
                                           dark:bg-gray-700
                                           dark:text-white
                                           focus:border-indigo-500
                                           focus:ring-indigo-500"
                                >

                            </div>


                            {{-- Tanggal Awal --}}
                            <div>

                                <label
                                    for="tanggal_awal"
                                    class="block mb-2
                                           text-sm font-medium
                                           text-gray-700 dark:text-gray-300"
                                >
                                    Tanggal Awal
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_awal"
                                    id="tanggal_awal"
                                    value="{{ request('tanggal_awal') }}"
                                    class="w-full rounded-lg
                                           border-gray-300
                                           dark:border-gray-600
                                           dark:bg-gray-700
                                           dark:text-white
                                           focus:border-indigo-500
                                           focus:ring-indigo-500"
                                >

                            </div>


                            {{-- Tanggal Akhir --}}
                            <div>

                                <label
                                    for="tanggal_akhir"
                                    class="block mb-2
                                           text-sm font-medium
                                           text-gray-700 dark:text-gray-300"
                                >
                                    Tanggal Akhir
                                </label>

                                <input
                                    type="date"
                                    name="tanggal_akhir"
                                    id="tanggal_akhir"
                                    value="{{ request('tanggal_akhir') }}"
                                    class="w-full rounded-lg
                                           border-gray-300
                                           dark:border-gray-600
                                           dark:bg-gray-700
                                           dark:text-white
                                           focus:border-indigo-500
                                           focus:ring-indigo-500"
                                >

                            </div>


                            {{-- Status --}}
                            <div>

                                <label
                                    for="status"
                                    class="block mb-2
                                           text-sm font-medium
                                           text-gray-700 dark:text-gray-300"
                                >
                                    Status
                                </label>

                                <select
                                    name="status"
                                    id="status"
                                    class="w-full rounded-lg
                                           border-gray-300
                                           dark:border-gray-600
                                           dark:bg-gray-700
                                           dark:text-white
                                           focus:border-indigo-500
                                           focus:ring-indigo-500"
                                >

                                    <option value="">
                                        Semua Status
                                    </option>

                                    <option
                                        value="hadir"
                                        {{ request('status') === 'hadir' ? 'selected' : '' }}
                                    >
                                        Hadir
                                    </option>

                                    <option
                                        value="terlambat"
                                        {{ request('status') === 'terlambat' ? 'selected' : '' }}
                                    >
                                        Terlambat
                                    </option>

                                    <option
                                        value="izin"
                                        {{ request('status') === 'izin' ? 'selected' : '' }}
                                    >
                                        Izin
                                    </option>

                                    <option
                                        value="sakit"
                                        {{ request('status') === 'sakit' ? 'selected' : '' }}
                                    >
                                        Sakit
                                    </option>

                                    <option
                                        value="dinas_luar"
                                        {{ request('status') === 'dinas_luar' ? 'selected' : '' }}
                                    >
                                        Dinas Luar
                                    </option>

                                    <option
                                        value="cuti"
                                        {{ request('status') === 'cuti' ? 'selected' : '' }}
                                    >
                                        Cuti
                                    </option>

                                    <option
                                        value="lainnya"
                                        {{ request('status') === 'lainnya' ? 'selected' : '' }}
                                    >
                                        Lainnya
                                    </option>

                                    <option
                                        value="alpha"
                                        {{ request('status') === 'alpha' ? 'selected' : '' }}
                                    >
                                        Alpha
                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- Tombol --}}
                        <div class="mt-5 flex flex-wrap gap-3">

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center
                                       px-5 py-2.5
                                       bg-indigo-600 hover:bg-indigo-700
                                       text-white font-semibold
                                       rounded-lg transition"
                            >
                                Filter
                            </button>

                            <a
                                href="{{ route('admin.absensi.index') }}"
                                class="inline-flex items-center justify-center
                                       px-5 py-2.5
                                       bg-gray-500 hover:bg-gray-600
                                       text-white font-semibold
                                       rounded-lg transition"
                            >
                                Reset
                            </a>

                        </div>

                    </form>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- INFO FILTER --}}
            {{-- ========================= --}}

            @if(
                request()->filled('pegawai') ||
                request()->filled('tanggal_awal') ||
                request()->filled('tanggal_akhir') ||
                request()->filled('status')
            )

                <div
                    class="mb-4 text-sm
                           text-gray-600 dark:text-gray-400"
                >

                    Menampilkan

                    <span
                        class="font-semibold
                               text-gray-900 dark:text-white"
                    >
                        {{ $absensis->total() }}
                    </span>

                    data yang sesuai dengan filter.

                </div>

            @endif


            {{-- ========================= --}}
            {{-- TABEL --}}
            {{-- ========================= --}}

            <div
                class="bg-white dark:bg-gray-800
                       overflow-hidden
                       shadow-sm sm:rounded-xl"
            >

                <div
                    class="p-6
                           text-gray-900 dark:text-gray-100"
                >

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

                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                                        Pegawai
                                    </th>

                                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                                        Tanggal Apel
                                    </th>

                                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                                        Jam
                                    </th>

                                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                                        Status
                                    </th>

                                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                                        Selfie
                                    </th>

                                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                                        Lokasi
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                                        Keterangan
                                    </th>

                                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody
                                class="divide-y divide-gray-200
                                       dark:divide-gray-700"
                            >

                                @forelse($absensis as $absensi)

                                    <tr
                                        class="hover:bg-gray-50
                                               dark:hover:bg-gray-700"
                                    >


                                        {{-- Pegawai --}}
                                        <td class="px-4 py-4">

                                            <div
                                                class="font-semibold
                                                       text-gray-900
                                                       dark:text-gray-100"
                                            >
                                                {{ $absensi->user->name ?? '-' }}
                                            </div>

                                            <div
                                                class="text-sm
                                                       text-gray-500
                                                       dark:text-gray-400"
                                            >
                                                {{ $absensi->user->nip ?? '-' }}
                                            </div>

                                        </td>


                                        {{-- Tanggal --}}
                                        <td
                                            class="px-4 py-4
                                                   text-center
                                                   whitespace-nowrap"
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


                                        {{-- Jam --}}
                                        <td
                                            class="px-4 py-4
                                                   text-center
                                                   whitespace-nowrap"
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
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-green-100 text-green-700
                                                           dark:bg-green-900/40
                                                           dark:text-green-300"
                                                >
                                                    Hadir
                                                </span>

                                            @elseif($absensi->status === 'terlambat')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-yellow-100 text-yellow-700
                                                           dark:bg-yellow-900/40
                                                           dark:text-yellow-300"
                                                >
                                                    Terlambat
                                                </span>

                                            @elseif($absensi->status === 'izin')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-blue-100 text-blue-700
                                                           dark:bg-blue-900/40
                                                           dark:text-blue-300"
                                                >
                                                    Izin
                                                </span>

                                            @elseif($absensi->status === 'sakit')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-purple-100 text-purple-700
                                                           dark:bg-purple-900/40
                                                           dark:text-purple-300"
                                                >
                                                    Sakit
                                                </span>

                                            @elseif($absensi->status === 'dinas_luar')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-indigo-100 text-indigo-700
                                                           dark:bg-indigo-900/40
                                                           dark:text-indigo-300"
                                                >
                                                    Dinas Luar
                                                </span>

                                            @elseif($absensi->status === 'cuti')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-teal-100 text-teal-700
                                                           dark:bg-teal-900/40
                                                           dark:text-teal-300"
                                                >
                                                    Cuti
                                                </span>

                                            @elseif($absensi->status === 'lainnya')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-orange-100 text-orange-700
                                                           dark:bg-orange-900/40
                                                           dark:text-orange-300"
                                                >
                                                    Lainnya
                                                </span>

                                            @elseif($absensi->status === 'alpha')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-red-100 text-red-700
                                                           dark:bg-red-900/40
                                                           dark:text-red-300"
                                                >
                                                    Alpha
                                                </span>

                                            @else

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           rounded-full
                                                           bg-gray-100 text-gray-700
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


                                            @if($absensi->is_simulasi)

                                                <span
                                                    class="block mt-1 text-[10px] font-semibold
                                                           text-amber-600 dark:text-amber-400"
                                                    title="Data hasil simulasi, bukan Apel Pagi sungguhan"
                                                >
                                                    🧪 Simulasi
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Selfie --}}
                                        <td class="px-4 py-4 text-center">

                                            @if($absensi->foto_masuk)

                                                <a
                                                    href="{{ $absensi->foto_masuk_view_url }}"
                                                    target="_blank"
                                                    title="Selfie Apel"
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

                                                <span class="text-gray-400">
                                                    -
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Lokasi --}}
                                        <td class="px-4 py-4 text-center">

                                            @if(
                                                $absensi->latitude_masuk &&
                                                $absensi->longitude_masuk
                                            )

                                                <a
                                                    href="https://www.google.com/maps?q={{ $absensi->latitude_masuk }},{{ $absensi->longitude_masuk }}"
                                                    target="_blank"
                                                    class="inline-flex
                                                           justify-center
                                                           px-3 py-2
                                                           text-xs font-semibold
                                                           bg-blue-600
                                                           hover:bg-blue-700
                                                           text-white
                                                           rounded-lg
                                                           transition"
                                                >
                                                    Lihat Lokasi
                                                </a>

                                            @else

                                                <span class="text-gray-400">
                                                    -
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Keterangan --}}
                                        <td
                                            class="px-4 py-4
                                                   min-w-56
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

                                                <span class="text-gray-400">
                                                    -
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Aksi --}}
                                        <td class="px-4 py-4 text-center">

                                            <a
                                                href="{{ route('admin.absensi.show', $absensi->id) }}"
                                                class="inline-flex
                                                       items-center
                                                       justify-center
                                                       px-4 py-2
                                                       bg-indigo-600
                                                       hover:bg-indigo-700
                                                       text-white
                                                       text-xs font-semibold
                                                       rounded-lg
                                                       transition"
                                            >
                                                Lihat Detail
                                            </a>

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td
                                            colspan="8"
                                            class="px-4 py-10
                                                   text-center
                                                   text-gray-500
                                                   dark:text-gray-400"
                                        >

                                            @if(
                                                request()->filled('pegawai') ||
                                                request()->filled('tanggal_awal') ||
                                                request()->filled('tanggal_akhir') ||
                                                request()->filled('status')
                                            )

                                                Tidak ada data Apel Pagi
                                                yang sesuai dengan filter.

                                            @else

                                                Belum ada data Apel Pagi pegawai.

                                            @endif

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>


                    {{-- ========================= --}}
                    {{-- PAGINATION --}}
                    {{-- ========================= --}}

                    @if($absensis->hasPages())

                        <div class="mt-6">

                            {{ $absensis->links() }}

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
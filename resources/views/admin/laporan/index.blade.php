<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Laporan Apel Pagi
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Rekap kehadiran Apel Pagi pegawai berdasarkan periode dan status.
            </p>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            {{-- ========================= --}}
            {{-- FILTER --}}
            {{-- ========================= --}}

            <div class="mb-6 bg-white dark:bg-gray-800 shadow-sm rounded-xl">

                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Filter Laporan Apel
                    </h3>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Pilih pegawai, periode tanggal, atau status Apel Pagi.
                    </p>


                    <form
                        action="{{ route('admin.laporan.index') }}"
                        method="GET"
                        class="mt-5"
                    >

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">


                            {{-- Pegawai --}}
                            <div>

                                <label
                                    for="pegawai"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                                >
                                    Nama / NIP
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
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
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
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
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
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
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


                        {{-- ========================= --}}
                        {{-- TOMBOL --}}
                        {{-- ========================= --}}

                        <div class="mt-5 flex flex-wrap gap-3">

                            <button
                                type="submit"
                                class="px-5 py-2.5
                                       bg-indigo-600 hover:bg-indigo-700
                                       text-white font-semibold
                                       rounded-lg transition"
                            >
                                Tampilkan Laporan
                            </button>


                            <a
                                href="{{ route('admin.laporan.index') }}"
                                class="px-5 py-2.5
                                       bg-gray-500 hover:bg-gray-600
                                       text-white font-semibold
                                       rounded-lg transition"
                            >
                                Reset
                            </a>


                            <a
                                href="{{ route('admin.laporan.pdf', request()->query()) }}"
                                class="inline-flex items-center gap-2
                                       px-5 py-2.5
                                       bg-red-600 hover:bg-red-700
                                       text-white font-semibold
                                       rounded-lg transition"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 16v-8m0 8l-3.5-3.5M12 16l3.5-3.5M5 20h14"
                                    />
                                </svg>

                                Download PDF

                            </a>


                            <a
                                href="{{ route('admin.laporan.excel', request()->query()) }}"
                                class="inline-flex items-center gap-2
                                       px-5 py-2.5
                                       bg-green-600 hover:bg-green-700
                                       text-white font-semibold
                                       rounded-lg transition"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 16v-8m0 8l-3.5-3.5M12 16l3.5-3.5M5 20h14"
                                    />
                                </svg>

                                Download Excel

                            </a>

                        </div>

                    </form>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- STATISTIK --}}
            {{-- ========================= --}}

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-9 gap-4 mb-6">


                {{-- Total --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Total Data
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $totalData }}
                    </p>

                </div>


                {{-- Hadir --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Hadir
                    </p>

                    <p class="mt-2 text-2xl font-bold text-green-600">
                        {{ $totalHadir }}
                    </p>

                </div>


                {{-- Terlambat --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Terlambat
                    </p>

                    <p class="mt-2 text-2xl font-bold text-yellow-500">
                        {{ $totalTerlambat }}
                    </p>

                </div>


                {{-- Izin --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Izin
                    </p>

                    <p class="mt-2 text-2xl font-bold text-blue-600">
                        {{ $totalIzin }}
                    </p>

                </div>


                {{-- Sakit --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Sakit
                    </p>

                    <p class="mt-2 text-2xl font-bold text-purple-600">
                        {{ $totalSakit }}
                    </p>

                </div>


                {{-- Dinas Luar --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Dinas Luar
                    </p>

                    <p class="mt-2 text-2xl font-bold text-indigo-600">
                        {{ $totalDinasLuar }}
                    </p>

                </div>


                {{-- Cuti --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Cuti
                    </p>

                    <p class="mt-2 text-2xl font-bold text-teal-600">
                        {{ $totalCuti }}
                    </p>

                </div>


                {{-- Lainnya --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Lainnya
                    </p>

                    <p class="mt-2 text-2xl font-bold text-orange-600">
                        {{ $totalLainnya }}
                    </p>

                </div>


                {{-- Alpha --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5">

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Alpha
                    </p>

                    <p class="mt-2 text-2xl font-bold text-red-600">
                        {{ $totalAlpha }}
                    </p>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- TABEL LAPORAN --}}
            {{-- ========================= --}}

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl overflow-hidden">

                <div class="p-6">


                    <div class="mb-5">

                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Data Laporan Apel Pagi
                        </h3>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ $laporan->total() }} data Apel Pagi ditemukan.
                        </p>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-100">

                                <tr>

                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                                        No
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                                        Pegawai
                                    </th>

                                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase">
                                        Tanggal Apel
                                    </th>

                                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase">
                                        Jam Pengisian
                                    </th>

                                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase">
                                        Status
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase">
                                        Keterangan
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-700 dark:text-gray-200">

                                @forelse($laporan as $absensi)

                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">


                                        {{-- No --}}
                                        <td class="px-4 py-4">

                                            {{
                                                $laporan->firstItem()
                                                + $loop->index
                                            }}

                                        </td>


                                        {{-- Pegawai --}}
                                        <td class="px-4 py-4">

                                            <div class="font-semibold text-gray-900 dark:text-white">
                                                {{ $absensi->user->name ?? '-' }}
                                            </div>

                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $absensi->user->nip ?? '-' }}
                                            </div>

                                        </td>


                                        {{-- Tanggal --}}
                                        <td class="px-4 py-4 text-center whitespace-nowrap">

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


                                        {{-- Jam Pengisian --}}
                                        <td class="px-4 py-4 text-center whitespace-nowrap">

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
                                                           bg-green-100 text-green-700
                                                           rounded-full"
                                                >
                                                    Hadir
                                                </span>

                                            @elseif($absensi->status === 'terlambat')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           bg-yellow-100 text-yellow-700
                                                           rounded-full"
                                                >
                                                    Terlambat
                                                </span>

                                            @elseif($absensi->status === 'izin')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           bg-blue-100 text-blue-700
                                                           rounded-full"
                                                >
                                                    Izin
                                                </span>

                                            @elseif($absensi->status === 'sakit')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           bg-purple-100 text-purple-700
                                                           rounded-full"
                                                >
                                                    Sakit
                                                </span>

                                            @elseif($absensi->status === 'dinas_luar')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           bg-indigo-100 text-indigo-700
                                                           rounded-full"
                                                >
                                                    Dinas Luar
                                                </span>

                                            @elseif($absensi->status === 'cuti')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           bg-teal-100 text-teal-700
                                                           rounded-full"
                                                >
                                                    Cuti
                                                </span>

                                            @elseif($absensi->status === 'lainnya')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           bg-orange-100 text-orange-700
                                                           rounded-full"
                                                >
                                                    Lainnya
                                                </span>

                                            @elseif($absensi->status === 'alpha')

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           bg-red-100 text-red-700
                                                           rounded-full"
                                                >
                                                    Alpha
                                                </span>

                                            @else

                                                <span
                                                    class="inline-flex px-3 py-1
                                                           text-xs font-semibold
                                                           bg-gray-100 text-gray-700
                                                           rounded-full"
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


                                        {{-- Keterangan --}}
                                        <td class="px-4 py-4 min-w-64">

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

                                                <div class="text-sm">

                                                    <div class="font-semibold text-gray-900 dark:text-white">

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

                                                    </div>

                                                    <div class="mt-1 text-gray-500 dark:text-gray-400">
                                                        {{ $absensi->keterangan ?: '-' }}
                                                    </div>

                                                </div>

                                            @elseif($absensi->status === 'alpha')

                                                <span class="text-sm text-red-600 dark:text-red-400">
                                                    Tanpa keterangan
                                                </span>

                                            @else

                                                <span class="text-gray-400">
                                                    -
                                                </span>

                                            @endif

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td
                                            colspan="6"
                                            class="px-4 py-8 text-center text-gray-500 dark:text-gray-400"
                                        >
                                            Tidak ada data Apel Pagi sesuai filter.
                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>


                    {{-- Pagination --}}
                    @if($laporan->hasPages())

                        <div class="mt-6">

                            {{ $laporan->links() }}

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
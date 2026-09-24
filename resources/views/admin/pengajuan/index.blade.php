<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Pengajuan Izin / Sakit
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Kelola pengajuan izin dan sakit dari pegawai.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            {{-- Filter --}}
            <div class="mb-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="mb-5">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Filter Pengajuan
                        </h3>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Cari pengajuan berdasarkan pegawai, jenis, atau status.
                        </p>
                    </div>


                    <form
                        method="GET"
                        action="{{ route('admin.pengajuan.index') }}"
                    >
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            {{-- Pegawai --}}
                            <div>
                                <label
                                    for="pegawai"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                                >
                                    Pegawai
                                </label>

                                <input
                                    type="text"
                                    name="pegawai"
                                    id="pegawai"
                                    value="{{ request('pegawai') }}"
                                    placeholder="Nama atau NIP..."
                                    class="block w-full rounded-lg border-gray-300
                                           dark:border-gray-600 dark:bg-gray-700 dark:text-white
                                           focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>


                            {{-- Jenis --}}
                            <div>
                                <label
                                    for="jenis"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                                >
                                    Jenis
                                </label>

                                <select
                                    name="jenis"
                                    id="jenis"
                                    class="block w-full rounded-lg border-gray-300
                                           dark:border-gray-600 dark:bg-gray-700 dark:text-white
                                           focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option value="">
                                        Semua Jenis
                                    </option>

                                    <option
                                        value="izin"
                                        {{ request('jenis') === 'izin' ? 'selected' : '' }}
                                    >
                                        Izin
                                    </option>

                                    <option
                                        value="sakit"
                                        {{ request('jenis') === 'sakit' ? 'selected' : '' }}
                                    >
                                        Sakit
                                    </option>
                                </select>
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
                                    class="block w-full rounded-lg border-gray-300
                                           dark:border-gray-600 dark:bg-gray-700 dark:text-white
                                           focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option value="">
                                        Semua Status
                                    </option>

                                    <option
                                        value="menunggu"
                                        {{ request('status') === 'menunggu' ? 'selected' : '' }}
                                    >
                                        Menunggu
                                    </option>

                                    <option
                                        value="disetujui"
                                        {{ request('status') === 'disetujui' ? 'selected' : '' }}
                                    >
                                        Disetujui
                                    </option>

                                    <option
                                        value="ditolak"
                                        {{ request('status') === 'ditolak' ? 'selected' : '' }}
                                    >
                                        Ditolak
                                    </option>
                                </select>
                            </div>

                        </div>


                        <div class="mt-5 flex flex-wrap gap-3">

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-lg
                                       bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white
                                       hover:bg-indigo-700 transition"
                            >
                                Tampilkan
                            </button>


                            <a
                                href="{{ route('admin.pengajuan.index') }}"
                                class="inline-flex items-center justify-center rounded-lg
                                       bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700
                                       hover:bg-gray-300
                                       dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600
                                       transition"
                            >
                                Reset
                            </a>

                        </div>
                    </form>

                </div>
            </div>


            {{-- Tabel Pengajuan --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">

                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Daftar Pengajuan
                    </h3>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Pengajuan terbaru ditampilkan terlebih dahulu.
                    </p>
                </div>


                @if ($pengajuans->count() > 0)

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider
                                               text-gray-500 dark:text-gray-300"
                                    >
                                        No
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider
                                               text-gray-500 dark:text-gray-300"
                                    >
                                        Pegawai
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider
                                               text-gray-500 dark:text-gray-300"
                                    >
                                        Jenis
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider
                                               text-gray-500 dark:text-gray-300"
                                    >
                                        Periode
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider
                                               text-gray-500 dark:text-gray-300"
                                    >
                                        Keterangan
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider
                                               text-gray-500 dark:text-gray-300"
                                    >
                                        Status
                                    </th>

                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider
                                               text-gray-500 dark:text-gray-300"
                                    >
                                        Aksi
                                    </th>

                                </tr>
                            </thead>


                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">

                                @foreach ($pengajuans as $pengajuan)

                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">

                                        {{-- No --}}
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-sm
                                                   text-gray-700 dark:text-gray-300"
                                        >
                                            {{ $pengajuans->firstItem() + $loop->index }}
                                        </td>


                                        {{-- Pegawai --}}
                                        <td class="px-6 py-4">

                                            <div class="font-medium text-gray-900 dark:text-white">
                                                {{ $pengajuan->user->name ?? '-' }}
                                            </div>

                                            <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                NIP:
                                                {{ $pengajuan->user->nip ?? '-' }}
                                            </div>

                                        </td>


                                        {{-- Jenis --}}
                                        <td class="whitespace-nowrap px-6 py-4">

                                            @if ($pengajuan->jenis === 'izin')

                                                <span
                                                    class="inline-flex rounded-full bg-blue-100 px-3 py-1
                                                           text-xs font-semibold text-blue-700
                                                           dark:bg-blue-900/40 dark:text-blue-300"
                                                >
                                                    Izin
                                                </span>

                                            @else

                                                <span
                                                    class="inline-flex rounded-full bg-orange-100 px-3 py-1
                                                           text-xs font-semibold text-orange-700
                                                           dark:bg-orange-900/40 dark:text-orange-300"
                                                >
                                                    Sakit
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Periode --}}
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-sm
                                                   text-gray-700 dark:text-gray-300"
                                        >

                                            <div>
                                                {{ $pengajuan->tanggal_mulai->format('d-m-Y') }}
                                            </div>

                                            @if (
                                                !$pengajuan->tanggal_mulai->isSameDay(
                                                    $pengajuan->tanggal_selesai
                                                )
                                            )

                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    s/d
                                                    {{ $pengajuan->tanggal_selesai->format('d-m-Y') }}
                                                </div>

                                            @endif

                                        </td>


                                        {{-- Keterangan --}}
                                        <td
                                            class="px-6 py-4 text-sm
                                                   text-gray-700 dark:text-gray-300"
                                        >
                                            <div class="max-w-xs">
                                                {{ \Illuminate\Support\Str::limit(
                                                    $pengajuan->keterangan,
                                                    60
                                                ) }}
                                            </div>
                                        </td>


                                        {{-- Status --}}
                                        <td class="whitespace-nowrap px-6 py-4">

                                            @if ($pengajuan->status === 'menunggu')

                                                <span
                                                    class="inline-flex rounded-full bg-yellow-100 px-3 py-1
                                                           text-xs font-semibold text-yellow-700
                                                           dark:bg-yellow-900/40 dark:text-yellow-300"
                                                >
                                                    Menunggu
                                                </span>

                                            @elseif ($pengajuan->status === 'disetujui')

                                                <span
                                                    class="inline-flex rounded-full bg-green-100 px-3 py-1
                                                           text-xs font-semibold text-green-700
                                                           dark:bg-green-900/40 dark:text-green-300"
                                                >
                                                    Disetujui
                                                </span>

                                            @else

                                                <span
                                                    class="inline-flex rounded-full bg-red-100 px-3 py-1
                                                           text-xs font-semibold text-red-700
                                                           dark:bg-red-900/40 dark:text-red-300"
                                                >
                                                    Ditolak
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Aksi --}}
                                        <td class="whitespace-nowrap px-6 py-4 text-center">

                                            <a
                                                href="{{ route(
                                                    'admin.pengajuan.show',
                                                    $pengajuan
                                                ) }}"
                                                class="inline-flex items-center justify-center
                                                       rounded-lg bg-indigo-600 px-4 py-2
                                                       text-xs font-semibold text-white
                                                       hover:bg-indigo-700 transition"
                                            >
                                                Detail
                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>
                    </div>


                    {{-- Pagination --}}
                    <div class="border-t border-gray-200 p-4 dark:border-gray-700">
                        {{ $pengajuans->links() }}
                    </div>

                @else

                    <div class="p-10 text-center">

                        <div class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                            Tidak Ada Pengajuan
                        </div>

                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Belum ada pengajuan izin atau sakit yang sesuai dengan filter.
                        </p>

                    </div>

                @endif

            </div>

        </div>
    </div>
</x-app-layout>
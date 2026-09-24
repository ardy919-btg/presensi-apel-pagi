<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between gap-4">

            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                Data Pegawai
            </h2>

            <div class="flex items-center gap-3">

                {{-- IMPORT EXCEL --}}
                <form
                    action="{{ route('admin.pegawai.import') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="flex items-center gap-2"
                >

                    @csrf

                    <input
                        type="file"
                        name="file"
                        accept=".xlsx,.xls,.csv"
                        required
                        class="
                            block
                            text-sm
                            text-gray-700
                            dark:text-gray-300
                            file:mr-3
                            file:px-3
                            file:py-2
                            file:border-0
                            file:rounded-lg
                            file:bg-green-600
                            file:text-white
                            hover:file:bg-green-700
                            cursor-pointer
                        "
                    >

                    <button
                        type="submit"
                        class="
                            px-4 py-2
                            bg-green-600
                            hover:bg-green-700
                            text-white
                            rounded-lg
                            transition
                            whitespace-nowrap
                        "
                    >
                        Import Excel
                    </button>

                </form>


                {{-- TAMBAH PEGAWAI --}}
                <a
                    href="{{ route('admin.pegawai.create') }}"
                    class="
                        px-4 py-2
                        bg-blue-600
                        hover:bg-blue-700
                        text-white
                        rounded-lg
                        transition
                        whitespace-nowrap
                    "
                >
                    + Tambah Pegawai
                </a>

            </div>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4">


            {{-- NOTIFIKASI ERROR --}}
            @if($errors->any())

                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">

                    <ul class="list-disc list-inside">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- SEARCH & FILTER --}}
            <div
                class="
                    mb-6
                    bg-white
                    dark:bg-gray-800
                    shadow
                    rounded-lg
                    p-4
                "
            >

                <form
                    method="GET"
                    action="{{ route('admin.pegawai.index') }}"
                    class="
                        grid
                        grid-cols-1
                        md:grid-cols-4
                        gap-4
                    "
                >

                    {{-- Search --}}
                    <div class="md:col-span-2">

                        <label
                            for="search"
                            class="
                                block
                                text-sm
                                font-medium
                                text-gray-700
                                dark:text-gray-300
                                mb-1
                            "
                        >
                            Cari Pegawai
                        </label>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama atau NIP..."
                            class="
                                w-full
                                rounded-lg
                                border-gray-300
                                dark:border-gray-700
                                dark:bg-gray-900
                                dark:text-gray-200
                                focus:border-indigo-500
                                focus:ring-indigo-500
                            "
                        >

                    </div>


                    {{-- Filter Bidang --}}
                    <div>

                        <label
                            for="bidang"
                            class="
                                block
                                text-sm
                                font-medium
                                text-gray-700
                                dark:text-gray-300
                                mb-1
                            "
                        >
                            Bidang
                        </label>

                        <select
                            id="bidang"
                            name="bidang"
                            class="
                                w-full
                                rounded-lg
                                border-gray-300
                                dark:border-gray-700
                                dark:bg-gray-900
                                dark:text-gray-200
                                focus:border-indigo-500
                                focus:ring-indigo-500
                            "
                        >

                            <option value="">
                                Semua Bidang
                            </option>

                            @foreach($bidangList as $bidang)

                                <option
                                    value="{{ $bidang }}"
                                    @selected(request('bidang') === $bidang)
                                >
                                    {{ $bidang }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Filter Status --}}
                    <div>

                        <label
                            for="status"
                            class="
                                block
                                text-sm
                                font-medium
                                text-gray-700
                                dark:text-gray-300
                                mb-1
                            "
                        >
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="
                                w-full
                                rounded-lg
                                border-gray-300
                                dark:border-gray-700
                                dark:bg-gray-900
                                dark:text-gray-200
                                focus:border-indigo-500
                                focus:ring-indigo-500
                            "
                        >

                            <option value="">
                                Semua Status
                            </option>

                            <option
                                value="aktif"
                                @selected(request('status') === 'aktif')
                            >
                                Aktif
                            </option>

                            <option
                                value="nonaktif"
                                @selected(request('status') === 'nonaktif')
                            >
                                Nonaktif
                            </option>

                        </select>

                    </div>


                    {{-- Tombol --}}
                    <div
                        class="
                            md:col-span-4
                            flex
                            justify-end
                            gap-2
                        "
                    >

                        <a
                            href="{{ route('admin.pegawai.index') }}"
                            class="
                                px-4 py-2
                                bg-gray-500
                                hover:bg-gray-600
                                text-white
                                rounded-lg
                                transition
                            "
                        >
                            Reset
                        </a>


                        <button
                            type="submit"
                            class="
                                px-4 py-2
                                bg-indigo-600
                                hover:bg-indigo-700
                                text-white
                                rounded-lg
                                transition
                            "
                        >
                            Cari / Filter
                        </button>

                    </div>

                </form>

            </div>


            {{-- TABEL --}}
            <div
                class="
                    bg-white
                    dark:bg-gray-800
                    shadow
                    rounded-lg
                    overflow-hidden
                "
            >

                <div class="overflow-x-auto">

                    <table
                        class="
                            w-full
                            text-sm
                            text-gray-700
                            dark:text-gray-200
                        "
                    >

                        <thead
                            class="
                                bg-gray-100
                                dark:bg-gray-700
                                text-gray-800
                                dark:text-gray-100
                            "
                        >

                            <tr>

                                <th class="p-4 text-left font-semibold">
                                    No
                                </th>

                                <th class="p-4 text-left font-semibold">
                                    NIP
                                </th>

                                <th class="p-4 text-left font-semibold">
                                    Nama
                                </th>

                                <th class="p-4 text-left font-semibold">
                                    Email
                                </th>

                                <th class="p-4 text-left font-semibold">
                                    Jabatan
                                </th>

                                <th class="p-4 text-left font-semibold">
                                    Bidang
                                </th>

                                <th class="p-4 text-left font-semibold whitespace-nowrap">
                                    Pangkat / Golongan
                                </th>

                                <th class="p-4 text-left font-semibold">
                                    Tanggal Lahir
                                </th>

                                <th class="p-4 text-left font-semibold">
                                    L/P
                                </th>

                                <th class="p-4 text-left font-semibold">
                                    Pendidikan
                                </th>

                                <th class="p-4 text-left font-semibold whitespace-nowrap">
                                    Gol. Darah
                                </th>

                                <th class="p-4 text-left font-semibold">
                                    Status
                                </th>

                                <th class="p-4 text-center font-semibold">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                            @forelse($pegawai as $item)

                                <tr
                                    class="
                                        bg-white
                                        dark:bg-gray-800
                                        hover:bg-gray-50
                                        dark:hover:bg-gray-700
                                        transition
                                    "
                                >

                                    {{-- Nomor pagination --}}
                                    <td class="p-4 text-gray-700 dark:text-gray-300">
                                        {{ $pegawai->firstItem() + $loop->index }}
                                    </td>


                                    {{-- NIP --}}
                                    <td
                                        class="
                                            p-4
                                            text-gray-700
                                            dark:text-gray-300
                                            whitespace-nowrap
                                        "
                                    >
                                        {{ $item->nip }}
                                    </td>


                                    {{-- Nama --}}
                                    <td
                                        class="
                                            p-4
                                            font-semibold
                                            text-gray-900
                                            dark:text-white
                                        "
                                    >
                                        {{ $item->name }}
                                    </td>


                                    {{-- Email --}}
                                    <td class="p-4 text-gray-700 dark:text-gray-300">

                                        @if($item->email)

                                            {{ $item->email }}

                                        @else

                                            <span class="text-gray-400">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Jabatan --}}
                                    <td class="p-4 text-gray-700 dark:text-gray-300">

                                        {{ $item->jabatan ?: '-' }}

                                    </td>


                                    {{-- Bidang --}}
                                    <td class="p-4 text-gray-700 dark:text-gray-300">

                                        {{ $item->bidang ?: '-' }}

                                    </td>


                                    {{-- Pangkat / Golongan --}}
                                    <td class="p-4 text-gray-700 dark:text-gray-300 whitespace-nowrap">

                                        {{ $item->pangkat_golongan ?: '-' }}

                                    </td>


                                    {{-- Tanggal Lahir --}}
                                    <td class="p-4 text-gray-700 dark:text-gray-300 whitespace-nowrap">

                                        {{ optional($item->tanggal_lahir)->format('d-m-Y') ?: '-' }}

                                    </td>


                                    {{-- Jenis Kelamin --}}
                                    <td class="p-4 text-gray-700 dark:text-gray-300">

                                        {{ $item->jenis_kelamin ? ($item->jenis_kelamin === 'Laki-Laki' ? 'L' : 'P') : '-' }}

                                    </td>


                                    {{-- Pendidikan --}}
                                    <td class="p-4 text-gray-700 dark:text-gray-300">

                                        {{ $item->pendidikan ?: '-' }}

                                    </td>


                                    {{-- Golongan Darah --}}
                                    <td class="p-4 text-gray-700 dark:text-gray-300">

                                        {{ $item->golongan_darah ?: '-' }}

                                    </td>


                                    {{-- Status --}}
                                    <td class="p-4">

                                        @if($item->status === 'aktif')

                                            <span
                                                class="
                                                    inline-flex
                                                    px-3 py-1
                                                    bg-green-100
                                                    text-green-700
                                                    font-semibold
                                                    rounded-md
                                                "
                                            >
                                                Aktif
                                            </span>

                                        @else

                                            <span
                                                class="
                                                    inline-flex
                                                    px-3 py-1
                                                    bg-red-100
                                                    text-red-700
                                                    font-semibold
                                                    rounded-md
                                                "
                                            >
                                                Nonaktif
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Aksi --}}
                                    <td class="p-4">

                                        <div class="flex gap-1.5 justify-center">

                                            {{-- EDIT --}}
                                            <a
                                                href="{{ route('admin.pegawai.edit', $item->id) }}"
                                                title="Edit Pegawai"
                                                class="
                                                    inline-flex items-center justify-center
                                                    w-9 h-9
                                                    rounded-lg
                                                    bg-indigo-50 hover:bg-indigo-100
                                                    text-indigo-600
                                                    dark:bg-indigo-900/30 dark:hover:bg-indigo-900/50
                                                    dark:text-indigo-400
                                                    transition
                                                "
                                            >
                                                <svg
                                                    class="w-4 h-4"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                                    />
                                                </svg>
                                                <span class="sr-only">Edit Pegawai</span>
                                            </a>


                                            {{-- RESET PASSWORD --}}
                                            <form
                                                action="{{ route('admin.pegawai.reset-password', $item->id) }}"
                                                method="POST"
                                                data-confirm="Reset password {{ $item->name }} menjadi password default? Pegawai wajib menggantinya saat login berikutnya."
                                                data-confirm-title="Reset Password"
                                                data-confirm-text="Ya, Reset"
                                                data-confirm-variant="warning"
                                            >

                                                @csrf
                                                @method('PUT')

                                                <button
                                                    type="submit"
                                                    title="Reset Password"
                                                    class="
                                                        inline-flex items-center justify-center
                                                        w-9 h-9
                                                        rounded-lg
                                                        bg-amber-50 hover:bg-amber-100
                                                        text-amber-600
                                                        dark:bg-amber-900/30 dark:hover:bg-amber-900/50
                                                        dark:text-amber-400
                                                        transition
                                                    "
                                                >
                                                    <svg
                                                        class="w-4 h-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"
                                                        />
                                                    </svg>
                                                    <span class="sr-only">Reset Password</span>
                                                </button>

                                            </form>


                                            {{-- HAPUS --}}
                                            <form
                                                action="{{ route('admin.pegawai.destroy', $item->id) }}"
                                                method="POST"
                                                data-confirm="Yakin ingin menghapus pegawai ini? Tindakan ini tidak bisa dibatalkan."
                                                data-confirm-title="Hapus Pegawai"
                                                data-confirm-text="Ya, Hapus"
                                                data-confirm-variant="danger"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    title="Hapus Pegawai"
                                                    class="
                                                        inline-flex items-center justify-center
                                                        w-9 h-9
                                                        rounded-lg
                                                        bg-red-50 hover:bg-red-100
                                                        text-red-600
                                                        dark:bg-red-900/30 dark:hover:bg-red-900/50
                                                        dark:text-red-400
                                                        transition
                                                    "
                                                >
                                                    <svg
                                                        class="w-4 h-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                        />
                                                    </svg>
                                                    <span class="sr-only">Hapus Pegawai</span>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="14"
                                        class="
                                            p-6
                                            text-center
                                            text-gray-500
                                            dark:text-gray-400
                                        "
                                    >
                                        Data pegawai tidak ditemukan.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- PAGINATION --}}
            @if($pegawai->hasPages())

                <div class="mt-6">
                    {{ $pegawai->links() }}
                </div>

            @endif


            {{-- INFO JUMLAH DATA --}}
            <div
                class="
                    mt-3
                    text-sm
                    text-gray-500
                    dark:text-gray-400
                "
            >

                @if($pegawai->total() > 0)

                    Menampilkan
                    {{ $pegawai->firstItem() }}
                    -
                    {{ $pegawai->lastItem() }}
                    dari
                    {{ $pegawai->total() }}
                    pegawai.

                @else

                    Tidak ada data pegawai.

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
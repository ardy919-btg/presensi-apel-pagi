<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Pengajuan Izin / Sakit
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Ajukan izin atau sakit dan pantau status pengajuan Anda.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Error validasi --}}
            @if ($errors->any())
                <div
                    class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-4 text-red-700 dark:border-red-800 dark:bg-red-900/30 dark:text-red-300"
                >
                    <div class="font-semibold mb-2">
                        Periksa kembali data pengajuan:
                    </div>

                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Form Pengajuan --}}
                <div class="lg:col-span-1">
                    <div
                        class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden"
                    >
                        <div class="p-6">

                            <div class="mb-6">
                                <h3
                                    class="text-lg font-semibold text-gray-900 dark:text-white"
                                >
                                    Buat Pengajuan
                                </h3>

                                <p
                                    class="mt-1 text-sm text-gray-500 dark:text-gray-400"
                                >
                                    Lengkapi data izin atau sakit Anda.
                                </p>
                            </div>


                            <form
                                action="{{ route('pegawai.pengajuan.store') }}"
                                method="POST"
                                enctype="multipart/form-data"
                            >
                                @csrf


                                {{-- Jenis --}}
                                <div class="mb-5">
                                    <label
                                        for="jenis"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                                    >
                                        Jenis Pengajuan
                                    </label>

                                    <select
                                        id="jenis"
                                        name="jenis"
                                        required
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                        <option value="">
                                            Pilih jenis pengajuan
                                        </option>

                                        <option
                                            value="izin"
                                            {{ old('jenis') === 'izin' ? 'selected' : '' }}
                                        >
                                            Izin
                                        </option>

                                        <option
                                            value="sakit"
                                            {{ old('jenis') === 'sakit' ? 'selected' : '' }}
                                        >
                                            Sakit
                                        </option>
                                    </select>
                                </div>


                                {{-- Tanggal Mulai --}}
                                <div class="mb-5">
                                    <label
                                        for="tanggal_mulai"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                                    >
                                        Tanggal Mulai
                                    </label>

                                    <input
                                        type="date"
                                        id="tanggal_mulai"
                                        name="tanggal_mulai"
                                        value="{{ old('tanggal_mulai') }}"
                                        required
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>


                                {{-- Tanggal Selesai --}}
                                <div class="mb-5">
                                    <label
                                        for="tanggal_selesai"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                                    >
                                        Tanggal Selesai
                                    </label>

                                    <input
                                        type="date"
                                        id="tanggal_selesai"
                                        name="tanggal_selesai"
                                        value="{{ old('tanggal_selesai') }}"
                                        required
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>


                                {{-- Keterangan --}}
                                <div class="mb-5">
                                    <label
                                        for="keterangan"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                                    >
                                        Keterangan
                                    </label>

                                    <textarea
                                        id="keterangan"
                                        name="keterangan"
                                        rows="4"
                                        required
                                        maxlength="1000"
                                        placeholder="Tuliskan alasan izin atau sakit..."
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500"
                                    >{{ old('keterangan') }}</textarea>

                                    <p
                                        class="mt-1 text-xs text-gray-500 dark:text-gray-400"
                                    >
                                        Maksimal 1000 karakter.
                                    </p>
                                </div>


                                {{-- Bukti --}}
                                <div class="mb-6">
                                    <label
                                        for="bukti"
                                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                                    >
                                        Bukti Pendukung
                                    </label>

                                    <input
                                        type="file"
                                        id="bukti"
                                        name="bukti"
                                        accept=".jpg,.jpeg,.png,.pdf"
                                        class="block w-full text-sm text-gray-700 dark:text-gray-300
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-lg file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-indigo-50 file:text-indigo-700
                                            hover:file:bg-indigo-100
                                            dark:file:bg-gray-700
                                            dark:file:text-gray-200"
                                    >

                                    <p
                                        class="mt-2 text-xs text-gray-500 dark:text-gray-400"
                                    >
                                        JPG, JPEG, PNG, atau PDF. Maksimal 5 MB.
                                    </p>
                                </div>


                                <button
                                    type="submit"
                                    class="w-full inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
                                >
                                    Kirim Pengajuan
                                </button>

                            </form>
                        </div>
                    </div>
                </div>


                {{-- Riwayat Pengajuan --}}
                <div class="lg:col-span-2">
                    <div
                        class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden"
                    >

                        <div
                            class="p-6 border-b border-gray-200 dark:border-gray-700"
                        >
                            <h3
                                class="text-lg font-semibold text-gray-900 dark:text-white"
                            >
                                Riwayat Pengajuan
                            </h3>

                            <p
                                class="mt-1 text-sm text-gray-500 dark:text-gray-400"
                            >
                                Daftar pengajuan izin dan sakit yang pernah Anda kirim.
                            </p>
                        </div>


                        @if ($pengajuans->count() > 0)

                            <div class="overflow-x-auto">
                                <table
                                    class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                                >
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"
                                            >
                                                Jenis
                                            </th>

                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"
                                            >
                                                Periode
                                            </th>

                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"
                                            >
                                                Keterangan
                                            </th>

                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"
                                            >
                                                Bukti
                                            </th>

                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"
                                            >
                                                Status
                                            </th>

                                            <th
                                                class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"
                                            >
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>


                                    <tbody
                                        class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800"
                                    >
                                        @foreach ($pengajuans as $pengajuan)

                                            <tr>
                                                {{-- Jenis --}}
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    @if ($pengajuan->jenis === 'izin')
                                                        <span
                                                            class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-900/40 dark:text-blue-300"
                                                        >
                                                            Izin
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700 dark:bg-orange-900/40 dark:text-orange-300"
                                                        >
                                                            Sakit
                                                        </span>
                                                    @endif
                                                </td>


                                                {{-- Periode --}}
                                                <td
                                                    class="whitespace-nowrap px-6 py-4 text-sm text-gray-700 dark:text-gray-300"
                                                >
                                                    <div>
                                                        {{ $pengajuan->tanggal_mulai->format('d-m-Y') }}
                                                    </div>

                                                    @if (
                                                        !$pengajuan->tanggal_mulai->isSameDay(
                                                            $pengajuan->tanggal_selesai
                                                        )
                                                    )
                                                        <div
                                                            class="text-xs text-gray-500 dark:text-gray-400"
                                                        >
                                                            s/d
                                                            {{ $pengajuan->tanggal_selesai->format('d-m-Y') }}
                                                        </div>
                                                    @endif
                                                </td>


                                                {{-- Keterangan --}}
                                                <td
                                                    class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300"
                                                >
                                                    <div class="max-w-xs">
                                                        {{ $pengajuan->keterangan }}
                                                    </div>

                                                    @if ($pengajuan->catatan_admin)
                                                        <div
                                                            class="mt-2 rounded-md bg-gray-100 p-2 text-xs text-gray-600 dark:bg-gray-700 dark:text-gray-300"
                                                        >
                                                            <strong>Catatan Admin:</strong>
                                                            {{ $pengajuan->catatan_admin }}
                                                        </div>
                                                    @endif
                                                </td>


                                                {{-- Bukti --}}
                                                <td
                                                    class="whitespace-nowrap px-6 py-4 text-sm"
                                                >
                                                    @if ($pengajuan->bukti)
                                                        <a
                                                            href="{{ asset('storage/' . $pengajuan->bukti) }}"
                                                            target="_blank"
                                                            class="font-medium text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300"
                                                        >
                                                            Lihat Bukti
                                                        </a>
                                                    @else
                                                        <span
                                                            class="text-gray-400"
                                                        >
                                                            -
                                                        </span>
                                                    @endif
                                                </td>


                                                {{-- Status --}}
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    @if ($pengajuan->status === 'menunggu')
                                                        <span
                                                            class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300"
                                                        >
                                                            Menunggu
                                                        </span>

                                                    @elseif ($pengajuan->status === 'disetujui')
                                                        <span
                                                            class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700 dark:bg-green-900/40 dark:text-green-300"
                                                        >
                                                            Disetujui
                                                        </span>

                                                    @else
                                                        <span
                                                            class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700 dark:bg-red-900/40 dark:text-red-300"
                                                        >
                                                            Ditolak
                                                        </span>
                                                    @endif
                                                </td>


                                                {{-- Aksi --}}
                                                <td
                                                    class="whitespace-nowrap px-6 py-4 text-center"
                                                >
                                                    @if ($pengajuan->status === 'menunggu')

                                                        <form
                                                            action="{{ route('pegawai.pengajuan.destroy', $pengajuan) }}"
                                                            method="POST"
                                                            data-confirm="Yakin ingin menghapus pengajuan ini?"
                                                            data-confirm-title="Hapus Pengajuan"
                                                            data-confirm-text="Ya, Hapus"
                                                            data-confirm-variant="danger"
                                                        >
                                                            @csrf
                                                            @method('DELETE')

                                                            <button
                                                                type="submit"
                                                                class="inline-flex items-center rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700 transition"
                                                            >
                                                                Hapus
                                                            </button>
                                                        </form>

                                                    @else
                                                        <span
                                                            class="text-sm text-gray-400"
                                                        >
                                                            -
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                            {{-- Pagination --}}
                            <div
                                class="border-t border-gray-200 p-4 dark:border-gray-700"
                            >
                                {{ $pengajuans->links() }}
                            </div>

                        @else

                            <div class="p-10 text-center">

                                <div
                                    class="text-lg font-semibold text-gray-700 dark:text-gray-300"
                                >
                                    Belum Ada Pengajuan
                                </div>

                                <p
                                    class="mt-2 text-sm text-gray-500 dark:text-gray-400"
                                >
                                    Pengajuan izin atau sakit yang Anda kirim akan muncul di sini.
                                </p>

                            </div>

                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
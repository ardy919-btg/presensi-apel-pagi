<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Detail Pengajuan Izin / Sakit
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Periksa detail pengajuan sebelum memberikan keputusan.
                </p>
            </div>

            <a
                href="{{ route('admin.pengajuan.index') }}"
                class="inline-flex items-center rounded-lg
                       bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700
                       hover:bg-gray-300
                       dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600
                       transition"
            >
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- Error validasi --}}
            @if ($errors->any())
                <div
                    class="mb-6 rounded-lg border border-red-200
                           bg-red-50 px-4 py-4 text-red-700
                           dark:border-red-800 dark:bg-red-900/30
                           dark:text-red-300"
                >
                    <div class="font-semibold mb-2">
                        Periksa kembali data:
                    </div>

                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Detail Pengajuan --}}
                <div class="lg:col-span-2">

                    <div
                        class="bg-white dark:bg-gray-800
                               shadow-sm sm:rounded-lg overflow-hidden"
                    >

                        <div
                            class="p-6 border-b
                                   border-gray-200 dark:border-gray-700"
                        >
                            <div class="flex items-start justify-between gap-4">

                                <div>
                                    <h3
                                        class="text-lg font-semibold
                                               text-gray-900 dark:text-white"
                                    >
                                        Informasi Pengajuan
                                    </h3>

                                    <p
                                        class="mt-1 text-sm
                                               text-gray-500 dark:text-gray-400"
                                    >
                                        Diajukan pada
                                        {{ $pengajuan->created_at->format('d-m-Y H:i') }}
                                    </p>
                                </div>


                                {{-- Status --}}
                                <div>

                                    @if ($pengajuan->status === 'menunggu')

                                        <span
                                            class="inline-flex rounded-full
                                                   bg-yellow-100 px-3 py-1
                                                   text-xs font-semibold text-yellow-700
                                                   dark:bg-yellow-900/40
                                                   dark:text-yellow-300"
                                        >
                                            Menunggu
                                        </span>

                                    @elseif ($pengajuan->status === 'disetujui')

                                        <span
                                            class="inline-flex rounded-full
                                                   bg-green-100 px-3 py-1
                                                   text-xs font-semibold text-green-700
                                                   dark:bg-green-900/40
                                                   dark:text-green-300"
                                        >
                                            Disetujui
                                        </span>

                                    @else

                                        <span
                                            class="inline-flex rounded-full
                                                   bg-red-100 px-3 py-1
                                                   text-xs font-semibold text-red-700
                                                   dark:bg-red-900/40
                                                   dark:text-red-300"
                                        >
                                            Ditolak
                                        </span>

                                    @endif

                                </div>

                            </div>
                        </div>


                        <div class="p-6 space-y-6">

                            {{-- Pegawai --}}
                            <div>
                                <div
                                    class="text-xs font-semibold uppercase
                                           tracking-wider text-gray-500
                                           dark:text-gray-400"
                                >
                                    Pegawai
                                </div>

                                <div
                                    class="mt-2 text-base font-semibold
                                           text-gray-900 dark:text-white"
                                >
                                    {{ $pengajuan->user->name ?? '-' }}
                                </div>

                                <div
                                    class="mt-1 text-sm
                                           text-gray-500 dark:text-gray-400"
                                >
                                    NIP:
                                    {{ $pengajuan->user->nip ?? '-' }}
                                </div>

                                @if ($pengajuan->user?->jabatan)
                                    <div
                                        class="mt-1 text-sm
                                               text-gray-500 dark:text-gray-400"
                                    >
                                        Jabatan:
                                        {{ $pengajuan->user->jabatan }}
                                    </div>
                                @endif

                                @if ($pengajuan->user?->bidang)
                                    <div
                                        class="mt-1 text-sm
                                               text-gray-500 dark:text-gray-400"
                                    >
                                        Bidang:
                                        {{ $pengajuan->user->bidang }}
                                    </div>
                                @endif
                            </div>


                            <hr class="border-gray-200 dark:border-gray-700">


                            {{-- Jenis --}}
                            <div>
                                <div
                                    class="text-xs font-semibold uppercase
                                           tracking-wider text-gray-500
                                           dark:text-gray-400"
                                >
                                    Jenis Pengajuan
                                </div>

                                <div class="mt-2">

                                    @if ($pengajuan->jenis === 'izin')

                                        <span
                                            class="inline-flex rounded-full
                                                   bg-blue-100 px-3 py-1
                                                   text-sm font-semibold text-blue-700
                                                   dark:bg-blue-900/40
                                                   dark:text-blue-300"
                                        >
                                            Izin
                                        </span>

                                    @else

                                        <span
                                            class="inline-flex rounded-full
                                                   bg-orange-100 px-3 py-1
                                                   text-sm font-semibold text-orange-700
                                                   dark:bg-orange-900/40
                                                   dark:text-orange-300"
                                        >
                                            Sakit
                                        </span>

                                    @endif

                                </div>
                            </div>


                            {{-- Periode --}}
                            <div>
                                <div
                                    class="text-xs font-semibold uppercase
                                           tracking-wider text-gray-500
                                           dark:text-gray-400"
                                >
                                    Periode
                                </div>

                                <div
                                    class="mt-2 text-sm
                                           text-gray-800 dark:text-gray-200"
                                >
                                    {{ $pengajuan->tanggal_mulai->format('d-m-Y') }}

                                    @if (
                                        !$pengajuan->tanggal_mulai->isSameDay(
                                            $pengajuan->tanggal_selesai
                                        )
                                    )
                                        sampai
                                        {{ $pengajuan->tanggal_selesai->format('d-m-Y') }}
                                    @endif
                                </div>
                            </div>


                            {{-- Keterangan --}}
                            <div>
                                <div
                                    class="text-xs font-semibold uppercase
                                           tracking-wider text-gray-500
                                           dark:text-gray-400"
                                >
                                    Keterangan
                                </div>

                                <div
                                    class="mt-2 rounded-lg
                                           bg-gray-50 p-4
                                           text-sm leading-relaxed
                                           text-gray-700
                                           dark:bg-gray-700/50
                                           dark:text-gray-200"
                                >
                                    {{ $pengajuan->keterangan }}
                                </div>
                            </div>


                            {{-- Bukti --}}
                            <div>
                                <div
                                    class="text-xs font-semibold uppercase
                                           tracking-wider text-gray-500
                                           dark:text-gray-400"
                                >
                                    Bukti Pendukung
                                </div>

                                <div class="mt-2">

                                    @if ($pengajuan->bukti)

                                        <a
                                            href="{{ asset('storage/' . $pengajuan->bukti) }}"
                                            target="_blank"
                                            class="inline-flex items-center
                                                   rounded-lg bg-indigo-600
                                                   px-4 py-2
                                                   text-sm font-semibold text-white
                                                   hover:bg-indigo-700 transition"
                                        >
                                            Lihat Bukti
                                        </a>

                                    @else

                                        <span
                                            class="text-sm
                                                   text-gray-500 dark:text-gray-400"
                                        >
                                            Tidak ada bukti yang dilampirkan.
                                        </span>

                                    @endif

                                </div>
                            </div>


                            {{-- Catatan Admin --}}
                            @if ($pengajuan->catatan_admin)

                                <div>
                                    <div
                                        class="text-xs font-semibold uppercase
                                               tracking-wider text-gray-500
                                               dark:text-gray-400"
                                    >
                                        Catatan Admin
                                    </div>

                                    <div
                                        class="mt-2 rounded-lg
                                               bg-gray-50 p-4
                                               text-sm leading-relaxed
                                               text-gray-700
                                               dark:bg-gray-700/50
                                               dark:text-gray-200"
                                    >
                                        {{ $pengajuan->catatan_admin }}
                                    </div>
                                </div>

                            @endif


                            {{-- Waktu Diproses --}}
                            @if ($pengajuan->diproses_pada)

                                <div>
                                    <div
                                        class="text-xs font-semibold uppercase
                                               tracking-wider text-gray-500
                                               dark:text-gray-400"
                                    >
                                        Diproses Pada
                                    </div>

                                    <div
                                        class="mt-2 text-sm
                                               text-gray-700 dark:text-gray-300"
                                    >
                                        {{ $pengajuan->diproses_pada->format('d-m-Y H:i') }}
                                    </div>
                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Panel Keputusan --}}
                <div class="lg:col-span-1">

                    <div
                        class="bg-white dark:bg-gray-800
                               shadow-sm sm:rounded-lg overflow-hidden"
                    >

                        <div
                            class="p-6 border-b
                                   border-gray-200 dark:border-gray-700"
                        >
                            <h3
                                class="text-lg font-semibold
                                       text-gray-900 dark:text-white"
                            >
                                Keputusan Admin
                            </h3>

                            <p
                                class="mt-1 text-sm
                                       text-gray-500 dark:text-gray-400"
                            >
                                Setujui atau tolak pengajuan pegawai.
                            </p>
                        </div>


                        <div class="p-6">

                            @if ($pengajuan->status === 'menunggu')

                                {{-- Form Setujui --}}
                                <form
                                    action="{{ route(
                                        'admin.pengajuan.approve',
                                        $pengajuan
                                    ) }}"
                                    method="POST"
                                    class="mb-6"
                                    data-confirm="Yakin ingin menyetujui pengajuan ini?"
                                    data-confirm-title="Setujui Pengajuan"
                                    data-confirm-text="Ya, Setujui"
                                    data-confirm-variant="default"
                                >
                                    @csrf

                                    <label
                                        for="catatan_approve"
                                        class="block mb-2 text-sm font-medium
                                               text-gray-700 dark:text-gray-300"
                                    >
                                        Catatan Persetujuan
                                        <span class="text-gray-400">
                                            (opsional)
                                        </span>
                                    </label>

                                    <textarea
                                        id="catatan_approve"
                                        name="catatan_admin"
                                        rows="3"
                                        maxlength="1000"
                                        placeholder="Contoh: Pengajuan disetujui."
                                        class="block w-full rounded-lg
                                               border-gray-300
                                               dark:border-gray-600
                                               dark:bg-gray-700
                                               dark:text-white
                                               placeholder-gray-400
                                               focus:border-green-500
                                               focus:ring-green-500"
                                    ></textarea>

                                    <button
                                        type="submit"
                                        class="mt-3 w-full inline-flex
                                               items-center justify-center
                                               rounded-lg bg-green-600
                                               px-4 py-2.5
                                               text-sm font-semibold text-white
                                               hover:bg-green-700 transition"
                                    >
                                        Setujui Pengajuan
                                    </button>

                                </form>


                                <div
                                    class="my-6 border-t
                                           border-gray-200 dark:border-gray-700"
                                ></div>


                                {{-- Form Tolak --}}
                                <form
                                    action="{{ route(
                                        'admin.pengajuan.reject',
                                        $pengajuan
                                    ) }}"
                                    method="POST"
                                    data-confirm="Yakin ingin menolak pengajuan ini?"
                                    data-confirm-title="Tolak Pengajuan"
                                    data-confirm-text="Ya, Tolak"
                                    data-confirm-variant="warning"
                                >
                                    @csrf

                                    <label
                                        for="catatan_reject"
                                        class="block mb-2 text-sm font-medium
                                               text-gray-700 dark:text-gray-300"
                                    >
                                        Alasan Penolakan
                                    </label>

                                    <textarea
                                        id="catatan_reject"
                                        name="catatan_admin"
                                        rows="4"
                                        required
                                        maxlength="1000"
                                        placeholder="Tuliskan alasan pengajuan ditolak..."
                                        class="block w-full rounded-lg
                                               border-gray-300
                                               dark:border-gray-600
                                               dark:bg-gray-700
                                               dark:text-white
                                               placeholder-gray-400
                                               focus:border-red-500
                                               focus:ring-red-500"
                                    ></textarea>

                                    <button
                                        type="submit"
                                        class="mt-3 w-full inline-flex
                                               items-center justify-center
                                               rounded-lg bg-red-600
                                               px-4 py-2.5
                                               text-sm font-semibold text-white
                                               hover:bg-red-700 transition"
                                    >
                                        Tolak Pengajuan
                                    </button>

                                </form>

                            @else

                                <div
                                    class="rounded-lg
                                           bg-gray-50 p-5 text-center
                                           dark:bg-gray-700/50"
                                >

                                    @if ($pengajuan->status === 'disetujui')

                                        <div
                                            class="text-lg font-semibold
                                                   text-green-600
                                                   dark:text-green-400"
                                        >
                                            Pengajuan Disetujui
                                        </div>

                                        <p
                                            class="mt-2 text-sm
                                                   text-gray-500
                                                   dark:text-gray-400"
                                        >
                                            Pengajuan ini sudah disetujui
                                            dan tidak dapat diproses kembali.
                                        </p>

                                    @else

                                        <div
                                            class="text-lg font-semibold
                                                   text-red-600
                                                   dark:text-red-400"
                                        >
                                            Pengajuan Ditolak
                                        </div>

                                        <p
                                            class="mt-2 text-sm
                                                   text-gray-500
                                                   dark:text-gray-400"
                                        >
                                            Pengajuan ini sudah ditolak
                                            dan tidak dapat diproses kembali.
                                        </p>

                                    @endif

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
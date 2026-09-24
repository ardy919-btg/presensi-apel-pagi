<x-app-layout>

    <x-slot name="header">

        <h2
            class="font-semibold text-xl
                   text-gray-800 dark:text-gray-200
                   leading-tight"
        >
            Dashboard Pegawai
        </h2>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <x-simulasi-banner />


            {{-- ========================= --}}
            {{-- SELAMAT DATANG --}}
            {{-- ========================= --}}

            <div class="mb-8">

                <h1
                    class="text-2xl font-bold
                           text-gray-900 dark:text-white"
                >
                    Selamat datang, {{ auth()->user()->name }}
                </h1>

                <p
                    class="mt-2
                           text-gray-600 dark:text-gray-400"
                >
                    {{
                        \Carbon\Carbon::now()
                            ->locale('id')
                            ->translatedFormat('l, d F Y')
                    }}
                </p>

            </div>



            {{-- ========================= --}}
            {{-- INFORMASI HARI APEL --}}
            {{-- ========================= --}}

            @if($isSenin)

                <div
                    class="mb-6 p-5
                           bg-green-50
                           border border-green-200
                           rounded-xl
                           dark:bg-green-900/20
                           dark:border-green-800"
                >

                    <h3
                        class="font-semibold
                               text-green-800
                               dark:text-green-300"
                    >
                        Apel Pagi Hari Ini
                    </h3>

                    <p
                        class="mt-1 text-sm
                               text-green-700
                               dark:text-green-400"
                    >
                        Hari ini merupakan jadwal Apel Pagi.
                        Buka halaman Status Apel untuk mengisi absensi.
                    </p>

                </div>

            @else

                <div
                    class="mb-6 p-5
                           bg-blue-50
                           border border-blue-200
                           rounded-xl
                           dark:bg-blue-900/20
                           dark:border-blue-800"
                >

                    <h3
                        class="font-semibold
                               text-blue-800
                               dark:text-blue-300"
                    >
                        Tidak Ada Apel Pagi Hari Ini
                    </h3>

                    <p
                        class="mt-1 text-sm
                               text-blue-700
                               dark:text-blue-400"
                    >
                        Absensi Apel Pagi dilaksanakan setiap hari Senin.
                    </p>

                </div>

            @endif



            {{-- ========================= --}}
            {{-- INFORMASI WAKTU APEL --}}
            {{-- ========================= --}}

            <div
                class="mb-8 p-5
                       bg-yellow-50
                       border border-yellow-200
                       rounded-xl
                       dark:bg-yellow-900/20
                       dark:border-yellow-800"
            >

                <h3
                    class="font-semibold
                           text-yellow-800
                           dark:text-yellow-300"
                >
                    Informasi Waktu Absensi Apel
                </h3>


                <div
                    class="mt-4 grid grid-cols-1
                           sm:grid-cols-2
                           lg:grid-cols-4
                           gap-4"
                >

                    <div
                        class="p-4 bg-white
                               rounded-lg
                               border border-yellow-100
                               dark:bg-gray-800
                               dark:border-gray-700"
                    >

                        <p
                            class="text-sm
                                   text-gray-500
                                   dark:text-gray-400"
                        >
                            Waktu Mulai
                        </p>

                        <p
                            class="mt-1 text-xl font-bold
                                   text-gray-900
                                   dark:text-white"
                        >
                            {{ \App\Helpers\AttendanceTime::jamMulaiOnline() }} WITA
                        </p>

                    </div>


                    <div
                        class="p-4 bg-white
                               rounded-lg
                               border border-yellow-100
                               dark:bg-gray-800
                               dark:border-gray-700"
                    >

                        <p
                            class="text-sm
                                   text-gray-500
                                   dark:text-gray-400"
                        >
                            Batas Absensi
                        </p>

                        <p
                            class="mt-1 text-xl font-bold
                                   text-gray-900
                                   dark:text-white"
                        >
                            {{ \App\Helpers\AttendanceTime::jamSelesai() }} WITA
                        </p>

                    </div>


                    <div
                        class="p-4 bg-white
                               rounded-lg
                               border border-yellow-100
                               dark:bg-gray-800
                               dark:border-gray-700"
                    >

                        <p
                            class="text-sm
                                   text-gray-500
                                   dark:text-gray-400"
                        >
                            Lewat {{ \App\Helpers\AttendanceTime::jamMulai() }}
                        </p>

                        <p
                            class="mt-1 text-lg font-semibold
                                   text-yellow-700
                                   dark:text-yellow-400"
                        >
                            Terlambat
                        </p>

                    </div>


                    <div
                        class="p-4 bg-white
                               rounded-lg
                               border border-yellow-100
                               dark:bg-gray-800
                               dark:border-gray-700"
                    >

                        <p
                            class="text-sm
                                   text-gray-500
                                   dark:text-gray-400"
                        >
                            Mulai 07:45
                        </p>

                        <p
                            class="mt-1 text-lg font-semibold
                                   text-red-700
                                   dark:text-red-400"
                        >
                            Absensi Ditutup
                        </p>

                    </div>

                </div>


                <p
                    class="mt-4 text-sm
                           text-yellow-700
                           dark:text-yellow-400"
                >
                    Pegawai yang belum mengirim absensi sampai batas waktu
                    akan tercatat Alpha secara otomatis.
                </p>

            </div>



            {{-- ========================= --}}
            {{-- STATUS APEL --}}
            {{-- ========================= --}}

            <div
                class="grid grid-cols-1
                       md:grid-cols-2
                       gap-6 mb-8"
            >

                {{-- STATUS --}}
                <div
                    class="bg-white dark:bg-gray-800
                           shadow-sm rounded-xl p-6"
                >

                    <p
                        class="text-sm
                               text-gray-500 dark:text-gray-400"
                    >
                        Status Apel
                    </p>


                    <div class="mt-3">

                        @if(!$isSenin)

                            <span
                                class="inline-flex
                                       px-4 py-2
                                       rounded-full
                                       bg-gray-100
                                       text-gray-700
                                       font-semibold"
                            >
                                Tidak Ada Jadwal Apel
                            </span>


                        @elseif(!$absensiHariIni)

                            <span
                                class="inline-flex
                                       px-4 py-2
                                       rounded-full
                                       bg-gray-100
                                       text-gray-700
                                       font-semibold"
                            >
                                Belum Mengisi Absensi
                            </span>


                        @elseif($absensiHariIni->status === 'hadir')

                            <span
                                class="inline-flex
                                       px-4 py-2
                                       rounded-full
                                       bg-green-100
                                       text-green-700
                                       font-semibold"
                            >
                                Hadir Apel
                            </span>


                        @elseif($absensiHariIni->status === 'terlambat')

                            <span
                                class="inline-flex
                                       px-4 py-2
                                       rounded-full
                                       bg-yellow-100
                                       text-yellow-700
                                       font-semibold"
                            >
                                Terlambat
                            </span>


                        @elseif($absensiHariIni->status === 'izin')

                            <span
                                class="inline-flex
                                       px-4 py-2
                                       rounded-full
                                       bg-blue-100
                                       text-blue-700
                                       font-semibold"
                            >
                                Izin
                            </span>


                        @elseif($absensiHariIni->status === 'sakit')

                            <span
                                class="inline-flex
                                       px-4 py-2
                                       rounded-full
                                       bg-purple-100
                                       text-purple-700
                                       font-semibold"
                            >
                                Sakit
                            </span>


                        @elseif($absensiHariIni->status === 'dinas_luar')

                            <span
                                class="inline-flex
                                       px-4 py-2
                                       rounded-full
                                       bg-indigo-100
                                       text-indigo-700
                                       font-semibold"
                            >
                                Dinas Luar
                            </span>


                        @elseif($absensiHariIni->status === 'cuti')

                            <span
                                class="inline-flex
                                       px-4 py-2
                                       rounded-full
                                       bg-teal-100
                                       text-teal-700
                                       font-semibold"
                            >
                                Cuti
                            </span>


                        @elseif($absensiHariIni->status === 'lainnya')

                            <span
                                class="inline-flex
                                       px-4 py-2
                                       rounded-full
                                       bg-orange-100
                                       text-orange-700
                                       font-semibold"
                            >
                                Lainnya
                            </span>


                        @elseif($absensiHariIni->status === 'alpha')

                            <span
                                class="inline-flex
                                       px-4 py-2
                                       rounded-full
                                       bg-red-100
                                       text-red-700
                                       font-semibold"
                            >
                                Alpha
                            </span>

                        @endif

                    </div>

                </div>



                {{-- JAM PENGIRIMAN --}}
                <div
                    class="bg-white dark:bg-gray-800
                           shadow-sm rounded-xl p-6"
                >

                    <p
                        class="text-sm
                               text-gray-500 dark:text-gray-400"
                    >
                        Jam Pengisian Absensi
                    </p>


                    <p
                        class="mt-3 text-3xl font-bold
                               text-gray-900 dark:text-white"
                    >

                        @if(
                            $isSenin &&
                            $absensiHariIni &&
                            $absensiHariIni->jam_masuk
                        )

                            {{
                                \Carbon\Carbon::parse(
                                    $absensiHariIni->jam_masuk
                                )->format('H:i')
                            }}

                        @else

                            --

                        @endif

                    </p>


                    <p
                        class="mt-2 text-sm
                               text-gray-500 dark:text-gray-400"
                    >
                        Waktu saat absensi Apel Pagi dikirim.
                    </p>

                </div>

            </div>



            {{-- ========================= --}}
            {{-- INFORMASI ABSENSI --}}
            {{-- ========================= --}}

            <div
                class="bg-white dark:bg-gray-800
                       shadow-sm rounded-xl mb-8"
            >

                <div class="p-6">

                    <h3
                        class="text-lg font-semibold
                               text-gray-900 dark:text-white"
                    >
                        Absensi Apel Pagi
                    </h3>


                    <p
                        class="mt-2
                               text-gray-600 dark:text-gray-400"
                    >
                        Login menggunakan akun Anda, lalu langsung isi
                        absensi di halaman Status Apel. Tidak perlu scan
                        QR Code lagi.
                    </p>



                    <div
                        class="grid grid-cols-1
                               sm:grid-cols-2
                               gap-4 mt-6"
                    >

                        {{-- PILIH KEHADIRAN --}}
                        <div
                            class="p-4 rounded-lg
                                   bg-blue-50
                                   dark:bg-gray-700"
                        >

                            <div
                                class="font-semibold
                                       text-blue-700
                                       dark:text-blue-400"
                            >
                                1. Pilih Kehadiran
                            </div>


                            <p
                                class="mt-1 text-sm
                                       text-gray-600
                                       dark:text-gray-300"
                            >
                                Pilih Hadir Apel atau Tidak Hadir Apel.
                            </p>

                        </div>



                        {{-- VERIFIKASI --}}
                        <div
                            class="p-4 rounded-lg
                                   bg-purple-50
                                   dark:bg-gray-700"
                        >

                            <div
                                class="font-semibold
                                       text-purple-700
                                       dark:text-purple-400"
                            >
                                2. Kirim Absensi
                            </div>


                            <p
                                class="mt-1 text-sm
                                       text-gray-600
                                       dark:text-gray-300"
                            >
                                Jika hadir, lakukan verifikasi lokasi dan selfie.
                                Jika tidak hadir, isi alasan dan keterangan.
                            </p>

                        </div>

                    </div>



                    <div
                        class="mt-6
                               flex flex-wrap
                               gap-3"
                    >

                        <a
                            href="{{ route('pegawai.absensi.index') }}"
                            class="inline-flex items-center
                                   px-5 py-3
                                   bg-green-600
                                   hover:bg-green-700
                                   text-white
                                   font-semibold
                                   rounded-lg
                                   transition"
                        >
                            Status Apel
                        </a>


                        <a
                            href="{{ route('pegawai.riwayat') }}"
                            class="inline-flex items-center
                                   px-5 py-3
                                   bg-indigo-600
                                   hover:bg-indigo-700
                                   text-white
                                   font-semibold
                                   rounded-lg
                                   transition"
                        >
                            Riwayat Apel
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>

<x-app-layout>

    <x-slot name="header">
        <div>

            <h2
                class="font-semibold text-xl
                       text-gray-800 dark:text-gray-200
                       leading-tight"
            >
                Absensi Apel Pagi
            </h2>

            <p
                class="mt-1 text-sm
                       text-gray-500 dark:text-gray-400"
            >
                Isi dan pantau status absensi Apel Pagi Anda.
            </p>

        </div>
    </x-slot>


    <div class="py-10">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">


            <x-simulasi-banner />


            @if($errors->any())

                <div
                    class="mb-4 p-4
                           bg-red-100
                           text-red-700
                           rounded-lg
                           dark:bg-red-900/30
                           dark:text-red-300"
                >

                    <ul class="list-disc list-inside space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif



            {{-- ========================= --}}
            {{-- CARD UTAMA --}}
            {{-- ========================= --}}

            <div
                class="bg-white dark:bg-gray-800
                       shadow-sm sm:rounded-xl"
            >

                <div
                    class="p-6
                           text-gray-900
                           dark:text-gray-100"
                >


                    <div
                        class="flex flex-col
                               sm:flex-row
                               sm:items-center
                               sm:justify-between
                               gap-4 mb-6"
                    >

                        <div>

                            <h3
                                class="text-xl font-semibold"
                            >
                                Status Apel Pagi
                            </h3>

                            <p
                                class="mt-1 text-sm
                                       text-gray-500
                                       dark:text-gray-400"
                            >
                                {{
                                    \App\Helpers\AttendanceTime::now()
                                        ->locale('id')
                                        ->translatedFormat(
                                            'l, d F Y'
                                        )
                                }}
                            </p>

                        </div>


                        <a
                            href="{{ route('pegawai.riwayat') }}"
                            class="inline-flex
                                   items-center
                                   justify-center
                                   px-4 py-2
                                   bg-indigo-600
                                   hover:bg-indigo-700
                                   text-white
                                   text-sm font-semibold
                                   rounded-lg
                                   transition"
                        >
                            Riwayat Apel
                        </a>

                    </div>



                    {{-- ========================= --}}
                    {{-- TIDAK ADA APEL HARI INI --}}
                    {{-- ========================= --}}

                    @if(!\App\Helpers\AttendanceTime::apelDiizinkanHariIni())

                        <div
                            class="p-6
                                   bg-blue-50
                                   border border-blue-200
                                   rounded-xl
                                   dark:bg-blue-900/20
                                   dark:border-blue-800"
                        >

                            <h4
                                class="font-semibold
                                       text-blue-800
                                       dark:text-blue-300"
                            >
                                Tidak Ada Apel Pagi Hari Ini
                            </h4>


                            <p
                                class="mt-2 text-sm
                                       text-blue-700
                                       dark:text-blue-400"
                            >
                                Absensi Apel Pagi dilaksanakan setiap hari Senin.
                            </p>


                            <p
                                class="mt-2 text-sm
                                       text-gray-600
                                       dark:text-gray-300"
                            >
                                Silakan kembali pada jadwal Apel Pagi berikutnya.
                            </p>

                        </div>



                    {{-- ========================= --}}
                    {{-- BELUM ABSEN - TAMPILKAN FORM --}}
                    {{-- ========================= --}}

                    @elseif(!$absensiHariIni)

                        <div
                            class="mb-6 p-4
                                   bg-yellow-50
                                   border border-yellow-200
                                   rounded-xl
                                   dark:bg-yellow-900/20
                                   dark:border-yellow-800"
                        >

                            <p
                                class="text-sm
                                       text-yellow-800
                                       dark:text-yellow-300"
                            >
                                Anda belum mengisi absensi Apel Pagi hari ini.
                                Silakan pilih status kehadiran di bawah.
                            </p>

                        </div>


                        <form
                            id="formAbsensi"
                            method="POST"
                            action="{{ route('pegawai.absensi.masuk') }}"
                        >

                            @csrf


                            {{-- =============================== --}}
                            {{-- PILIH KEHADIRAN --}}
                            {{-- =============================== --}}

                            <div class="mb-8">

                                <label
                                    class="block mb-3
                                           text-sm font-semibold
                                           text-gray-700 dark:text-gray-300"
                                >
                                    Status Kehadiran
                                </label>


                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">


                                    {{-- HADIR --}}
                                    <label
                                        id="cardHadir"
                                        class="group relative flex cursor-pointer
                                               rounded-xl border-2
                                               border-green-300 bg-green-50/40
                                               dark:border-green-800 dark:bg-green-900/10
                                               p-5 transition
                                               hover:border-green-400
                                               hover:bg-green-50
                                               has-[:checked]:border-green-600
                                               has-[:checked]:bg-green-50
                                               has-[:checked]:ring-2
                                               has-[:checked]:ring-green-200
                                               dark:hover:bg-green-900/20
                                               dark:has-[:checked]:bg-green-900/30
                                               dark:has-[:checked]:ring-green-900"
                                    >

                                        <input
                                            type="radio"
                                            name="kehadiran"
                                            value="hadir"
                                            class="sr-only"
                                            {{ old('kehadiran') === 'hadir' ? 'checked' : '' }}
                                        >

                                        <span
                                            class="mt-1 flex h-5 w-5 shrink-0
                                                   items-center justify-center
                                                   rounded-full border-2
                                                   border-green-400 dark:border-green-600
                                                   group-has-[:checked]:border-green-600
                                                   group-has-[:checked]:bg-green-600"
                                        >
                                            <span
                                                class="h-2 w-2 rounded-full
                                                       bg-white opacity-0
                                                       group-has-[:checked]:opacity-100"
                                            ></span>
                                        </span>

                                        <div class="ml-3">

                                            <p
                                                class="font-semibold
                                                       text-green-800 dark:text-green-300
                                                       group-has-[:checked]:text-green-700
                                                       dark:group-has-[:checked]:text-green-300"
                                            >
                                                Hadir Apel
                                            </p>

                                            <p
                                                class="mt-1 text-sm
                                                       text-gray-500 dark:text-gray-400"
                                            >
                                                Wajib melakukan selfie
                                                dan verifikasi lokasi kantor.
                                            </p>

                                        </div>

                                    </label>


                                    {{-- TIDAK HADIR --}}
                                    <label
                                        id="cardTidakHadir"
                                        class="group relative flex cursor-pointer
                                               rounded-xl border-2
                                               border-orange-300 bg-orange-50/40
                                               dark:border-orange-800 dark:bg-orange-900/10
                                               p-5 transition
                                               hover:border-orange-400
                                               hover:bg-orange-50
                                               has-[:checked]:border-orange-600
                                               has-[:checked]:bg-orange-50
                                               has-[:checked]:ring-2
                                               has-[:checked]:ring-orange-200
                                               dark:hover:bg-orange-900/20
                                               dark:has-[:checked]:bg-orange-900/30
                                               dark:has-[:checked]:ring-orange-900"
                                    >

                                        <input
                                            type="radio"
                                            name="kehadiran"
                                            value="tidak_hadir"
                                            class="sr-only"
                                            {{ old('kehadiran') === 'tidak_hadir' ? 'checked' : '' }}
                                        >

                                        <span
                                            class="mt-1 flex h-5 w-5 shrink-0
                                                   items-center justify-center
                                                   rounded-full border-2
                                                   border-orange-400 dark:border-orange-600
                                                   group-has-[:checked]:border-orange-600
                                                   group-has-[:checked]:bg-orange-600"
                                        >
                                            <span
                                                class="h-2 w-2 rounded-full
                                                       bg-white opacity-0
                                                       group-has-[:checked]:opacity-100"
                                            ></span>
                                        </span>

                                        <div class="ml-3">

                                            <p
                                                class="font-semibold
                                                       text-orange-800 dark:text-orange-300
                                                       group-has-[:checked]:text-orange-700
                                                       dark:group-has-[:checked]:text-orange-300"
                                            >
                                                Tidak Hadir Apel
                                            </p>

                                            <p
                                                class="mt-1 text-sm
                                                       text-gray-500 dark:text-gray-400"
                                            >
                                                Pilih alasan ketidakhadiran
                                                dan isi keterangan.
                                            </p>

                                        </div>

                                    </label>

                                </div>

                            </div>


                            {{-- =============================== --}}
                            {{-- BAGIAN HADIR --}}
                            {{-- =============================== --}}

                            <div
                                id="bagianHadir"
                                style="display: none;"
                            >

                                <div
                                    class="border-t border-gray-200
                                           dark:border-gray-700
                                           pt-6"
                                >

                                    <h3
                                        class="text-lg font-semibold
                                               text-gray-900 dark:text-white"
                                    >
                                        Verifikasi Kehadiran
                                    </h3>

                                    <p
                                        class="mt-1 mb-5 text-sm
                                               text-gray-500 dark:text-gray-400"
                                    >
                                        Pastikan Anda berada di area Kantor BPKAD
                                        kemudian lakukan selfie.
                                    </p>


                                    {{-- STATUS LOKASI --}}
                                    <div
                                        id="statusLokasi"
                                        class="mb-5 rounded-lg
                                               bg-gray-50
                                               border border-gray-200
                                               p-4
                                               text-sm
                                               text-gray-600
                                               dark:bg-gray-900
                                               dark:border-gray-700
                                               dark:text-gray-300"
                                    >
                                        Lokasi belum diperiksa.
                                    </div>


                                    {{-- INPUT GPS --}}
                                    <input
                                        type="hidden"
                                        name="latitude"
                                        id="latitude"
                                        value="{{ old('latitude') }}"
                                    >

                                    <input
                                        type="hidden"
                                        name="longitude"
                                        id="longitude"
                                        value="{{ old('longitude') }}"
                                    >


                                    {{-- CAMERA --}}
                                    <div
                                        id="cameraContainer"
                                        class="overflow-hidden
                                               rounded-xl
                                               bg-black"
                                    >

                                        <video
                                            id="video"
                                            autoplay
                                            playsinline
                                            class="w-full"
                                            style="max-height: 430px;"
                                        ></video>

                                    </div>


                                    {{-- PREVIEW --}}
                                    <div
                                        id="previewContainer"
                                        class="overflow-hidden
                                               rounded-xl
                                               bg-black"
                                        style="display: none;"
                                    >

                                        <img
                                            id="preview"
                                            alt="Preview Selfie"
                                            class="w-full object-cover"
                                            style="max-height: 430px;"
                                        >

                                    </div>


                                    <canvas
                                        id="canvas"
                                        style="display: none;"
                                    ></canvas>


                                    {{-- FOTO BASE64 --}}
                                    <input
                                        type="hidden"
                                        name="foto"
                                        id="foto"
                                    >


                                    {{-- TOMBOL FOTO --}}
                                    <div class="mt-5 flex flex-wrap gap-3">

                                        <button
                                            type="button"
                                            id="btnAmbilFoto"
                                            class="inline-flex items-center
                                                   px-5 py-3
                                                   rounded-lg
                                                   bg-indigo-600
                                                   hover:bg-indigo-700
                                                   text-white
                                                   text-sm font-semibold
                                                   transition"
                                        >
                                            Ambil Selfie
                                        </button>


                                        <button
                                            type="button"
                                            id="btnUlangiFoto"
                                            style="display: none;"
                                            class="inline-flex items-center
                                                   px-5 py-3
                                                   rounded-lg
                                                   bg-gray-600
                                                   hover:bg-gray-700
                                                   text-white
                                                   text-sm font-semibold
                                                   transition"
                                        >
                                            Ulangi Foto
                                        </button>

                                    </div>

                                </div>

                            </div>


                            {{-- =============================== --}}
                            {{-- BAGIAN TIDAK HADIR --}}
                            {{-- =============================== --}}

                            <div
                                id="bagianTidakHadir"
                                style="display: none;"
                            >

                                <div
                                    class="border-t border-gray-200
                                           dark:border-gray-700
                                           pt-6"
                                >

                                    <h3
                                        class="text-lg font-semibold
                                               text-gray-900 dark:text-white"
                                    >
                                        Alasan Tidak Hadir
                                    </h3>

                                    <p
                                        class="mt-1 mb-5 text-sm
                                               text-gray-500 dark:text-gray-400"
                                    >
                                        Pilih alasan dan berikan keterangan
                                        mengapa Anda tidak mengikuti Apel Pagi.
                                    </p>


                                    {{-- ALASAN --}}
                                    <div class="mb-5">

                                        <label
                                            for="alasan_tidak_hadir"
                                            class="block mb-2
                                                   text-sm font-medium
                                                   text-gray-700 dark:text-gray-300"
                                        >
                                            Alasan
                                        </label>

                                        <select
                                            name="alasan_tidak_hadir"
                                            id="alasan_tidak_hadir"
                                            class="block w-full
                                                   rounded-lg
                                                   border-gray-300
                                                   dark:border-gray-700
                                                   dark:bg-gray-900
                                                   dark:text-white
                                                   focus:border-indigo-500
                                                   focus:ring-indigo-500"
                                        >

                                            <option value="">
                                                -- Pilih Alasan --
                                            </option>

                                            <option
                                                value="izin"
                                                {{ old('alasan_tidak_hadir') === 'izin' ? 'selected' : '' }}
                                            >
                                                Izin
                                            </option>

                                            <option
                                                value="sakit"
                                                {{ old('alasan_tidak_hadir') === 'sakit' ? 'selected' : '' }}
                                            >
                                                Sakit
                                            </option>

                                            <option
                                                value="dinas_luar"
                                                {{ old('alasan_tidak_hadir') === 'dinas_luar' ? 'selected' : '' }}
                                            >
                                                Dinas Luar
                                            </option>

                                            <option
                                                value="cuti"
                                                {{ old('alasan_tidak_hadir') === 'cuti' ? 'selected' : '' }}
                                            >
                                                Cuti
                                            </option>

                                            <option
                                                value="lainnya"
                                                {{ old('alasan_tidak_hadir') === 'lainnya' ? 'selected' : '' }}
                                            >
                                                Lainnya
                                            </option>

                                        </select>

                                    </div>


                                    {{-- KETERANGAN --}}
                                    <div>

                                        <label
                                            for="keterangan"
                                            class="block mb-2
                                                   text-sm font-medium
                                                   text-gray-700 dark:text-gray-300"
                                        >
                                            Keterangan
                                        </label>

                                        <textarea
                                            name="keterangan"
                                            id="keterangan"
                                            rows="5"
                                            maxlength="1000"
                                            placeholder="Tuliskan alasan tidak mengikuti Apel Pagi..."
                                            class="block w-full
                                                   rounded-lg
                                                   border-gray-300
                                                   dark:border-gray-700
                                                   dark:bg-gray-900
                                                   dark:text-white
                                                   focus:border-indigo-500
                                                   focus:ring-indigo-500"
                                        >{{ old('keterangan') }}</textarea>

                                    </div>

                                </div>

                            </div>


                            {{-- =============================== --}}
                            {{-- SUBMIT --}}
                            {{-- =============================== --}}

                            <div
                                id="bagianSubmit"
                                class="mt-8"
                                style="display: none;"
                            >

                                <button
                                    type="submit"
                                    id="btnKirim"
                                    class="w-full inline-flex
                                           justify-center items-center
                                           px-6 py-3
                                           rounded-lg
                                           bg-green-600
                                           hover:bg-green-700
                                           text-white
                                           font-semibold
                                           transition"
                                >
                                    Kirim Absensi Apel Pagi
                                </button>

                            </div>

                        </form>



                    {{-- ========================= --}}
                    {{-- SUDAH ABSEN --}}
                    {{-- ========================= --}}

                    @else

                        <div
                            class="grid grid-cols-1
                                   md:grid-cols-2
                                   gap-5"
                        >


                            {{-- TANGGAL --}}
                            <div
                                class="p-5
                                       rounded-xl
                                       bg-gray-50
                                       dark:bg-gray-700"
                            >

                                <p
                                    class="text-sm
                                           text-gray-500
                                           dark:text-gray-400"
                                >
                                    Tanggal Apel
                                </p>

                                <p
                                    class="mt-2
                                           font-semibold
                                           text-gray-900
                                           dark:text-white"
                                >
                                    {{
                                        \Carbon\Carbon::parse(
                                            $absensiHariIni->tanggal
                                        )
                                        ->locale('id')
                                        ->translatedFormat(
                                            'l, d F Y'
                                        )
                                    }}
                                </p>

                            </div>



                            {{-- JAM --}}
                            <div
                                class="p-5
                                       rounded-xl
                                       bg-gray-50
                                       dark:bg-gray-700"
                            >

                                <p
                                    class="text-sm
                                           text-gray-500
                                           dark:text-gray-400"
                                >
                                    Jam Pengisian
                                </p>

                                <p
                                    class="mt-2
                                           font-semibold
                                           text-gray-900
                                           dark:text-white"
                                >

                                    @if($absensiHariIni->jam_masuk)

                                        {{
                                            \Carbon\Carbon::parse(
                                                $absensiHariIni->jam_masuk
                                            )->format('H:i')
                                        }}

                                    @else

                                        -

                                    @endif

                                </p>

                            </div>

                        </div>



                        {{-- ========================= --}}
                        {{-- STATUS --}}
                        {{-- ========================= --}}

                        <div class="mt-6">

                            <p
                                class="text-sm
                                       text-gray-500
                                       dark:text-gray-400"
                            >
                                Status Kehadiran
                            </p>


                            <div class="mt-3">

                                @if($absensiHariIni->status === 'hadir')

                                    <span
                                        class="inline-flex
                                               px-4 py-2
                                               rounded-full
                                               bg-green-100
                                               text-green-700
                                               font-semibold
                                               dark:bg-green-900/40
                                               dark:text-green-300"
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
                                               font-semibold
                                               dark:bg-yellow-900/40
                                               dark:text-yellow-300"
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
                                               font-semibold
                                               dark:bg-blue-900/40
                                               dark:text-blue-300"
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
                                               font-semibold
                                               dark:bg-purple-900/40
                                               dark:text-purple-300"
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
                                               font-semibold
                                               dark:bg-indigo-900/40
                                               dark:text-indigo-300"
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
                                               font-semibold
                                               dark:bg-teal-900/40
                                               dark:text-teal-300"
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
                                               font-semibold
                                               dark:bg-orange-900/40
                                               dark:text-orange-300"
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
                                               font-semibold
                                               dark:bg-red-900/40
                                               dark:text-red-300"
                                    >
                                        Alpha
                                    </span>

                                @endif

                            </div>

                        </div>



                        {{-- ========================= --}}
                        {{-- HADIR / TERLAMBAT --}}
                        {{-- ========================= --}}

                        @if(
                            in_array(
                                $absensiHariIni->status,
                                ['hadir', 'terlambat']
                            )
                        )

                            <div
                                class="mt-6 p-5
                                       rounded-xl
                                       bg-green-50
                                       border border-green-200
                                       dark:bg-green-900/20
                                       dark:border-green-800"
                            >

                                <h4
                                    class="font-semibold
                                           text-green-800
                                           dark:text-green-300"
                                >
                                    Kehadiran Apel Tercatat
                                </h4>


                                <p
                                    class="mt-2 text-sm
                                           text-green-700
                                           dark:text-green-400"
                                >
                                    Absensi Apel Pagi Anda sudah berhasil
                                    disimpan.
                                </p>


                                <div
                                    class="grid grid-cols-1
                                           sm:grid-cols-2
                                           gap-4 mt-5"
                                >


                                    {{-- GPS --}}
                                    <div>

                                        <p
                                            class="text-xs
                                                   text-gray-500
                                                   dark:text-gray-400"
                                        >
                                            Lokasi
                                        </p>


                                        @if(
                                            $absensiHariIni->latitude_masuk &&
                                            $absensiHariIni->longitude_masuk
                                        )

                                            <p
                                                class="mt-1 text-sm
                                                       font-medium
                                                       text-gray-700
                                                       dark:text-gray-200"
                                            >
                                                Lokasi berhasil direkam
                                            </p>

                                        @else

                                            <p
                                                class="mt-1 text-sm
                                                       text-gray-500"
                                            >
                                                Tidak tersedia
                                            </p>

                                        @endif

                                    </div>



                                    {{-- SELFIE --}}
                                    <div>

                                        <p
                                            class="text-xs
                                                   text-gray-500
                                                   dark:text-gray-400"
                                        >
                                            Selfie
                                        </p>


                                        @if($absensiHariIni->foto_masuk)

                                            <p
                                                class="mt-1 text-sm
                                                       font-medium
                                                       text-gray-700
                                                       dark:text-gray-200"
                                            >
                                                Selfie berhasil disimpan
                                            </p>

                                        @else

                                            <p
                                                class="mt-1 text-sm
                                                       text-gray-500"
                                            >
                                                Tidak tersedia
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </div>



                        {{-- ========================= --}}
                        {{-- TIDAK HADIR --}}
                        {{-- ========================= --}}

                        @elseif(
                            in_array(
                                $absensiHariIni->status,
                                [
                                    'izin',
                                    'sakit',
                                    'dinas_luar',
                                    'lainnya'
                                ]
                            )
                        )

                            <div
                                class="mt-6 p-5
                                       rounded-xl
                                       bg-blue-50
                                       border border-blue-200
                                       dark:bg-blue-900/20
                                       dark:border-blue-800"
                            >

                                <h4
                                    class="font-semibold
                                           text-blue-800
                                           dark:text-blue-300"
                                >
                                    Keterangan Tidak Hadir
                                </h4>


                                <div class="mt-4 space-y-4">


                                    <div>

                                        <p
                                            class="text-xs
                                                   text-gray-500
                                                   dark:text-gray-400"
                                        >
                                            Alasan
                                        </p>

                                        <p
                                            class="mt-1
                                                   font-semibold
                                                   text-gray-900
                                                   dark:text-white"
                                        >
                                            {{
                                                match(
                                                    $absensiHariIni
                                                        ->alasan_tidak_hadir
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



                                    <div>

                                        <p
                                            class="text-xs
                                                   text-gray-500
                                                   dark:text-gray-400"
                                        >
                                            Keterangan
                                        </p>

                                        <p
                                            class="mt-1
                                                   text-gray-700
                                                   dark:text-gray-200
                                                   whitespace-pre-line"
                                        >
                                            {{
                                                $absensiHariIni->keterangan
                                                ?: '-'
                                            }}
                                        </p>

                                    </div>

                                </div>

                            </div>



                        {{-- ========================= --}}
                        {{-- ALPHA --}}
                        {{-- ========================= --}}

                        @elseif($absensiHariIni->status === 'alpha')

                            <div
                                class="mt-6 p-5
                                       rounded-xl
                                       bg-red-50
                                       border border-red-200
                                       dark:bg-red-900/20
                                       dark:border-red-800"
                            >

                                <h4
                                    class="font-semibold
                                           text-red-800
                                           dark:text-red-300"
                                >
                                    Tidak Mengikuti Apel
                                </h4>


                                <p
                                    class="mt-2 text-sm
                                           text-red-700
                                           dark:text-red-400"
                                >
                                    Anda tercatat tidak mengikuti Apel Pagi
                                    tanpa keterangan.
                                </p>

                            </div>

                        @endif



                        {{-- ========================= --}}
                        {{-- ABSENSI SUDAH TERKIRIM --}}
                        {{-- ========================= --}}

                        <div
                            class="mt-6 p-4
                                   rounded-lg
                                   bg-gray-100
                                   text-gray-700
                                   dark:bg-gray-700
                                   dark:text-gray-300"
                        >
                            Absensi Apel Pagi untuk hari ini sudah tercatat.
                            Anda tidak perlu melakukan pengisian ulang.
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>


    @if(!$absensiHariIni && \App\Helpers\AttendanceTime::apelDiizinkanHariIni())

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                const form = document.getElementById('formAbsensi');

                const pilihanKehadiran =
                    document.querySelectorAll(
                        'input[name="kehadiran"]'
                    );

                const bagianHadir =
                    document.getElementById('bagianHadir');

                const bagianTidakHadir =
                    document.getElementById('bagianTidakHadir');

                const bagianSubmit =
                    document.getElementById('bagianSubmit');

                const video =
                    document.getElementById('video');

                const canvas =
                    document.getElementById('canvas');

                const preview =
                    document.getElementById('preview');

                const previewContainer =
                    document.getElementById('previewContainer');

                const cameraContainer =
                    document.getElementById('cameraContainer');

                const btnAmbilFoto =
                    document.getElementById('btnAmbilFoto');

                const btnUlangiFoto =
                    document.getElementById('btnUlangiFoto');

                const fotoInput =
                    document.getElementById('foto');

                const latitudeInput =
                    document.getElementById('latitude');

                const longitudeInput =
                    document.getElementById('longitude');

                const statusLokasi =
                    document.getElementById('statusLokasi');

                const alasanTidakHadir =
                    document.getElementById('alasan_tidak_hadir');

                const keterangan =
                    document.getElementById('keterangan');

                let stream = null;

                let lokasiSiap = false;

                let fotoSiap = false;

                let sudahMemberiTahuIzin = false;


                /*
                |--------------------------------------------------------------------------
                | Info Izin Lokasi & Kamera (hanya kalau memang belum diizinkan)
                |--------------------------------------------------------------------------
                |
                | Supaya tidak muncul bersamaan dengan pesan lain (mis. warning luar
                | radius) saat izin sebenarnya sudah pernah diberikan sebelumnya.
                |
                */

                function beriTahuIzinJikaPerlu()
                {
                    if (sudahMemberiTahuIzin) {
                        return;
                    }

                    sudahMemberiTahuIzin = true;


                    const tampilkanInfo = function () {

                        window.toast.info(
                            'Browser akan meminta izin akses Lokasi dan Kamera. ' +
                            'Silakan pilih "Izinkan/Allow" agar absensi bisa diverifikasi.',
                            6000
                        );
                    };


                    if (navigator.permissions && navigator.permissions.query) {

                        navigator.permissions
                            .query({ name: 'geolocation' })
                            .then(function (status) {

                                if (status.state !== 'granted') {
                                    tampilkanInfo();
                                }
                            })
                            .catch(tampilkanInfo);

                    } else {

                        tampilkanInfo();
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | Cek Pilihan Kehadiran
                |--------------------------------------------------------------------------
                */

                function updatePilihan()
                {
                    const pilihan =
                        document.querySelector(
                            'input[name="kehadiran"]:checked'
                        );


                    if (!pilihan) {

                        bagianHadir.style.display = 'none';

                        bagianTidakHadir.style.display = 'none';

                        bagianSubmit.style.display = 'none';

                        stopCamera();

                        return;
                    }


                    bagianSubmit.style.display = 'block';


                    if (pilihan.value === 'hadir') {

                        bagianHadir.style.display = 'block';

                        bagianTidakHadir.style.display = 'none';


                        alasanTidakHadir.value = '';

                        keterangan.value = '';


                        beriTahuIzinJikaPerlu();


                        cekLokasi();

                        bukaCamera();

                    } else {

                        bagianHadir.style.display = 'none';

                        bagianTidakHadir.style.display = 'block';


                        stopCamera();

                        resetFoto();


                        latitudeInput.value = '';

                        longitudeInput.value = '';

                        lokasiSiap = false;
                    }
                }


                pilihanKehadiran.forEach(function (radio) {

                    radio.addEventListener(
                        'change',
                        updatePilihan
                    );

                });


                /*
                |--------------------------------------------------------------------------
                | GPS
                |--------------------------------------------------------------------------
                */

                function cekLokasi()
                {
                    lokasiSiap = false;

                    statusLokasi.innerHTML =
                        'Sedang mengambil lokasi Anda...';


                    if (!navigator.geolocation) {

                        statusLokasi.innerHTML =
                            'Browser Anda tidak mendukung GPS.';

                        return;
                    }


                    navigator.geolocation.getCurrentPosition(

                        function (position) {

                            latitudeInput.value =
                                position.coords.latitude;

                            longitudeInput.value =
                                position.coords.longitude;

                            lokasiSiap = true;


                            statusLokasi.innerHTML =
                                '✓ Lokasi berhasil diperoleh. ' +
                                'Jarak dengan kantor akan diverifikasi saat absensi dikirim.';

                        },

                        function (error) {

                            lokasiSiap = false;

                            latitudeInput.value = '';

                            longitudeInput.value = '';


                            let pesan =
                                'Lokasi tidak dapat diperoleh.';


                            if (error.code === 1) {

                                pesan =
                                    'Izin lokasi ditolak. ' +
                                    'Silakan izinkan akses lokasi pada browser.';

                            } else if (error.code === 2) {

                                pesan =
                                    'Lokasi perangkat tidak tersedia.';

                            } else if (error.code === 3) {

                                pesan =
                                    'Pengambilan lokasi terlalu lama. Silakan coba kembali.';
                            }


                            statusLokasi.innerHTML =
                                pesan;

                            window.toast.warning(pesan);

                        },

                        {
                            enableHighAccuracy: true,

                            timeout: 15000,

                            maximumAge: 0
                        }

                    );
                }


                /*
                |--------------------------------------------------------------------------
                | Kamera
                |--------------------------------------------------------------------------
                */

                async function bukaCamera()
                {
                    if (stream) {
                        return;
                    }


                    try {

                        stream =
                            await navigator.mediaDevices.getUserMedia({
                                video: {
                                    facingMode: 'user'
                                },

                                audio: false
                            });


                        video.srcObject =
                            stream;


                    } catch (error) {

                        window.toast.warning(
                            'Kamera tidak dapat dibuka. ' +
                            'Pastikan izin kamera telah diberikan.'
                        );
                    }
                }


                function stopCamera()
                {
                    if (stream) {

                        stream
                            .getTracks()
                            .forEach(function (track) {
                                track.stop();
                            });


                        stream = null;

                        video.srcObject = null;
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | Ambil Selfie
                |--------------------------------------------------------------------------
                */

                btnAmbilFoto.addEventListener(
                    'click',
                    function () {

                        if (!video.videoWidth) {

                            window.toast.warning(
                                'Kamera belum siap. Tunggu beberapa saat lalu coba kembali.'
                            );

                            return;
                        }


                        canvas.width =
                            video.videoWidth;

                        canvas.height =
                            video.videoHeight;


                        const context =
                            canvas.getContext('2d');


                        context.drawImage(
                            video,
                            0,
                            0,
                            canvas.width,
                            canvas.height
                        );


                        const foto =
                            canvas.toDataURL(
                                'image/jpeg',
                                0.85
                            );


                        fotoInput.value =
                            foto;

                        preview.src =
                            foto;


                        cameraContainer.style.display =
                            'none';

                        previewContainer.style.display =
                            'block';

                        btnAmbilFoto.style.display =
                            'none';

                        btnUlangiFoto.style.display =
                            'inline-flex';


                        fotoSiap = true;


                        stopCamera();
                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Ulangi Selfie
                |--------------------------------------------------------------------------
                */

                btnUlangiFoto.addEventListener(
                    'click',
                    function () {

                        resetFoto();

                        bukaCamera();

                    }
                );


                function resetFoto()
                {
                    fotoInput.value =
                        '';

                    preview.src =
                        '';

                    fotoSiap =
                        false;


                    cameraContainer.style.display =
                        'block';

                    previewContainer.style.display =
                        'none';

                    btnAmbilFoto.style.display =
                        'inline-flex';

                    btnUlangiFoto.style.display =
                        'none';
                }


                /*
                |--------------------------------------------------------------------------
                | Validasi Sebelum Submit
                |--------------------------------------------------------------------------
                */

                form.addEventListener(
                    'submit',
                    function (event) {

                        const pilihan =
                            document.querySelector(
                                'input[name="kehadiran"]:checked'
                            );


                        if (!pilihan) {

                            event.preventDefault();

                            window.toast.warning(
                                'Silakan pilih status kehadiran terlebih dahulu.'
                            );

                            return;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Hadir
                        |--------------------------------------------------------------------------
                        */

                        if (pilihan.value === 'hadir') {

                            if (!lokasiSiap) {

                                event.preventDefault();

                                window.toast.warning(
                                    'Lokasi belum berhasil diperoleh. ' +
                                    'Pastikan GPS aktif dan izin lokasi diberikan.'
                                );

                                return;
                            }


                            if (!fotoSiap) {

                                event.preventDefault();

                                window.toast.warning(
                                    'Silakan ambil selfie terlebih dahulu.'
                                );

                                return;
                            }
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Tidak Hadir
                        |--------------------------------------------------------------------------
                        */

                        if (pilihan.value === 'tidak_hadir') {

                            if (!alasanTidakHadir.value) {

                                event.preventDefault();

                                window.toast.warning(
                                    'Silakan pilih alasan tidak hadir.'
                                );

                                return;
                            }


                            if (
                                keterangan.value
                                    .trim()
                                    .length === 0
                            ) {

                                event.preventDefault();

                                window.toast.warning(
                                    'Silakan isi keterangan tidak hadir.'
                                );

                                return;
                            }
                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Pulihkan Pilihan Setelah Validation Error
                |--------------------------------------------------------------------------
                */

                updatePilihan();


                /*
                |--------------------------------------------------------------------------
                | Stop Kamera Saat Halaman Ditutup
                |--------------------------------------------------------------------------
                */

                window.addEventListener(
                    'beforeunload',
                    stopCamera
                );

            });

        </script>

    @endif

</x-app-layout>

<nav
    x-data="{ open: false, profileOpen: false }"
    class="relative z-50"
>

    {{-- ====================================================== --}}
    {{-- HEADER UTAMA BPKAD --}}
    {{-- ====================================================== --}}

    <div class="bg-slate-900">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="h-20 flex items-center justify-between gap-4">


                {{-- ====================================================== --}}
                {{-- IDENTITAS INSTANSI --}}
                {{-- ====================================================== --}}

                <div class="flex items-center min-w-0">

                    @if(Auth::user()->role === 'admin')

                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-3 min-w-0"
                        >

                    @else

                        <a
                            href="{{ route('pegawai.dashboard') }}"
                            class="flex items-center gap-3 min-w-0"
                        >

                    @endif


                        {{-- Logo Aplikasi Absensi Apel --}}
                        <div
                            class="
                                shrink-0
                                w-10 h-10
                                sm:w-11 sm:h-11
                                flex
                                items-center
                                justify-center
                            "
                        >

                            <img
                                src="{{ asset('images/logo_absensi_apel.svg') }}"
                                alt="Logo Absensi Apel BPKAD"
                                class="
                                    w-full
                                    h-full
                                    object-contain
                                "
                            >

                        </div>


                        {{-- Nama Instansi --}}
                        <div class="min-w-0">

                            <div
                                class="
                                    text-white
                                    text-sm
                                    sm:text-base
                                    lg:text-lg
                                    font-bold
                                    tracking-wide
                                    leading-tight
                                    truncate
                                "
                            >
                                BPKAD Kota Bontang
                            </div>

                            <div
                                class="
                                    mt-1
                                    text-[10px]
                                    sm:text-[11px]
                                    lg:text-xs
                                    text-slate-300
                                    truncate
                                "
                            >
                                Sistem Absensi Apel Pagi
                            </div>

                        </div>

                    </a>

                </div>



                {{-- ====================================================== --}}
                {{-- PROFILE DESKTOP --}}
                {{-- ====================================================== --}}

                <div
                    class="hidden lg:flex items-center gap-3 relative"
                    @click.outside="profileOpen = false"
                >

                    {{-- Nama Pengguna --}}
                    <div class="text-right">

                        <p
                            class="
                                text-sm
                                font-semibold
                                text-white
                                leading-tight
                                max-w-[220px]
                                truncate
                            "
                        >
                            {{ Auth::user()->name }}
                        </p>

                        <p
                            class="
                                mt-1
                                text-xs
                                text-slate-300
                                leading-tight
                            "
                        >
                            @if(Auth::user()->role === 'admin')
                                Administrator
                            @else
                                Pegawai BPKAD
                            @endif
                        </p>

                    </div>


                    {{-- Tombol Dropdown --}}
                    <button
                        type="button"
                        @click="profileOpen = !profileOpen"
                        class="
                            w-10 h-10
                            flex
                            items-center
                            justify-center
                            rounded-lg
                            border
                            border-slate-600
                            bg-slate-800
                            text-white
                            hover:bg-slate-700
                            hover:border-slate-500
                            transition
                        "
                        aria-label="Menu pengguna"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            class="
                                w-5 h-5
                                transition-transform
                                duration-200
                            "
                            :class="{ 'rotate-180': profileOpen }"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>

                    </button>


                    {{-- Dropdown --}}
                    <div
                        x-show="profileOpen"

                        x-transition:enter="transition ease-out duration-150"

                        x-transition:enter-start="
                            opacity-0
                            translate-y-1
                            scale-95
                        "

                        x-transition:enter-end="
                            opacity-100
                            translate-y-0
                            scale-100
                        "

                        x-transition:leave="
                            transition
                            ease-in
                            duration-100
                        "

                        x-transition:leave-start="
                            opacity-100
                            translate-y-0
                            scale-100
                        "

                        x-transition:leave-end="
                            opacity-0
                            translate-y-1
                            scale-95
                        "

                        style="display: none;"

                        class="
                            absolute
                            right-0
                            top-full
                            mt-2
                            w-48
                            rounded-xl
                            bg-white
                            border
                            border-slate-200
                            shadow-xl
                            overflow-hidden
                            z-50
                        "
                    >

                        {{-- Profil --}}
                        <a
                            href="{{ route('profile.edit') }}"
                            class="
                                flex
                                items-center
                                gap-3
                                px-4
                                py-3
                                text-sm
                                font-medium
                                text-slate-700
                                hover:bg-slate-50
                                hover:text-slate-900
                                transition
                            "
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="w-5 h-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"
                                />
                            </svg>

                            Profil

                        </a>


                        {{-- Logout --}}
                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="
                                    w-full
                                    flex
                                    items-center
                                    gap-3
                                    px-4
                                    py-3
                                    text-sm
                                    font-medium
                                    text-red-600
                                    hover:bg-red-50
                                    transition
                                "
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="w-5 h-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3-6l3 3m0 0l-3 3m3-3H9"
                                    />
                                </svg>

                                Log Out

                            </button>

                        </form>

                    </div>

                </div>



                {{-- ====================================================== --}}
                {{-- HAMBURGER MOBILE --}}
                {{-- ====================================================== --}}

                <div class="lg:hidden">

                    <button
                        type="button"
                        @click="open = !open"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            w-10 h-10
                            rounded-lg
                            text-white
                            border
                            border-slate-700
                            bg-slate-800
                            hover:bg-slate-700
                            transition
                        "
                        aria-label="Buka menu navigasi"
                    >

                        <svg
                            x-show="!open"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"
                            />
                        </svg>


                        <svg
                            x-show="open"
                            style="display: none;"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>

                    </button>

                </div>

            </div>

        </div>

    </div>



    {{-- ====================================================== --}}
    {{-- NAVIGATION DESKTOP --}}
    {{-- ====================================================== --}}

    <div
        class="
            hidden
            lg:block
            bg-white
            border-b
            border-slate-200
            shadow-sm
        "
    >

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center h-14 gap-1">


                {{-- ====================================================== --}}
                {{-- ADMIN --}}
                {{-- ====================================================== --}}

                @if(Auth::user()->role === 'admin')

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="
                            flex
                            items-center
                            h-full
                            px-4
                            text-sm
                            font-medium
                            border-b-2
                            transition

                            {{
                                request()->routeIs('admin.dashboard')
                                    ? 'border-amber-500 text-slate-900'
                                    : 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-300'
                            }}
                        "
                    >
                        Dashboard
                    </a>


                    <a
                        href="{{ route('admin.pegawai.index') }}"
                        class="
                            flex
                            items-center
                            h-full
                            px-4
                            text-sm
                            font-medium
                            border-b-2
                            transition

                            {{
                                request()->routeIs('admin.pegawai.*')
                                    ? 'border-amber-500 text-slate-900'
                                    : 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-300'
                            }}
                        "
                    >
                        Data Pegawai
                    </a>


                    <a
                        href="{{ route('admin.absensi.index') }}"
                        class="
                            flex
                            items-center
                            h-full
                            px-4
                            text-sm
                            font-medium
                            border-b-2
                            transition

                            {{
                                request()->routeIs('admin.absensi.*')
                                    ? 'border-amber-500 text-slate-900'
                                    : 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-300'
                            }}
                        "
                    >
                        Riwayat Apel
                    </a>


                    <a
                        href="{{ route('admin.laporan.index') }}"
                        class="
                            flex
                            items-center
                            h-full
                            px-4
                            text-sm
                            font-medium
                            border-b-2
                            transition

                            {{
                                request()->routeIs('admin.laporan.*')
                                    ? 'border-amber-500 text-slate-900'
                                    : 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-300'
                            }}
                        "
                    >
                        Laporan
                    </a>


                    <a
                        href="{{ route('admin.qrcode.index') }}"
                        class="
                            flex
                            items-center
                            h-full
                            px-4
                            text-sm
                            font-medium
                            border-b-2
                            transition

                            {{
                                request()->routeIs('admin.qrcode.*')
                                    ? 'border-amber-500 text-slate-900'
                                    : 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-300'
                            }}
                        "
                    >
                        QR Code Apel
                    </a>


                    <a
                        href="{{ route('admin.simulasi.edit') }}"
                        class="
                            flex
                            items-center
                            h-full
                            px-4
                            text-sm
                            font-medium
                            border-b-2
                            transition

                            {{
                                request()->routeIs('admin.simulasi.*')
                                    ? 'border-amber-500 text-slate-900'
                                    : 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-300'
                            }}
                        "
                    >
                        Simulasi Apel
                    </a>



                {{-- ====================================================== --}}
                {{-- PEGAWAI --}}
                {{-- ====================================================== --}}

                @elseif(Auth::user()->role === 'pegawai')

                    <a
                        href="{{ route('pegawai.dashboard') }}"
                        class="
                            flex
                            items-center
                            h-full
                            px-4
                            text-sm
                            font-medium
                            border-b-2
                            transition

                            {{
                                request()->routeIs('pegawai.dashboard')
                                    ? 'border-amber-500 text-slate-900'
                                    : 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-300'
                            }}
                        "
                    >
                        Dashboard
                    </a>


                    <a
                        href="{{ route('pegawai.absensi.index') }}"
                        class="
                            flex
                            items-center
                            h-full
                            px-4
                            text-sm
                            font-medium
                            border-b-2
                            transition

                            {{
                                request()->routeIs('pegawai.absensi.*') ||
                                request()->routeIs('pegawai.verifikasi')
                                    ? 'border-amber-500 text-slate-900'
                                    : 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-300'
                            }}
                        "
                    >
                        Status Apel
                    </a>


                    <a
                        href="{{ route('pegawai.riwayat') }}"
                        class="
                            flex
                            items-center
                            h-full
                            px-4
                            text-sm
                            font-medium
                            border-b-2
                            transition

                            {{
                                request()->routeIs('pegawai.riwayat')
                                    ? 'border-amber-500 text-slate-900'
                                    : 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-300'
                            }}
                        "
                    >
                        Riwayat Apel
                    </a>

                @endif

            </div>

        </div>

    </div>



    {{-- ====================================================== --}}
    {{-- MOBILE MENU --}}
    {{-- ====================================================== --}}

    <div
        x-show="open"

        x-transition:enter="transition ease-out duration-200"

        x-transition:enter-start="
            opacity-0
            -translate-y-2
        "

        x-transition:enter-end="
            opacity-100
            translate-y-0
        "

        style="display: none;"

        class="
            lg:hidden
            bg-white
            border-b
            border-slate-200
            shadow-lg
        "
    >

        <div class="px-4 py-4 space-y-1">


            {{-- ====================================================== --}}
            {{-- ADMIN MOBILE --}}
            {{-- ====================================================== --}}

            @if(Auth::user()->role === 'admin')

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="
                        block
                        px-4
                        py-3
                        rounded-lg
                        text-sm
                        font-medium
                        transition

                        {{
                            request()->routeIs('admin.dashboard')
                                ? 'bg-slate-100 text-slate-900'
                                : 'text-slate-600 hover:bg-slate-50'
                        }}
                    "
                >
                    Dashboard
                </a>


                <a
                    href="{{ route('admin.pegawai.index') }}"
                    class="
                        block
                        px-4
                        py-3
                        rounded-lg
                        text-sm
                        font-medium
                        transition

                        {{
                            request()->routeIs('admin.pegawai.*')
                                ? 'bg-slate-100 text-slate-900'
                                : 'text-slate-600 hover:bg-slate-50'
                        }}
                    "
                >
                    Data Pegawai
                </a>


                <a
                    href="{{ route('admin.absensi.index') }}"
                    class="
                        block
                        px-4
                        py-3
                        rounded-lg
                        text-sm
                        font-medium
                        transition

                        {{
                            request()->routeIs('admin.absensi.*')
                                ? 'bg-slate-100 text-slate-900'
                                : 'text-slate-600 hover:bg-slate-50'
                        }}
                    "
                >
                    Riwayat Apel
                </a>


                <a
                    href="{{ route('admin.laporan.index') }}"
                    class="
                        block
                        px-4
                        py-3
                        rounded-lg
                        text-sm
                        font-medium
                        transition

                        {{
                            request()->routeIs('admin.laporan.*')
                                ? 'bg-slate-100 text-slate-900'
                                : 'text-slate-600 hover:bg-slate-50'
                        }}
                    "
                >
                    Laporan
                </a>


                <a
                    href="{{ route('admin.qrcode.index') }}"
                    class="
                        block
                        px-4
                        py-3
                        rounded-lg
                        text-sm
                        font-medium
                        transition

                        {{
                            request()->routeIs('admin.qrcode.*')
                                ? 'bg-slate-100 text-slate-900'
                                : 'text-slate-600 hover:bg-slate-50'
                        }}
                    "
                >
                    QR Code Apel
                </a>


                <a
                    href="{{ route('admin.simulasi.edit') }}"
                    class="
                        block
                        px-4
                        py-3
                        rounded-lg
                        text-sm
                        font-medium
                        transition

                        {{
                            request()->routeIs('admin.simulasi.*')
                                ? 'bg-slate-100 text-slate-900'
                                : 'text-slate-600 hover:bg-slate-50'
                        }}
                    "
                >
                    Simulasi Apel
                </a>



            {{-- ====================================================== --}}
            {{-- PEGAWAI MOBILE --}}
            {{-- ====================================================== --}}

            @else

                <a
                    href="{{ route('pegawai.dashboard') }}"
                    class="
                        block
                        px-4
                        py-3
                        rounded-lg
                        text-sm
                        font-medium
                        transition

                        {{
                            request()->routeIs('pegawai.dashboard')
                                ? 'bg-slate-100 text-slate-900'
                                : 'text-slate-600 hover:bg-slate-50'
                        }}
                    "
                >
                    Dashboard
                </a>


                <a
                    href="{{ route('pegawai.absensi.index') }}"
                    class="
                        block
                        px-4
                        py-3
                        rounded-lg
                        text-sm
                        font-medium
                        transition

                        {{
                            request()->routeIs('pegawai.absensi.*') ||
                            request()->routeIs('pegawai.verifikasi')
                                ? 'bg-slate-100 text-slate-900'
                                : 'text-slate-600 hover:bg-slate-50'
                        }}
                    "
                >
                    Status Apel
                </a>


                <a
                    href="{{ route('pegawai.riwayat') }}"
                    class="
                        block
                        px-4
                        py-3
                        rounded-lg
                        text-sm
                        font-medium
                        transition

                        {{
                            request()->routeIs('pegawai.riwayat')
                                ? 'bg-slate-100 text-slate-900'
                                : 'text-slate-600 hover:bg-slate-50'
                        }}
                    "
                >
                    Riwayat Apel
                </a>

            @endif

        </div>



        {{-- ====================================================== --}}
        {{-- USER MOBILE --}}
        {{-- ====================================================== --}}

        <div
            class="
                border-t
                border-slate-200
                bg-slate-50
                px-4
                py-4
            "
        >

            <div class="flex items-center gap-3">

                <div
                    class="
                        shrink-0
                        w-10 h-10
                        rounded-full
                        bg-slate-900
                        text-white
                        flex
                        items-center
                        justify-center
                        text-sm
                        font-bold
                    "
                >
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>


                <div class="min-w-0">

                    <p
                        class="
                            font-semibold
                            text-sm
                            text-slate-800
                            truncate
                        "
                    >
                        {{ Auth::user()->name }}
                    </p>


                    <p
                        class="
                            text-xs
                            text-slate-500
                            truncate
                        "
                    >

                        @if(Auth::user()->role === 'pegawai')

                            NIP:
                            {{ Auth::user()->nip }}

                        @else

                            {{ Auth::user()->email }}

                        @endif

                    </p>

                </div>

            </div>


            <div class="mt-4 grid grid-cols-2 gap-3">

                <a
                    href="{{ route('profile.edit') }}"
                    class="
                        text-center
                        px-4
                        py-2.5
                        rounded-lg
                        bg-white
                        border
                        border-slate-200
                        text-sm
                        font-medium
                        text-slate-700
                        hover:bg-slate-100
                        transition
                    "
                >
                    Profil
                </a>


                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="
                            w-full
                            px-4
                            py-2.5
                            rounded-lg
                            bg-red-50
                            border
                            border-red-200
                            text-sm
                            font-medium
                            text-red-600
                            hover:bg-red-100
                            transition
                        "
                    >
                        Keluar
                    </button>

                </form>

            </div>

        </div>

    </div>

</nav>
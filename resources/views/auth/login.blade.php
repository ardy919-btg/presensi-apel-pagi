<x-guest-layout>

    <div
        class="
            min-h-screen
            bg-slate-100
            flex
            items-center
            justify-center
            px-4
            sm:px-6
            py-6
            sm:py-8
        "
    >

        <div
            class="
                w-full
                max-w-5xl
                overflow-hidden
                rounded-2xl
                bg-white
                shadow-xl
                border
                border-slate-200
                grid
                grid-cols-1
                lg:grid-cols-2
            "
        >


            {{-- ====================================================== --}}
            {{-- PANEL KIRI - DESKTOP --}}
            {{-- ====================================================== --}}

            <div
                class="
                    hidden
                    lg:flex
                    flex-col
                    justify-between
                    bg-slate-900
                    px-10
                    py-10
                    text-white
                "
            >

                <div>

                    {{-- Identitas --}}
                    <div class="flex items-center gap-4">

                        <div class="shrink-0">

                            <img
                                src="{{ asset('images/logo_absensi_apel.svg') }}"
                                alt="Logo Absensi Apel BPKAD"
                                class="w-14 h-14 object-contain"
                            >

                        </div>


                        <div class="min-w-0">

                            <h1
                                class="
                                    text-xl
                                    font-bold
                                    tracking-wide
                                    leading-tight
                                "
                            >
                                BPKAD Kota Bontang
                            </h1>

                            <p
                                class="
                                    mt-1
                                    text-sm
                                    text-slate-300
                                "
                            >
                                Pemerintah Kota Bontang
                            </p>

                        </div>

                    </div>


                    {{-- Judul Sistem --}}
                    <div class="mt-10">

                        <p
                            class="
                                text-xs
                                font-bold
                                uppercase
                                tracking-[0.2em]
                                text-amber-400
                            "
                        >
                            Sistem Informasi
                        </p>


                        <h2
                            class="
                                mt-4
                                text-3xl
                                font-bold
                                leading-tight
                            "
                        >
                            Sistem Absensi
                            <br>
                            Apel Pagi Pegawai
                        </h2>


                        <p
                            class="
                                mt-5
                                max-w-md
                                text-sm
                                leading-6
                                text-slate-300
                            "
                        >
                            Sistem absensi internal BPKAD Kota Bontang
                            untuk pencatatan kehadiran Apel Pagi pegawai
                            secara terintegrasi, tertib, dan terdokumentasi.
                        </p>

                    </div>


                    {{-- Fitur --}}
                    <div class="mt-8 space-y-4">

                        {{-- Fitur 1 --}}
                        <div class="flex items-start gap-3">

                            <div
                                class="
                                    w-9
                                    h-9
                                    rounded-lg
                                    bg-slate-800
                                    border
                                    border-slate-700
                                    flex
                                    items-center
                                    justify-center
                                    shrink-0
                                "
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.7"
                                    stroke="currentColor"
                                    class="w-4 h-4 text-amber-400"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.75 4.5h16.5v15H3.75zM7.5 8.25h9m-9 3.75h9m-9 3.75h5.25"
                                    />
                                </svg>

                            </div>


                            <div>

                                <p class="text-sm font-semibold">
                                    Absensi Terintegrasi
                                </p>

                                <p
                                    class="
                                        mt-1
                                        text-xs
                                        leading-5
                                        text-slate-400
                                    "
                                >
                                    Data kehadiran tersimpan secara terpusat
                                    dan dapat dipantau melalui sistem.
                                </p>

                            </div>

                        </div>


                        {{-- Fitur 2 --}}
                        <div class="flex items-start gap-3">

                            <div
                                class="
                                    w-9
                                    h-9
                                    rounded-lg
                                    bg-slate-800
                                    border
                                    border-slate-700
                                    flex
                                    items-center
                                    justify-center
                                    shrink-0
                                "
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.7"
                                    stroke="currentColor"
                                    class="w-4 h-4 text-amber-400"
                                >
                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="8"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 7.5V12l3 2"
                                    />
                                </svg>

                            </div>


                            <div>

                                <p class="text-sm font-semibold">
                                    Apel Pagi Hari Senin
                                </p>

                                <p
                                    class="
                                        mt-1
                                        text-xs
                                        leading-5
                                        text-slate-400
                                    "
                                >
                                    Pengisian absensi mengikuti jadwal
                                    dan batas waktu yang telah ditetapkan.
                                </p>

                            </div>

                        </div>


                        {{-- Fitur 3 --}}
                        <div class="flex items-start gap-3">

                            <div
                                class="
                                    w-9
                                    h-9
                                    rounded-lg
                                    bg-slate-800
                                    border
                                    border-slate-700
                                    flex
                                    items-center
                                    justify-center
                                    shrink-0
                                "
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.7"
                                    stroke="currentColor"
                                    class="w-4 h-4 text-amber-400"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 3l7 3v5c0 4.5-2.9 8.5-7 10-4.1-1.5-7-5.5-7-10V6l7-3z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9.5 12l1.7 1.7L15 10"
                                    />
                                </svg>

                            </div>


                            <div>

                                <p class="text-sm font-semibold">
                                    Verifikasi Kehadiran
                                </p>

                                <p
                                    class="
                                        mt-1
                                        text-xs
                                        leading-5
                                        text-slate-400
                                    "
                                >
                                    Kehadiran diverifikasi melalui QR Code,
                                    selfie, dan lokasi pegawai.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Footer --}}
                <div
                    class="
                        mt-10
                        pt-5
                        border-t
                        border-slate-800
                    "
                >

                    <p
                        class="
                            text-xs
                            text-slate-500
                        "
                    >
                        © {{ date('Y') }} BPKAD Kota Bontang
                    </p>

                </div>

            </div>



            {{-- ====================================================== --}}
            {{-- PANEL KANAN --}}
            {{-- ====================================================== --}}

            <div
                class="
                    flex
                    items-center
                    bg-white
                    px-5
                    py-8
                    sm:px-8
                    sm:py-10
                    md:px-12
                    lg:px-12
                "
            >

                <div class="w-full max-w-md mx-auto">


                    {{-- ====================================================== --}}
                    {{-- HEADER MOBILE / TABLET --}}
                    {{-- ====================================================== --}}

                    <div class="lg:hidden mb-6">

                        <div
                            class="
                                flex
                                items-center
                                gap-3
                                pb-5
                                border-b
                                border-slate-200
                            "
                        >

                            <div class="shrink-0 w-10 h-10 sm:w-12 sm:h-12">

                                <img
                                    src="{{ asset('images/logo_absensi_apel.svg') }}"
                                    alt="Logo Absensi Apel BPKAD"
                                    class="w-full h-full object-contain"
                                >

                            </div>

                            <div class="min-w-0">

                                <p class="text-base sm:text-lg font-bold text-slate-900 leading-tight">
                                    BPKAD Kota Bontang
                                </p>

                                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                                    Sistem Absensi Apel Pagi
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- ====================================================== --}}
                    {{-- JUDUL --}}
                    {{-- ====================================================== --}}

                    <div>

                        <p
                            class="
                                text-xs
                                font-bold
                                uppercase
                                tracking-[0.16em]
                                text-amber-600
                            "
                        >
                            Portal Internal BPKAD
                        </p>


                        <h2
                            class="
                                mt-3
                                text-2xl
                                sm:text-3xl
                                font-bold
                                text-slate-900
                                leading-tight
                            "
                        >
                            Masuk ke Sistem
                        </h2>


                        <p
                            class="
                                mt-3
                                text-sm
                                leading-6
                                text-slate-500
                            "
                        >
                            Gunakan Nama atau NIP pegawai (atau email
                            Administrator) untuk mengakses sistem.
                        </p>

                    </div>


                    {{-- ====================================================== --}}
                    {{-- SESSION STATUS --}}
                    {{-- ====================================================== --}}

                    <x-auth-session-status
                        class="mt-6"
                        :status="session('status')"
                    />


                    {{-- ====================================================== --}}
                    {{-- FORM --}}
                    {{-- ====================================================== --}}

                    <form
                        method="POST"
                        action="{{ route('login') }}"
                        class="mt-7"
                    >

                        @csrf


                        {{-- Login --}}
                        <div
                            x-data="{
                                query: @js(old('login', '')),
                                items: [],
                                open: false,
                                loading: false,
                                timer: null,
                                onInput() {
                                    this.open = false;
                                    clearTimeout(this.timer);
                                    const term = this.query.trim();
                                    if (term.length < 2) {
                                        this.items = [];
                                        return;
                                    }
                                    this.timer = setTimeout(() => this.fetchSuggestions(term), 250);
                                },
                                async fetchSuggestions(term) {
                                    this.loading = true;
                                    try {
                                        const res = await fetch(
                                            '{{ route('login.suggestions') }}?q=' + encodeURIComponent(term),
                                            { headers: { 'Accept': 'application/json' } }
                                        );
                                        this.items = res.ok ? await res.json() : [];
                                        this.open = this.items.length > 0;
                                    } catch (e) {
                                        this.items = [];
                                    } finally {
                                        this.loading = false;
                                    }
                                },
                                select(item) {
                                    this.query = item.nip;
                                    this.items = [];
                                    this.open = false;
                                    $nextTick(() => document.getElementById('password')?.focus());
                                },
                            }"
                            @click.outside="open = false"
                        >

                            <label
                                for="login"
                                class="
                                    block
                                    text-sm
                                    font-semibold
                                    text-slate-700
                                "
                            >
                                Nama, NIP, atau Email
                            </label>


                            <div class="relative mt-2">

                                <div
                                    class="
                                        absolute
                                        inset-y-0
                                        left-0
                                        flex
                                        items-center
                                        pl-4
                                        pointer-events-none
                                        text-slate-400
                                    "
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="w-5 h-5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"
                                        />
                                    </svg>

                                </div>


                                <input
                                    id="login"
                                    type="text"
                                    name="login"
                                    x-model="query"
                                    @input="onInput"
                                    @focus="if (items.length) open = true"
                                    required
                                    autofocus
                                    autocomplete="off"
                                    placeholder="Nama atau NIP Pegawai"
                                    class="
                                        block
                                        w-full
                                        rounded-xl
                                        border-slate-300
                                        bg-white
                                        pl-12
                                        pr-4
                                        py-3
                                        text-sm
                                        text-slate-900
                                        placeholder:text-slate-400
                                        focus:border-slate-900
                                        focus:ring-slate-900
                                    "
                                >


                                {{-- Dropdown saran Nama/NIP --}}
                                <div
                                    x-show="open"
                                    x-transition
                                    style="display: none;"
                                    class="
                                        absolute
                                        z-10
                                        mt-2
                                        w-full
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-white
                                        shadow-lg
                                        overflow-hidden
                                    "
                                >

                                    <template x-for="item in items" :key="item.nip">

                                        <button
                                            type="button"
                                            @click="select(item)"
                                            class="
                                                block
                                                w-full
                                                text-left
                                                px-4
                                                py-3
                                                hover:bg-slate-50
                                                active:bg-slate-100
                                                border-b
                                                border-slate-100
                                                last:border-b-0
                                                transition
                                            "
                                        >

                                            <p
                                                class="text-sm font-semibold text-slate-900"
                                                x-text="item.name"
                                            ></p>

                                            <p
                                                class="mt-0.5 text-xs text-slate-500"
                                                x-text="'NIP ' + item.nip"
                                            ></p>

                                        </button>

                                    </template>

                                </div>

                            </div>


                            <x-input-error
                                :messages="$errors->get('login')"
                                class="mt-2"
                            />

                        </div>


                        {{-- Password --}}
                        <div
                            class="mt-5"
                            x-data="{ showPassword: false }"
                        >

                            <label
                                for="password"
                                class="
                                    block
                                    text-sm
                                    font-semibold
                                    text-slate-700
                                "
                            >
                                Password
                            </label>


                            <div class="relative mt-2">

                                <div
                                    class="
                                        absolute
                                        inset-y-0
                                        left-0
                                        flex
                                        items-center
                                        pl-4
                                        pointer-events-none
                                        text-slate-400
                                    "
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="w-5 h-5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M16.5 10.5V7.5a4.5 4.5 0 00-9 0v3M6 10.5h12v9H6v-9z"
                                        />
                                    </svg>

                                </div>


                                <input
                                    id="password"
                                    :type="showPassword ? 'text' : 'password'"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Masukkan password"
                                    class="
                                        block
                                        w-full
                                        rounded-xl
                                        border-slate-300
                                        bg-white
                                        pl-12
                                        pr-12
                                        py-3
                                        text-sm
                                        text-slate-900
                                        placeholder:text-slate-400
                                        focus:border-slate-900
                                        focus:ring-slate-900
                                    "
                                >


                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="
                                        absolute
                                        inset-y-0
                                        right-0
                                        flex
                                        items-center
                                        px-4
                                        text-slate-400
                                        hover:text-slate-700
                                        transition
                                    "
                                    aria-label="Tampilkan atau sembunyikan password"
                                >

                                    <svg
                                        x-show="!showPassword"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="w-5 h-5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.25 12s3.75-6 9.75-6 9.75 6 9.75 6-3.75 6-9.75 6S2.25 12 2.25 12z"
                                        />
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="2.5"
                                        />
                                    </svg>


                                    <svg
                                        x-show="showPassword"
                                        style="display: none;"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="w-5 h-5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 3l18 18M10.6 10.6a2 2 0 002.8 2.8M9.9 4.2A10.7 10.7 0 0112 4c6 0 9.75 8 9.75 8a17 17 0 01-2.1 3.1M6.5 6.5C3.8 8.4 2.25 12 2.25 12S6 20 12 20a9.7 9.7 0 004.1-.9"
                                        />
                                    </svg>

                                </button>

                            </div>


                            <x-input-error
                                :messages="$errors->get('password')"
                                class="mt-2"
                            />

                        </div>


                        {{-- Remember & Lupa Password --}}
                        <div
                            x-data="{ lupaPasswordOpen: false }"
                            class="mt-5 flex items-center justify-between gap-3"
                        >

                            <label
                                for="remember_me"
                                class="
                                    inline-flex
                                    items-center
                                    gap-2
                                    cursor-pointer
                                "
                            >

                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    name="remember"
                                    class="
                                        rounded
                                        border-slate-300
                                        text-slate-900
                                        focus:ring-slate-900
                                    "
                                >

                                <span
                                    class="
                                        text-sm
                                        text-slate-600
                                    "
                                >
                                    Ingat saya
                                </span>

                            </label>


                            <button
                                type="button"
                                @click="lupaPasswordOpen = true"
                                class="
                                    text-sm
                                    font-medium
                                    text-indigo-600
                                    hover:text-indigo-800
                                    transition
                                "
                            >
                                Lupa Password?
                            </button>


                            {{-- ====================================================== --}}
                            {{-- PANEL LUPA PASSWORD --}}
                            {{-- ====================================================== --}}

                            <div
                                x-show="lupaPasswordOpen"
                                x-cloak
                                class="fixed inset-0 z-[110] flex items-center justify-center p-4"
                            >

                                <div
                                    x-show="lupaPasswordOpen"
                                    x-transition:enter="transition ease-out duration-150"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="absolute inset-0 bg-slate-900/50 backdrop-blur-[2px]"
                                    @click="lupaPasswordOpen = false"
                                ></div>


                                <div
                                    x-show="lupaPasswordOpen"
                                    x-transition:enter="transition duration-160"
                                    x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-120"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    style="transition-timing-function: cubic-bezier(0.34, 1.56, 0.64, 1);"
                                    @keydown.escape.window="lupaPasswordOpen = false"
                                    class="relative w-full max-w-sm rounded-2xl bg-white shadow-2xl overflow-hidden text-left"
                                >

                                    <div
                                        class="
                                            px-5 py-4 flex items-center gap-3 text-white
                                            bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-600
                                        "
                                    >

                                        <div class="h-10 w-10 rounded-full bg-white/15 flex items-center justify-center shrink-0">

                                            <svg
                                                class="w-5 h-5"
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

                                        </div>

                                        <h3 class="text-base font-semibold">
                                            Lupa Password?
                                        </h3>

                                    </div>


                                    <div class="px-5 py-4">

                                        <p class="text-sm text-slate-600 leading-relaxed">
                                            Untuk alasan keamanan, reset password tidak bisa
                                            dilakukan sendiri lewat halaman ini. Silakan
                                            hubungi <span class="font-semibold text-slate-800">Petugas Admin Apel Pagi</span>
                                            untuk meminta password Anda direset.
                                        </p>

                                    </div>


                                    <div
                                        class="
                                            border-t border-slate-100
                                            bg-slate-50/60
                                            px-5 py-3
                                            flex items-center justify-end
                                        "
                                    >

                                        <button
                                            type="button"
                                            @click="lupaPasswordOpen = false"
                                            class="
                                                rounded-md px-3.5 py-1.5
                                                text-sm font-semibold text-white
                                                bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-600
                                                shadow-sm shadow-indigo-300/50
                                                hover:opacity-90 transition
                                            "
                                        >
                                            Mengerti
                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Submit --}}
                        <button
                            type="submit"
                            class="
                                mt-7
                                w-full
                                rounded-xl
                                bg-slate-900
                                px-4
                                py-3
                                sm:py-3.5
                                text-sm
                                font-semibold
                                text-white
                                shadow-sm
                                hover:bg-slate-800
                                focus:outline-none
                                focus:ring-2
                                focus:ring-slate-900
                                focus:ring-offset-2
                                transition
                            "
                        >
                            Masuk ke Sistem
                        </button>


                        @if(config('services.google.client_id'))

                            {{-- Divider --}}
                            <div class="mt-6 flex items-center gap-3">

                                <div class="h-px flex-1 bg-slate-200"></div>

                                <span class="text-xs text-slate-400">
                                    atau
                                </span>

                                <div class="h-px flex-1 bg-slate-200"></div>

                            </div>


                            {{-- Google Sign-In --}}
                            <div class="mt-4 flex justify-center">
                                <div id="google-signin-button"></div>
                            </div>

                            <form
                                id="google-login-form"
                                method="POST"
                                action="{{ route('login.google') }}"
                                class="hidden"
                            >
                                @csrf
                                <input type="hidden" name="credential" id="google-credential">
                            </form>

                            <script src="https://accounts.google.com/gsi/client?hl=id" async defer></script>
                            <script>
                                window.addEventListener('load', function () {
                                    if (!window.google || !google.accounts || !google.accounts.id) {
                                        return;
                                    }

                                    google.accounts.id.initialize({
                                        client_id: @js(config('services.google.client_id')),
                                        callback: function (response) {
                                            document.getElementById('google-credential').value = response.credential;
                                            document.getElementById('google-login-form').submit();
                                        },
                                    });

                                    google.accounts.id.renderButton(
                                        document.getElementById('google-signin-button'),
                                        {
                                            theme: 'outline',
                                            size: 'large',
                                            width: 320,
                                            text: 'signin_with',
                                            locale: 'id',
                                        }
                                    );
                                });
                            </script>

                        @endif


                        {{-- Notice --}}
                        <div
                            class="
                                mt-6
                                rounded-xl
                                border
                                border-amber-200
                                bg-amber-50
                                px-4
                                py-3
                            "
                        >

                            <div class="flex items-start gap-3">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="
                                        w-5
                                        h-5
                                        text-amber-600
                                        shrink-0
                                        mt-0.5
                                    "
                                >
                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 10v5m0-8h.01"
                                    />
                                </svg>


                                <p
                                    class="
                                        text-xs
                                        leading-5
                                        text-amber-800
                                    "
                                >
                                    Akses sistem hanya diperuntukkan bagi
                                    Administrator dan Pegawai BPKAD Kota Bontang.
                                </p>

                            </div>

                        </div>

                    </form>


                    {{-- ====================================================== --}}
                    {{-- FOOTER MOBILE --}}
                    {{-- ====================================================== --}}

                    <div
                        class="
                            lg:hidden
                            mt-8
                            pt-5
                            border-t
                            border-slate-200
                            text-center
                        "
                    >

                        <p class="text-xs text-slate-400">
                            © {{ date('Y') }} BPKAD Kota Bontang
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>
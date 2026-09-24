<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >


    <title>
        BPKAD Kota Bontang - Sistem Absensi Apel Pagi
    </title>


    {{-- ============================================= --}}
    {{-- ICON APLIKASI --}}
    {{-- ============================================= --}}

    <link
        rel="icon"
        type="image/svg+xml"
        href="{{ asset('images/logo_absensi_apel.svg') }}"
    >

    <link
        rel="apple-touch-icon"
        href="{{ asset('images/logo_absensi_apel.svg') }}"
    >


    {{-- ============================================= --}}
    {{-- FONT --}}
    {{-- ============================================= --}}

    <link
        rel="preconnect"
        href="https://fonts.bunny.net"
    >

    <link
        href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap"
        rel="stylesheet"
    >


    {{-- ============================================= --}}
    {{-- VITE --}}
    {{-- ============================================= --}}

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body
    class="
        font-sans
        antialiased
        bg-slate-100
        text-slate-800
    "
>

    <div
        class="
            min-h-screen
            bg-slate-100
            dark:bg-slate-950
        "
    >


        {{-- ============================================= --}}
        {{-- NAVIGATION --}}
        {{-- ============================================= --}}

        @include('layouts.navigation')



        {{-- ============================================= --}}
        {{-- PAGE HEADER --}}
        {{-- ============================================= --}}

        @isset($header)

            <header
                class="
                    bg-white
                    dark:bg-slate-900
                    border-b
                    border-slate-200
                    dark:border-slate-800
                "
            >

                <div
                    class="
                        max-w-7xl
                        mx-auto
                        py-5
                        px-4
                        sm:px-6
                        lg:px-8
                    "
                >

                    {{ $header }}

                </div>

            </header>

        @endisset



        {{-- ============================================= --}}
        {{-- PAGE CONTENT --}}
        {{-- ============================================= --}}

        <main>

            {{ $slot }}

        </main>



        {{-- ============================================= --}}
        {{-- FOOTER --}}
        {{-- ============================================= --}}

        <footer
            class="
                mt-10
                border-t
                border-slate-200
                dark:border-slate-800
                bg-white
                dark:bg-slate-900
            "
        >

            <div
                class="
                    max-w-7xl
                    mx-auto
                    px-4
                    sm:px-6
                    lg:px-8
                    py-5
                    text-center
                "
            >

                <p
                    class="
                        text-sm
                        text-slate-500
                        dark:text-slate-400
                    "
                >
                    © {{ date('Y') }}
                    BPKAD Kota Bontang
                    — Sistem Absensi Apel Pagi
                </p>

            </div>

        </footer>

    </div>


    <x-toast-container />
    <x-confirm-modal />

</body>

</html>
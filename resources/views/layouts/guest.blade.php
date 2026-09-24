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
        Login - Sistem Absensi Apel Pagi BPKAD Kota Bontang
    </title>

    <link
        rel="icon"
        type="image/svg+xml"
        href="{{ asset('images/logo_absensi_apel.svg') }}"
    >

    <link
        rel="apple-touch-icon"
        href="{{ asset('images/logo_absensi_apel.svg') }}"
    >

    <link
        rel="preconnect"
        href="https://fonts.bunny.net"
    >

    <link
        href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap"
        rel="stylesheet"
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="font-sans antialiased bg-slate-100">

    {{ $slot }}


    <x-toast-container />
    <x-confirm-modal />

</body>

</html>
<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Laporan Apel Pagi Pegawai</title>

    <style>

        @page {
            margin: 18px 24px 18px 24px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #111;
            line-height: 1.2;
        }


        /* ========================= */
        /* HEADER */
        /* ========================= */

        .header {
            text-align: center;
            margin-bottom: 7px;
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
            line-height: 1.15;
        }

        .header h3 {
            margin: 2px 0;
            font-size: 13px;
            line-height: 1.15;
        }

        .header p {
            margin: 3px 0 0;
            font-size: 10px;
            font-weight: bold;
        }

        .line {
            border-top: 2px solid #000;
            margin-top: 7px;
            margin-bottom: 9px;
        }


        /* ========================= */
        /* INFORMASI FILTER */
        /* ========================= */

        .info {
            margin-bottom: 8px;
        }

        .info table {
            border-collapse: collapse;
        }

        .info td {
            padding: 1px 5px 1px 0;
            line-height: 1.2;
        }


        /* ========================= */
        /* RINGKASAN */
        /* ========================= */

        .summary {
            margin-bottom: 9px;
        }

        .summary table {
            width: 100%;
            border-collapse: collapse;
        }

        .summary td {
            border: 1px solid #999;
            padding: 3px 3px;
            text-align: center;
            line-height: 1.15;
        }


        /* ========================= */
        /* TABEL DATA */
        /* ========================= */

        .table-data {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 8px;
        }

        .table-data thead {
            display: table-header-group;
        }

        .table-data tr {
            page-break-inside: avoid;
        }

        .table-data th {
            border: 1px solid #555;
            background-color: #e5e7eb;
            padding: 3px 3px;
            text-align: center;
            font-size: 8px;
            line-height: 1.1;
        }

        .table-data td {
            border: 1px solid #777;
            padding: 2px 3px;
            vertical-align: middle;
            line-height: 1.15;
            word-wrap: break-word;
        }

        .center {
            text-align: center;
        }


        /* ========================= */
        /* TANDA TANGAN */
        /* ========================= */

        .signature-wrapper {
            page-break-inside: avoid;
            break-inside: avoid;
            margin-top: 10px;
        }

        .signature {
            width: 100%;
            border-collapse: collapse;
        }

        .signature td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 0;
            border: none;
        }

        .signature-space {
            height: 38px;
        }

        .signature-date {
            margin-bottom: 3px;
        }

        .signature-title {
            line-height: 1.3;
        }


        /* ========================= */
        /* FOOTER */
        /* ========================= */

        .footer {
            margin-top: 7px;
            padding-top: 4px;
            font-size: 7px;
            color: #555;
            border-top: 1px solid #ddd;
        }

    </style>

</head>

<body>


    {{-- ========================= --}}
    {{-- HEADER --}}
    {{-- ========================= --}}

    <div class="header">

        <h2>
            PEMERINTAH KOTA BONTANG
        </h2>

        <h3>
            BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH
        </h3>

        <p>
            LAPORAN ABSENSI APEL PAGI PEGAWAI
        </p>

    </div>


    <div class="line"></div>


    {{-- ========================= --}}
    {{-- INFORMASI FILTER --}}
    {{-- ========================= --}}

    <div class="info">

        <table>

            <tr>

                <td>
                    Periode
                </td>

                <td>
                    :
                </td>

                <td>

                    @if(
                        request('tanggal_awal') &&
                        request('tanggal_akhir')
                    )

                        {{
                            \Carbon\Carbon::parse(
                                request('tanggal_awal')
                            )->format('d-m-Y')
                        }}

                        s/d

                        {{
                            \Carbon\Carbon::parse(
                                request('tanggal_akhir')
                            )->format('d-m-Y')
                        }}

                    @elseif(request('tanggal_awal'))

                        Mulai

                        {{
                            \Carbon\Carbon::parse(
                                request('tanggal_awal')
                            )->format('d-m-Y')
                        }}

                    @elseif(request('tanggal_akhir'))

                        Sampai

                        {{
                            \Carbon\Carbon::parse(
                                request('tanggal_akhir')
                            )->format('d-m-Y')
                        }}

                    @else

                        Semua Periode

                    @endif

                </td>

            </tr>


            <tr>

                <td>
                    Pegawai
                </td>

                <td>
                    :
                </td>

                <td>
                    {{ request('pegawai') ?: 'Semua Pegawai' }}
                </td>

            </tr>


            <tr>

                <td>
                    Status
                </td>

                <td>
                    :
                </td>

                <td>

                    @if(request('status'))

                        {{
                            match(request('status')) {
                                'hadir' => 'Hadir',
                                'terlambat' => 'Terlambat',
                                'izin' => 'Izin',
                                'sakit' => 'Sakit',
                                'dinas_luar' => 'Dinas Luar',
                                'cuti' => 'Cuti',
                                'lainnya' => 'Lainnya',
                                'alpha' => 'Alpha',
                                default => ucfirst(
                                    str_replace(
                                        '_',
                                        ' ',
                                        request('status')
                                    )
                                ),
                            }
                        }}

                    @else

                        Semua Status

                    @endif

                </td>

            </tr>


            <tr>

                <td>
                    Jenis Absensi
                </td>

                <td>
                    :
                </td>

                <td>
                    Apel Pagi Hari Senin
                </td>

            </tr>

        </table>

    </div>


    {{-- ========================= --}}
    {{-- RINGKASAN --}}
    {{-- ========================= --}}

    <div class="summary">

        <table>

            <tr>

                <td>
                    <strong>
                        Total
                    </strong>

                    <br>

                    {{ $totalData }}
                </td>


                <td>
                    <strong>
                        Hadir
                    </strong>

                    <br>

                    {{ $totalHadir }}
                </td>


                <td>
                    <strong>
                        Terlambat
                    </strong>

                    <br>

                    {{ $totalTerlambat }}
                </td>


                <td>
                    <strong>
                        Izin
                    </strong>

                    <br>

                    {{ $totalIzin }}
                </td>


                <td>
                    <strong>
                        Sakit
                    </strong>

                    <br>

                    {{ $totalSakit }}
                </td>


                <td>
                    <strong>
                        Dinas Luar
                    </strong>

                    <br>

                    {{ $totalDinasLuar }}
                </td>


                <td>
                    <strong>
                        Cuti
                    </strong>

                    <br>

                    {{ $totalCuti }}
                </td>


                <td>
                    <strong>
                        Lainnya
                    </strong>

                    <br>

                    {{ $totalLainnya }}
                </td>


                <td>
                    <strong>
                        Alpha
                    </strong>

                    <br>

                    {{ $totalAlpha }}
                </td>

            </tr>

        </table>

    </div>


    {{-- ========================= --}}
    {{-- TABEL LAPORAN --}}
    {{-- ========================= --}}

    <table class="table-data">

        <thead>

            <tr>

                <th width="4%">
                    No
                </th>

                <th width="14%">
                    NIP
                </th>

                <th width="20%">
                    Nama Pegawai
                </th>

                <th width="12%">
                    Tanggal Apel
                </th>

                <th width="10%">
                    Jam Pengisian
                </th>

                <th width="12%">
                    Status
                </th>

                <th width="28%">
                    Keterangan
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse($laporan as $absensi)

                <tr>


                    {{-- No --}}
                    <td class="center">

                        {{ $loop->iteration }}

                    </td>


                    {{-- NIP --}}
                    <td>

                        {{ $absensi->user->nip ?? '-' }}

                    </td>


                    {{-- Nama --}}
                    <td>

                        {{ $absensi->user->name ?? '-' }}

                    </td>


                    {{-- Tanggal --}}
                    <td class="center">

                        {{
                            \Carbon\Carbon::parse(
                                $absensi->tanggal
                            )->format('d-m-Y')
                        }}

                    </td>


                    {{-- Jam Pengisian --}}
                    <td class="center">

                        @if($absensi->jam_masuk)

                            {{
                                \Carbon\Carbon::parse(
                                    $absensi->jam_masuk
                                )->format('H:i')
                            }}

                        @else

                            -

                        @endif

                    </td>


                    {{-- Status --}}
                    <td class="center">

                        @switch($absensi->status)

                            @case('hadir')
                                Hadir
                                @break

                            @case('terlambat')
                                Terlambat
                                @break

                            @case('izin')
                                Izin
                                @break

                            @case('sakit')
                                Sakit
                                @break

                            @case('dinas_luar')
                                Dinas Luar
                                @break

                            @case('cuti')
                                Cuti
                                @break

                            @case('lainnya')
                                Lainnya
                                @break

                            @case('alpha')
                                Alpha
                                @break

                            @default

                                {{
                                    ucfirst(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $absensi->status
                                        )
                                    )
                                }}

                        @endswitch

                    </td>


                    {{-- Keterangan --}}
                    <td>

                        @if(
                            in_array(
                                $absensi->status,
                                [
                                    'izin',
                                    'sakit',
                                    'dinas_luar',
                                    'cuti',
                                    'lainnya'
                                ]
                            )
                        )

                            @if($absensi->alasan_tidak_hadir)

                                <strong>

                                    {{
                                        match(
                                            $absensi->alasan_tidak_hadir
                                        ) {
                                            'izin' => 'Izin',
                                            'sakit' => 'Sakit',
                                            'dinas_luar' => 'Dinas Luar',
                                            'cuti' => 'Cuti',
                                            'lainnya' => 'Lainnya',
                                            default => '-',
                                        }
                                    }}

                                </strong>

                                @if($absensi->keterangan)
                                    -
                                @endif

                            @endif


                            {{ $absensi->keterangan ?: '-' }}


                        @elseif($absensi->status === 'alpha')

                            Tanpa keterangan


                        @elseif(
                            in_array(
                                $absensi->status,
                                [
                                    'hadir',
                                    'terlambat'
                                ]
                            )
                        )

                            Selfie dan lokasi tercatat


                        @else

                            -

                        @endif

                    </td>

                </tr>


            @empty

                <tr>

                    <td
                        colspan="7"
                        class="center"
                    >
                        Tidak ada data Apel Pagi sesuai filter.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    {{-- ========================= --}}
    {{-- TANDA TANGAN + FOOTER --}}
    {{-- ========================= --}}

    <div class="signature-wrapper">

        <table class="signature">

            <tr>

                <td>
                    {{-- Bagian kiri sengaja dikosongkan --}}
                </td>


                <td>

                    <div class="signature-date">

                        Bontang,
                        {{ now()->locale('id')->translatedFormat('d F Y') }}

                    </div>


                    <div class="signature-title">

                        Mengetahui,

                        <br>

                        Pejabat Berwenang

                    </div>


                    <div class="signature-space"></div>


                    <strong>
                        ______________________________
                    </strong>

                    <br>

                    NIP. _____________________________

                </td>

            </tr>

        </table>


        <div class="footer">

            Dicetak pada:

            {{ now()->format('d-m-Y H:i') }}

            WITA

            &nbsp; | &nbsp;

            Sistem Absensi Apel Pagi BPKAD Kota Bontang

        </div>

    </div>


</body>

</html>
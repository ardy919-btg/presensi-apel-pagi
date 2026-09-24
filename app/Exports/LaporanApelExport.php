<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanApelExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithColumnWidths,
    WithColumnFormatting,
    WithEvents
{
    public function __construct(
        private Collection $laporan
    ) {
    }


    public function collection()
    {
        return $this->laporan;
    }


    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Nama Pegawai',
            'NIP',
            'Jabatan',
            'Bidang',
            'Jam Masuk',
            'Status',
            'Keterangan',
        ];
    }


    public function map($absensi): array
    {
        static $nomor = 0;
        $nomor++;

        return [
            $nomor,

            \Carbon\Carbon::parse($absensi->tanggal)
                ->locale('id')
                ->translatedFormat('d F Y'),

            $absensi->user->name ?? '-',

            $absensi->user->nip ?? '-',

            $absensi->user->jabatan ?? '-',

            $absensi->user->bidang ?? '-',

            $absensi->jam_masuk
                ? \Carbon\Carbon::parse($absensi->jam_masuk)->format('H:i')
                : '-',

            ucfirst(str_replace('_', ' ', $absensi->status)),

            $absensi->keterangan ?: '-',
        ];
    }


    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
            ],
        ];
    }


    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 18,
            'C' => 28,
            'D' => 18,
            'E' => 22,
            'F' => 22,
            'G' => 12,
            'H' => 16,
            'I' => 35,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Format Kolom NIP sebagai Teks
    |--------------------------------------------------------------------------
    |
    | Supaya NIP yang berupa angka panjang tidak diubah Excel menjadi
    | notasi ilmiah / kehilangan angka nol di depan.
    |
    */

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_TEXT,
        ];
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                $barisTerakhirData = $this->laporan->count() + 1;

                /*
                |--------------------------------------------------------------------------
                | Pastikan NIP Tersimpan sebagai Teks
                |--------------------------------------------------------------------------
                */

                foreach ($this->laporan as $index => $absensi) {

                    $baris = $index + 2;

                    $sheet
                        ->getCell('D' . $baris)
                        ->setValueExplicit(
                            $absensi->user->nip ?? '-',
                            DataType::TYPE_STRING
                        );
                }


                /*
                |--------------------------------------------------------------------------
                | Blok Tanda Tangan
                |--------------------------------------------------------------------------
                */

                $kolomKanan = 'F';
                $baris = $barisTerakhirData + 3;

                $sheet->setCellValue(
                    $kolomKanan . $baris,
                    'Bontang, ' . now()->locale('id')->translatedFormat('d F Y')
                );

                $sheet->setCellValue(
                    $kolomKanan . ($baris + 1),
                    'Mengetahui,'
                );

                $sheet->setCellValue(
                    $kolomKanan . ($baris + 2),
                    'Pejabat Berwenang'
                );

                $sheet->setCellValue(
                    $kolomKanan . ($baris + 6),
                    '______________________________'
                );

                $sheet->setCellValue(
                    $kolomKanan . ($baris + 7),
                    'NIP.'
                );

                foreach (range($baris, $baris + 7) as $barisTtd) {

                    $sheet
                        ->getStyle($kolomKanan . $barisTtd . ':' . 'I' . $barisTtd)
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                    $sheet->mergeCells(
                        $kolomKanan . $barisTtd . ':' . 'I' . $barisTtd
                    );
                }
            },
        ];
    }
}

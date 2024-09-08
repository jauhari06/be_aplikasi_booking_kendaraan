<?php

namespace App\Controllers;

use App\Models\PemesananModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends BaseController
{
    protected $pemesananModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
    }

    public function generate()
    {
        $bookings = $this->pemesananModel->getBookingsWithApprover();
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'ID Pemesanan');
    $sheet->setCellValue('B1', 'ID Kendaraan');
    $sheet->setCellValue('C1', 'Pengemudi');
    $sheet->setCellValue('D1', 'ID Persetujuan');
    $sheet->setCellValue('E1', 'Status');
    $sheet->setCellValue('F1', 'Approver'); 

    $row = 2;
    foreach ($bookings as $booking) {
        $sheet->setCellValue('A'.$row, $booking['id']);
        $sheet->setCellValue('B'.$row, $booking['id_kendaraan']);
        $sheet->setCellValue('C'.$row, $booking['pengemudi']);
        $sheet->setCellValue('D'.$row, $booking['id_persetujuan']);
        $sheet->setCellValue('E'.$row, ucfirst($booking['status']));
        $sheet->setCellValue('F'.$row, $booking['approver']); 
        $row++;
        }

        $writer = new Xlsx($spreadsheet);
    $filename = 'laporan_pemesanan_kendaraan.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    $writer->save('php://output');
    exit;
    }
}

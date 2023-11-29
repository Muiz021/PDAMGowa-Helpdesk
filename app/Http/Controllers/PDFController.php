<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function exportPDF(Request $request)
    {
        // Validasi rentang waktu
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Dapatkan data berdasarkan rentang waktu
        $data = Pengaduan::whereBetween('tanggal', [$request->start_date, $request->end_date])->get();
        $start = $request->start_date;
        $end = $request->end_date;

        // Tampilkan data dalam PDF
        $pdf = PDF::loadView('backend.pages.pengaduan.pdf',compact('data','start','end'));

        return $pdf->download("pengaduan_periode_" . Carbon::parse($request->start_date)->isoFormat('DD_MMMM_YYYY') . "/" . Carbon::parse($request->end_date)->isoFormat('DD_MMMM_YYYY') . ".pdf");
    }
}

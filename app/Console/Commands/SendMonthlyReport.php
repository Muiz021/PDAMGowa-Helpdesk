<?php

namespace App\Console\Commands;

use PDF;
use Carbon\Carbon;
use App\Models\Pengaduan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMonthlyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:monthly-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Laporan Perbulanan Pengaduan';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // tanggal hari ini
        $today = Carbon::today();

        if ($today->day == 1) {
            $email = 'muis.mm021@gmail.com';
            $subject = 'Laporan Bulanan Pengaduan';

            // Mengambil tanggal awal dan akhir bulan pada bulan sebelumnya
            $start = $today->subMonth()->startOfMonth();
            $end = $today->endOfMonth();


            // Dapatkan data berdasarkan rentang waktu
            $data = Pengaduan::whereBetween('tanggal', [$start, $end])->get();

            // Tampilkan data dalam PDF
            $pdf = PDF::loadView('backend.pages.pengaduan.pdf', compact('data', 'start', 'end'));

            Mail::send('email.pemberitahuan', [], function ($message) use ($email, $subject,$pdf) {
                $message->to($email)
                    ->subject($subject)
                    ->attachData($pdf->output(), 'Laporan_Bulanan_Pengaduan.pdf');
            });
            }





        return Command::SUCCESS;
    }
}

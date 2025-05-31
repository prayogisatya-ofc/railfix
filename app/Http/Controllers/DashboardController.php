<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total barang masuk
        $totalBarangMasuk = Inventory::whereNotNull('date_in')->count();

        // Hitung total barang keluar
        $totalBarangKeluar = Inventory::whereNotNull('date_out')->count();

        // Hitung barang masuk hari ini
        $barangMasukHariIni = Inventory::whereDate('date_in', Carbon::today())->count();

        // Hitung barang keluar hari ini
        $barangKeluarHariIni = Inventory::whereDate('date_out', Carbon::today())->count();

          // Data per tanggal untuk bulan ini
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $dataPerTanggal = [];

        // Loop dari awal sampai akhir bulan ini
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $tanggal = $date->format('Y-m-d');

            // Hitung jumlah barang masuk pada tanggal ini
            $masuk = Inventory::whereDate('date_in', $tanggal)->count();

            // Hitung jumlah barang keluar pada tanggal ini
            $keluar = Inventory::whereDate('date_out', $tanggal)->count();

            // Simpan ke array
            $dataPerTanggal[$tanggal] = [
                'masuk' => $masuk,
                'keluar' => $keluar,
            ];
        }

        // dump($dataPerTanggal);

        // Ambil data detail barang masuk hari ini untuk tabel
        $detailBarangMasukHariIni = Inventory::whereDate('date_in', Carbon::today())->paginate(10);
        


        // Kirim data ke view
        return view('dashboard', [
            'totalBarangMasuk' => $totalBarangMasuk,
            'totalBarangKeluar' => $totalBarangKeluar,
            'barangMasukHariIni' => $barangMasukHariIni,
            'barangKeluarHariIni' => $barangKeluarHariIni,
            'dataPerTanggal' => $dataPerTanggal,
            'detailBarangMasukHariIni' => $detailBarangMasukHariIni,
        ]);
    }
}

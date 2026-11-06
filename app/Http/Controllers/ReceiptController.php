<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ReceiptController extends Controller
{
    public function print()
    {
        try {
            // PENTING: Ganti 'POS-58' sesuai nama printer thermal kamu di Control Panel Windows
            $connector = new WindowsPrintConnector("POS-58");
            $printer = new Printer($connector);
            
            // Pengaturan rata tengah & teks tebal untuk nama toko
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setEmphasis(true);
            $printer->text("IKVIMART27 KASIR\n");
            $printer->setEmphasis(false);
            $printer->text("Jl. Mawar No. 123\n");
            $printer->text("==============================\n");
            
            // Pengaturan rata kiri untuk daftar belanjaan
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Barang A         2 x 5.000\n");
            $printer->text("Barang B         1 x 10.000\n");
            $printer->text("------------------------------\n");
            
            // Baris Total Belanjaan
            $printer->setEmphasis(true);
            $printer->text("Total:             Rp20.000\n");
            $printer->setEmphasis(false);
            $printer->text("==============================\n");
            
            // Penutup struk
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Terima kasih!\n");
            $printer->text("Selamat berbelanja kembali\n");
            
            // Perintah memotong kertas otomatis dan menutup koneksi printer
            $printer->cut();
            $printer->close();
            
            return response()->json(['message' => 'Struk berhasil dicetak']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mencetak: ' . $e->getMessage()], 500);
        }
    }
}

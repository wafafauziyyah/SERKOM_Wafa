<?php
class HitungTagihan {
    
    public function hitung(int $meterAwal, int $meterAkhir, float $tarifPerKwh) {
        if ($meterAkhir < $meterAwal) {
            throw new Exception(message: "Meter akhir harus lebih besar");
        }

        $jumlahMeter = $meterAkhir - $meterAwal;
        $totalBayar = $jumlahMeter * $tarifPerKwh;

        return [
            'jumlah_meter' => $jumlahMeter,
            'total_bayar' => $totalBayar
        ];
    }

    public function cekStatus($pembayaran) {
        return ($pembayaran > 0) ? 'Lunas' : 'Belum Bayar';
    }
}
?>
<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '\hitung_tagihan.php';

class TagihanTest extends TestCase {
    
    public function testHitungTagihanNormal() {
        $calculator = new HitungTagihan();
        
        $awal = 1000;
        $akhir = 1150;
        $tarif = 1500;

        $hasil = $calculator->hitung($awal, $akhir, $tarif);

        $this->assertEquals(150, $hasil['jumlah_meter']);
        $this->assertEquals(225000, $hasil['total_bayar']); 
    }

    public function testMeterAkhirLebihKecil() {
        $this->expectException(Exception::class);
        
        $calculator = new HitungTagihan();
        $calculator->hitung(2000, 1000, 1500); 
    }
}
?>
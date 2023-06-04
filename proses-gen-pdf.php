<?php
// memanggil library FPDF
require('fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(280,7,'SEKOLAH MENENGAH KEJURUAN CODING',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(280,7,'DAFTAR SISWA SEKOLAH MENENGAH KEJURUAN CODING',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);

$th_dimensions = array(
	array(50, 6),
	array(25, 6),
	array(40, 6),
	array(20, 6),
	array(20, 6),
	array(40, 6)
);

$tr_dimensions = array(
	array(50, 50),
	array(25, 50),
	array(40, 50),
	array(20, 50),
	array(20, 50),
	array(40, 50)
);

$pdf->Cell(50,6,'FOTO',1,0);
$pdf->Cell(25,6,'NIS',1,0);
$pdf->Cell(40,6,'NAMA',1,0);
$pdf->Cell(40,6,'JENIS KELAMIN',1,0);
$pdf->Cell(40,6,'NOMOR TELEPON',1,0);
$pdf->Cell(40,6,'ALAMAT',1,1);

$pdf->SetFont('Arial','',10);

include 'config.php';
$query = $pdo->query("SELECT * FROM siswa");
while ($row = $query->fetch()){
    $imgpath = "images/" . $row['foto'];
    if (file_exists($imgpath)) {
        $pdf->Cell(50,50,"",1,0); 
        $pdf->Image($imgpath, $pdf->GetX() - 45, $pdf->GetY() + 5, 40, 40);
    } else {
        $pdf->Cell(50,50,"IMAGE N/A.",1,0); 
    }
    $pdf->Cell(25,50,$row['nis'],1,0);
    $pdf->Cell(40,50,$row['nama'],1,0);
    $pdf->Cell(40,50,$row['jenis_kelamin'],1,0);
    $pdf->Cell(40,50,$row['telp'],1,0); 
    $pdf->Cell(40,50,$row['alamat'],1,1); 
}

$pdf->Output();
?>

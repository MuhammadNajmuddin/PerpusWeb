<?php
include "../conn.php";
require('../fpdf16/fpdf.php');
//Menampilkan data dari tabel di database

$result=mysql_query("SELECT * FROM trans_pinjam") or die(mysql_error());

//Inisiasi untuk membuat header kolom
$column_id = "";
$column_judulbuku = "";

$column_namapeminjam = "";
$column_tglpinjam = "";
$column_tglkembali = "";
$column_status = "";
$column_ket ="";


//For each row, add the field to the corresponding column
while($row = mysql_fetch_array($result))
{
    $id = $row["id"];
    $judulbuku = $row["judul_buku"];
    
    $namapeminjam = $row["nama_peminjam"];
    $tglpinjam = $row["tgl_pinjam"];
    $tglkembali = $row["tgl_kembali"];
    $status = $row["status"];
    $ket = $row["ket"];
 
    

    $column_id = $column_id.$id."\n";
    $column_judulbuku = $column_judulbuku.$judulbuku."\n";
    
    $column_namapeminjam = $column_namapeminjam.$namapeminjam."\n";
    $column_tglpinjam = $column_tglpinjam.$tglpinjam."\n";
    $column_tglkembali = $column_tglkembali.$tglkembali."\n";
    $column_status = $column_status.$status."\n";
    $column_ket = $column_ket.$ket."\n";
    

//Create a new PDF file
$pdf = new FPDF('L','mm',array(297,350)); //L For Landscape / P For Portrait
$pdf->AddPage();

//Menambahkan Gambar
//$pdf->Image('../foto/logo.png',10,10,-175);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(125);
$pdf->Cell(70,10,'DATA Peminjaman Buku',0,0,'C');
$pdf->Ln();
$pdf->Cell(125);
$pdf->Cell(70,10,'Perpustakaan SQL14l | www.perpusSQ14l.com',0,0,'C');
$pdf->Ln();

}
//Fields Name position
$Y_Fields_Name_position = 30;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(110,180,230);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(25,8,'ID',1,0,'C',1);
$pdf->SetX(30);
$pdf->Cell(90,8,'Judul Buku',1,0,'C',1);
$pdf->SetX(120);
$pdf->Cell(70,8,'nama Peminjam',1,0,'C',1);
$pdf->SetX(190);
$pdf->Cell(40,8,'Tanggal Peminjaman',1,0,'C',1);
$pdf->SetX(230);
$pdf->Cell(35,8,'Tanggal Kembali',1,0,'C',1);
$pdf->SetX(265);
$pdf->Cell(25,8,'Status',1,0,'C',1);
$pdf->SetX(290);
$pdf->Cell(32,8,'Ket',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 38;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(25,6,$column_id,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(30);
$pdf->MultiCell(90,6,$column_judulbuku,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(120);
$pdf->MultiCell(70,6,$column_namapeminjam,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(190);
$pdf->MultiCell(40,6,$column_tglpinjam,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(230);
$pdf->MultiCell(35,6,$column_tglkembali,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(265);
$pdf->MultiCell(25,6,$column_status,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(290);
$pdf->MultiCell(32,6,$column_ket,1,'C');

$pdf->Output();
?>

<?php
include "../conn.php";
require('../fpdf16/fpdf.php');
//Menampilkan data dari tabel di database

$result=mysql_query("SELECT judul, pengarang, th_terbit, penerbit, jumlah_buku, lokasi FROM data_buku") or die(mysql_error());

//Inisiasi untuk membuat header kolom
$column_judul = "";
$column_pengarang = "";
$column_thterbit = "";
$column_penerbit = "";
$column_jumlah = "";
$column_lokasi = "";


//For each row, add the field to the corresponding column
while($row = mysql_fetch_array($result))
{
    $judul = $row["judul"];
    $pengarang = $row["pengarang"];
    $thterbit = $row["th_terbit"];
    $penerbit = $row["penerbit"];
    $jumlah = $row["jumlah_buku"];
    $lokasi = $row["lokasi"];
    

    $column_judul = $column_judul.$judul."\n";
    $column_pengarang = $column_pengarang.$pengarang."\n";
    $column_thterbit = $column_thterbit.$thterbit."\n";
    $column_penerbit = $column_penerbit.$penerbit."\n";
    $column_jumlah = $column_jumlah.$jumlah."\n";
    $column_lokasi = $column_lokasi.$lokasi."\n";

//Create a new PDF file
$pdf = new FPDF('L','mm',array(297,350)); //L For Landscape / P For Portrait
$pdf->AddPage();

//Menambahkan Gambar
//$pdf->Image('../foto/logo.png',10,10,-175);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(125);
$pdf->Cell(70,10,'DATA BUKU',0,0,'C');
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
$pdf->Cell(100,8,'Judul',1,0,'C',1);
$pdf->SetX(105);
$pdf->Cell(60,8,'Pengarang',1,0,'C',1);
$pdf->SetX(165);
$pdf->Cell(25,8,'Tahun Terbit',1,0,'C',1);
$pdf->SetX(190);
$pdf->Cell(80,8,'Penerbit',1,0,'C',1);
$pdf->SetX(270);
$pdf->Cell(30,8,'Jumlah',1,0,'C',1);
$pdf->SetX(300);
$pdf->Cell(40,8,'Lokasi',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 38;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(100,6,$column_judul,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(105);
$pdf->MultiCell(60,6,$column_pengarang,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(165);
$pdf->MultiCell(25,6,$column_thterbit,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(190);
$pdf->MultiCell(80,6,$column_penerbit,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(270);
$pdf->MultiCell(30,6,$column_jumlah,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(300);
$pdf->MultiCell(40,6,$column_lokasi,1,'C');

$pdf->Output();
?>

<?php
include "../conn.php";
require('../fpdf16/fpdf.php');
//Menampilkan data dari tabel di database

$result=mysql_query("SELECT no_induk, nama, jk, kelas, ttl, alamat FROM data_anggota") or die(mysql_error());

//Inisiasi untuk membuat header kolom
$column_noinduk = "";
$column_nama = "";
$column_jk = "";
$column_kelas = "";
$column_ttl = "";
$column_alamat = "";


//For each row, add the field to the corresponding column
while($row = mysql_fetch_array($result))
{
    $noinduk = $row["no_induk"];
    $nama = $row["nama"];
    $jk = $row["jk"];
    $kelas = $row["kelas"];
    $ttl = $row["ttl"];
    $alamat = $row["alamat"];
    

    $column_noinduk = $column_noinduk.$noinduk."\n";
    $column_nama = $column_nama.$nama."\n";
    $column_jk = $column_jk.$jk."\n";
    $column_kelas = $column_kelas.$kelas."\n";
    $column_ttl = $column_ttl.$ttl."\n";
    $column_alamat = $column_alamat.$alamat."\n";

//Create a new PDF file
$pdf = new FPDF('L','mm',array(297,350)); //L For Landscape / P For Portrait
$pdf->AddPage();

//Menambahkan Gambar
//$pdf->Image('../foto/logo.png',10,10,-175);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(125);
$pdf->Cell(70,10,'DATA ANGGOTA',0,0,'C');
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
$pdf->Cell(25,8,'Nomor Induk',1,0,'C',1);
$pdf->SetX(30);
$pdf->Cell(60,8,'Nama',1,0,'C',1);
$pdf->SetX(90);
$pdf->Cell(25,8,'Jenis Kelamin',1,0,'C',1);
$pdf->SetX(115);
$pdf->Cell(80,8,'Kelas',1,0,'C',1);
$pdf->SetX(195);
$pdf->Cell(60,8,'Tempat Lahir',1,0,'C',1);
$pdf->SetX(255);
$pdf->Cell(80,8,'Alamat',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 38;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(25,6,$column_noinduk,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(30);
$pdf->MultiCell(60,6,$column_nama,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(90);
$pdf->MultiCell(25,6,$column_jk,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(115);
$pdf->MultiCell(80,6,$column_kelas,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(195);
$pdf->MultiCell(60,6,$column_ttl,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(255);
$pdf->MultiCell(80,6,$column_alamat,1,'C');

$pdf->Output();
?>

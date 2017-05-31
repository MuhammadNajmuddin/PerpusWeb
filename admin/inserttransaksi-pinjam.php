<?php
$namafolder="gambar_anggota/"; //tempat menyimpan file

include "../conn.php";
        $id = $_POST['id'];
        $judul_buku = $_POST['judul_buku'];       
		$nama_peminjam= $_POST['nama_peminjam'];
        $tgl_pinjam = $_POST['tgl_pinjam'];
        $tgl_kembali = $_POST['tgl_kembali'];
        $status = $_POST['status'];
        $ket = $_POST['ket'];
		
        $sql="INSERT INTO `trans_pinjam`(`id`, `judul_buku`, `nama_peminjam`, `tgl_pinjam`, `tgl_kembali`, `status`, `ket`) VALUES ('$id','$judul_buku','$nama_peminjam','$tgl_pinjam','$tgl_kembali','$status','$ket')";
        $res=mysql_query($sql) or die (mysql_error());            	
        echo "<script>alert('Data Sudah Terkirim'); window.location = 'transaksi.php?error=4'</script>";
?>
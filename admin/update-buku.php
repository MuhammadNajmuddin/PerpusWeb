<?php
$namafolder="gambar_anggota/"; //tempat menyimpan file

include "../conn.php";

if (!empty($_FILES["nama_file"]["tmp_name"]))
{
        $jenis_gambar=$_FILES['nama_file']['type'];
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $th_terbit = $_POST['th_terbit'];
        $penerbit = $_POST['penerbit'];
        $jumlah_buku = $_POST['jumlah_buku'];
        $lokasi = $_POST['lokasi'];        
		
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png")
	{			
		$gambar = $namafolder . basename($_FILES['nama_file']['name']);		
		if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
			$sql="UPDATE data_buku SET judul='$judul', pengarang='$pengarang', th_terbit='$th_terbit', penerbit='$penerbit', jumlah_buku='$jumlah_buku', lokasi='$lokasi', gambar='$gambar' WHERE id='$id'";
			$res=mysql_query($sql) or die (mysql_error());
			echo "Gambar berhasil dikirim ke direktori".$gambar;
            echo "<script>alert('Data sudah Terupdate'); window.location = 'buku.php?error=4'</script>";            
		} else {
		   echo "<p>Gambar gagal dikirim</p>";
		}
   } else {
		echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";
   }
} else {
	echo "Anda belum memilih gambar";
}

?>
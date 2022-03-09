<?php
$nama=$_POST['nama'];
$jenkel=$_POST['jenkel'];
$alamat=$_POST['alamat'];
$no_hp=$_POST['no_hp'];

include("../koneksi.php");

$sql="insert into tbl_siswa(nama,jenkel,alamat,no_hp) values('$nama',
'$jenkel',
'$alamat',
'$no_hp')";

$query=mysqli_query($mysqli,$sql);
if ($query) {
	header("location:../index.php?hal=siswa&pesan=berhasil_tambah");
}else{
	header("location:../index.php?hal=siswa&pesan=gagal_tambah");
	echo mysqli_error();
	echo "$sql";
}



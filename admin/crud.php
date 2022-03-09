<?php
include 'koneksi.php';

if($_GET['act']== 'tambah-barang'){
    $name = $_POST['nama'];
    $price = $_POST['harga'];
    $code = $_POST['code'];

    //query
    $querytambah =  mysqli_query($conn , "INSERT INTO tblproduct( name , price , code ) VALUES('$name' , '$price' , '$code' )");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("location: tabel.php");
    }
    else{
        echo "ERROR, tidak berhasil". mysqli_error($conn);
    }
}
elseif($_GET['act']=='update-barang'){
	$id = $_GET['id'];
    $name = $_POST['nama'];
    $price = $_POST['harga'];
    $code = $_POST['code'];

    //query update
    $queryupdate = mysqli_query($conn, "UPDATE tblproduct SET name='$name' , price='$price' , code='$code' WHERE id='$id' ");

    if ($queryupdate) {
        # credirect ke page index
        header(" location: tabel.php");    
    }
    else{
        echo "ERROR, data gagal diupdate". mysqli_error($conn);
    }
}
elseif ($_GET['act'] == 'delete-barang'){
    $id = $_GET['id'];

    //query hapus
    $querydelete = mysqli_query($conn, "DELETE FROM tblproduct WHERE id = '$id'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:tabel.php");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
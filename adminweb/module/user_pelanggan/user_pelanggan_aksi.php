<?php
include "../../../inc/koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

/*$user_pelanggan = $_POST['user_pelanggan'];*/
$pass = md5($_POST['pass']);
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
//echo "Cek";

// HAPUS
if($module=='user_pelanggan' AND $aksi=='no' ){ 
$sql = "UPDATE user_pelanggan SET blokir='N' WHERE id_user_pelanggan = '".$_GET['id_user_pelanggan']."'";
//echo $sql;
$hapus = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='user_pelanggan' AND $aksi=='yes' ){ 

$sql = "UPDATE user_pelanggan SET blokir='Y' WHERE id_user_pelanggan	 = '".$_GET['id_user_pelanggan']."'";
//echo $sql;
$hapus = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}

//Tambah
else if($module=='user_pelanggan' AND $aksi=='tambah' ){ 
$sql = "INSERT INTO user_pelanggan  ( pass, nama, no_hp, email, blokir ) 
VALUES ( '$pass', '$nama', '$no_hp','$email', 'N')";
//echo $sql;
$simpan = mysqli_query($con,$sql);
}
header('location:../../index.php?module='.$module);

?>
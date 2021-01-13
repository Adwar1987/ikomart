<?php
include "../../../inc/koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$user_rekan = $_POST['user_rekan'];
$pass = md5($_POST['pass']);
$nama = $_POST['nama'];
$id_unit_krj = $_POST['id_unit_krj'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
//echo "Cek";

// HAPUS
if($module=='user_rekan' AND $aksi=='no' ){ 
$sql = "UPDATE user_rekan SET blokir='N' WHERE id_user_rekan = '".$_GET['id_user_rekan']."'";
//echo $sql;
$hapus = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='user_rekan' AND $aksi=='yes' ){ 

$sql = "UPDATE user_rekan SET blokir='Y' WHERE id_user_rekan	 = '".$_GET['id_user_rekan']."'";
//echo $sql;
$hapus = mysqli_query($con,$sql);
header('location:../../index.php?module='.$module);
}

//Tambah
else if($module=='user_rekan' AND $aksi=='tambah' ){ 
$sql = "INSERT INTO user_rekan  (user_rekan, pass, nama, no_hp, email, id_unit_krj, blokir ) 
VALUES ('$user_rekan', '$pass', '$nama', '$no_hp', '$email','$id_unit_krj', 'N')";
//echo $sql;
$simpan = mysqli_query($con,$sql);
}
header('location:../../index.php?module='.$module);

?>
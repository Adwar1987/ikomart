<?php
session_start();
include "../../inc/inc.library.php";
include "../../inc/koneksi.php";
/*require_once("dbcontroller.php");
$db_handle = new DBController();*/

$ip_ad = get_client_ip();
$id_user = '';
if(!empty($_SESSION['id_user_pelanggan'])) {
 	$id_user=$_SESSION['id_user_pelanggan'];
 }
//$id_session = $ip_ad.$id_user;
//echo $id_session."<br>";
 $id_session='';
 if(!empty($_POST['etoken'])) {
 	$id_session=$_POST['etoken'];
 	//settoken($id_session);
 }
if(!empty($_SESSION['e_token'])) {
	$id_session=$_SESSION['e_token'];
}
$jml = 0;
$sqlcart= "SELECT COUNT(id_produk) as jml FROM cart WHERE id_session = '$id_session'";
 	//echo $sqlproduk;
 $qcart= mysqli_query($con,$sqlcart );
 while ($item = mysqli_fetch_array($qcart)){
 	$jml = $item['jml'];
 }
 echo $jml;
?>


<?php
$do='home';
if(isset($_POST['do'])) {
	$do = $_POST['do'];
}
$vb=  $_POST['vb'];
include "../inc/koneksi.php";
include "../inc/fungsi_hdt2.php";
$jml_salah=0;
if(isset($_SESSION['salah'])) {
	$jml_salah = $_SESSION['salah'];
}


function anti_injection($data){
  //$filter = mysqli_real_escape_string($con,stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  $filter = mysqli_real_escape_string($con,$data);
  return $filter;
}
	
//$username= anti_injection($_POST['username']);
//$pass	 = anti_injection($_POST['password']);
$email	=  mysqli_real_escape_string($con,$_POST['email']);
$pass	=  md5(mysqli_real_escape_string($con,$_POST['password']));
//echo $_POST['username']	;
//$pass = anti_injection($_POST['password']);
// pastikan username dan password adalah berupa huruf atau angka.
//if (!ctype_alnum($username) OR !ctype_alnum($pass)){
//  echo "Sekarang loginnya tidak bisa di injeksi lho.";
//
/* <script>
	alert('Sekarang loginnya tidak bisa di injeksi lho.');
	window.location.href='index.php';
</script> */

//}else{
	$sql = "SELECT * FROM user_pelanggan WHERE email='$email'";
	$login	=mysqli_query($con,$sql);
	$ketemu	=mysqli_num_rows($login);
	//echo $sql	;
	if ($ketemu>0){
		$r		=mysqli_fetch_array($login);
		$pwd	=$r['pass'];
		if ($r['blokir'] == 'Y'){
			salah_blokir($email);
			return false;
		}
		if ($pwd==$pass){
			sukses_masuk($email,$pass,$do);
			//echo $pass;
		}else{
			session_start();
			$salah =1;
			$_SESSION['salah']=$jml_salah+$salah;
			if ($_SESSION['salah']>=3){
				blokir($email);
			}
			salah_password();
		}
	}else{
		salah_username($email);
	}
//}
?>

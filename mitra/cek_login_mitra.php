<?php
include "../inc/koneksi.php";
include "../inc/fungsi_hdt3.php";

function anti_injection($data){
  //$filter = mysqli_real_escape_string($con,stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  $filter = mysqli_real_escape_string($con,$data);
  return $filter;
}
	
//$username= anti_injection($_POST['username']);
//$pass	 = anti_injection($_POST['password']);
$email=  mysqli_real_escape_string($con,$_POST['email']);
$pass	 =  md5(mysqli_real_escape_string($con,$_POST['password']));
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
	$sql = "SELECT * FROM user_rekan WHERE email='$email'";
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
			sukses_masuk($email,$pass);
			//echo $pass;
		}else{
			session_start();
			$salah =1;
			$_SESSION['salah']=$_SESSION['salah']+$salah;
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

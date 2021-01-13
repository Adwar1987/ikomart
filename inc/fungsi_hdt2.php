<?php
$do='home';
if(isset($_POST['do'])) {
  $do = $_POST['do'];
}
if(isset($_GET['do'])) {
  $do = $_GET['do'];
}
function sukses_masuk($email,$pass,$do){
	include "koneksi.php";
  $_SESSION['salah']=0;
  $_SESSION['login'] = 0;
	// Apabila username dan password ditemukan
	$sql = "SELECT * FROM user_pelanggan WHERE email='$email' AND pass='$pass' AND blokir='N'";
	$login=mysqli_query($con,$sql);
	$ketemu=mysqli_num_rows($login);
	//echo $ketemu;
	$r=mysqli_fetch_array($login);
	if ($ketemu > 0){
	  //session_start();
	  include "timeout.php";
		$_SESSION['id_user_pelanggan']     = $r['id_user_pelanggan']; 
		$_SESSION['email']     = $r['email']; 
		$_SESSION['nama']    = $r['nama'];
    $_SESSION['jml'] = 0;
    $_SESSION['dev'] = 0;
    $_SESSION['login'] = 1;
    $_SESSION['apl'] = "ikomart";
		
    $vb=  $_POST['vb'];
  //echo $vb;
  if($vb == 'm') {
      header('location:../m/?module='.$do);
    }else{
      header('location:../?module='.$do);
  }
  setcookie("id_user_pelanggan", $_SESSION['id_user_pelanggan'] , time() + (3600 ), "/");  
  setcookie("nama", $_SESSION['nama'] , time() + (3600 ), "/");  
  setcookie("email", $_SESSION['email'] , time() + (3600 ), "/");
   

		// session timeout
		timer();
		
	}else{
		$_SESSION['salah']=1;
	}
	return false;
} 

function msg(){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'>
  <link href='css/reset.css' rel='stylesheet' type='text/css'>
  <link href='css/style_button.css' rel='stylesheet' type='text/css'>
  <center><br><br><br><br><br><br>Maaf, silahkan cek kembali <b>Username</b> dan <b>Password</b> Anda<br><br>Kesalahan $_SESSION[salah]";
  echo "<div> <a href='../?module=login'><img src='../img/kunci.png'  height=176 width=176></a>
  </div>";
  echo "<input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='../?module=login'></a></center>";
  return false;
}

function salah_blokir($usernm){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'>
  <link href='css/reset.css' rel='stylesheet' type='text/css'>
  <link href='css/style_button.css' rel='stylesheet' type='text/css'>
  <center><br><br><br><br><br><br>Maaf, Username <b>$usernm</b> telah <b>TERBLOKIR</b>, silahkan hubungi Administrator.";
  echo "<div style=''> <a href='../?module=login'><img src='../img/kunci.png'  height=176 width=176></a>
  </div>";
  echo "<input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='../?module=login'></a></center>";
  return false;
}
function salah_username($usernm){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'>
  <link href='css/reset.css' rel='stylesheet' type='text/css'>
  <link href='css/style_button.css' rel='stylesheet' type='text/css'>
  <center><br><br><br><br><br><br>Maaf, Username <b>$usernm</b> tidak dikenal.";
  echo "<div> <a href='../?module=login'><img src='../img/kunci.png'  height=176 width=176></a>
  </div>";
  echo "<input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='../?module=login'></a></center>";	
  return false;
}

function salah_password(){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'>
  <link href='css/reset.css' rel='stylesheet' type='text/css'>
  <link href='css/style_button.css' rel='stylesheet' type='text/css'>
  <center><br><br><br><br><br><br>Maaf, silahkan cek kembali <b>Password</b> Anda<br><br>Kesalahan $_SESSION[salah]";
  echo "<div> <a href='../?module=login'><img src='../img/kunci.png'  height=176 width=176></a>
  </div>";
  echo "<input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='../?module=login'></a></center>";
   return false;
}

function blokir($username){
	//include "koneksi.php";
	//mysqli_query($con,$sql);	 
	session_destroy();
	 return false;
}    

?>
<?php
function sukses_masuk($usernm,$pass){
	include "koneksi.php";
	// Apabila username dan password ditemukan
	$sql = "SELECT * FROM user WHERE user='$usernm' AND pass='$pass' AND blokir='N'";
	$login=mysqli_query($con,$sql);
	$ketemu=mysqli_num_rows($login);
	//echo $ketemu;
	$r=mysqli_fetch_array($login);
	if ($ketemu > 0){
	  //session_start();
	  include "timeout.php";
		$_SESSION['id']     = $r['id_user']; 
		$_SESSION['usernm']     = $r['user']; 
		$_SESSION['passuser']     = $r['pass'];
		$_SESSION['level']    = $r['level'];
		$_SESSION['nama']    = $r['nama'];
    $_SESSION['dev'] = 1;
    $_SESSION['apl'] = "ikomart";
		
header('location:../adminweb/?module=home');
/*setcookie("iduser", $_SESSION['id'] , time() + (3600 ), "/");  
setcookie("nmuser", $_SESSION['nama'] , time() + (3600 ), "/");  
setcookie("lvluser", $_SESSION['level'] , time() + (3600 ), "/");*/
 

		// session timeout
		$_SESSION['login'] = 1;
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
  echo "<div> <a href='index.php'><img src='../img/kunci.png'  height=176 width=176></a>
  </div>";
  echo "<input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='index.php'></a></center>";
  return false;
}

function salah_blokir($usernm){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'>
  <link href='css/reset.css' rel='stylesheet' type='text/css'>
  <link href='css/style_button.css' rel='stylesheet' type='text/css'>
  <center><br><br><br><br><br><br>Maaf, Username <b>$usernm</b> telah <b>TERBLOKIR</b>, silahkan hubungi Administrator.";
  echo "<div style=''> <a href='index.php'><img src='../img/kunci.png'  height=176 width=176></a>
  </div>";
  echo "<input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='index.php'></a></center>";
  return false;
}
function salah_username($usernm){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'>
  <link href='css/reset.css' rel='stylesheet' type='text/css'>
  <link href='css/style_button.css' rel='stylesheet' type='text/css'>
  <center><br><br><br><br><br><br>Maaf, Username <b>$usernm</b> tidak dikenal.";
  echo "<div> <a href='index.php'><img src='../img/kunci.png'  height=176 width=176></a>
  </div>";
  echo "<input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='index.php'></a></center>";	
  return false;
}

function salah_password(){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'>
  <link href='css/reset.css' rel='stylesheet' type='text/css'>
  <link href='css/style_button.css' rel='stylesheet' type='text/css'>
  <center><br><br><br><br><br><br>Maaf, silahkan cek kembali <b>Password</b> Anda<br><br>Kesalahan $_SESSION[salah]";
  echo "<div> <a href='index.php'><img src='../img/kunci.png'  height=176 width=176></a>
  </div>";
  echo "<input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='index.php'></a></center>";
   return false;
}

function blokir($username){
	//include "koneksi.php";
	//mysqli_query($con,$sql);	 
	session_destroy();
	 return false;
}    

?>
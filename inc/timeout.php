<?php
ob_start();
session_start();
function timer(){
	// $time=193500;
	// $_SESSION['timeout']=time()+$time; 
	$time=1;
	$_SESSION['timeout']=10;
}
function cek_login(){
	$time=1;
	$timeout=$_SESSION[timeout];
	//if(time()<$timeout){
	if($time<$timeout){
		timer();
		return true;
	}else{
		unset($_SESSION[timeout]);
		return false;
	}
}
?>

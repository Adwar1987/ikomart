<?php
include "./inc/inc.library.php";
/*$_IP_SERVER = $_SERVER['SERVER_ADDR'];
    $_IP_ADDRESS = $_SERVER['REMOTE_ADDR']; 
	echo $_IP_ADDRESS ." - ". $_IP_SERVER."<br>";
    if($_IP_ADDRESS == $_IP_SERVER)
    {
        ob_start();
        system('ipconfig /all');
        $_PERINTAH  = ob_get_contents();
        ob_clean();
        $_PECAH = strpos($_PERINTAH, "Physical");
        $_HASIL = substr($_PERINTAH,($_PECAH+36),17);
    }
     else {
        $_PERINTAH = "arp -a $_IP_ADDRESS";
        ob_start();
        system($_PERINTAH);
        $_HASIL = ob_get_contents();
        ob_clean();
        $_PECAH = strstr($_HASIL, $_IP_ADDRESS);
        $_PECAH_STRING = explode($_IP_ADDRESS, str_replace(" ", "", $_PECAH));
        $_HASIL = substr($_PECAH_STRING[1], 0, 17);
    }
$random = md5($_HASIL);
$nilai= preg_replace("/[^0-9]/", "", $random);
$macaddr=substr($nilai,0,15);
echo 'Ini adalah mac addr = ';
echo $_HASIL;
echo '<br>';
echo 'Ini adalah mac addr yg dikonvert md5 dan diambil 15karakter angka = ';
echo $macaddr;*/
    echo "IP anda adalah : ". get_client_ip()."<br>";
    echo "MAC anda adalah : ". get_client_mac()."<br>";
   echo "Browser : ".get_client_browser()."<br>";
   echo "Sistem Operasi : ".$_SERVER['HTTP_USER_AGENT']."<br>";
    echo "timestamp=".milliseconds() ;
?>
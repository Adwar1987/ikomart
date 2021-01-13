<?php
# Pengaturan tanggal komputer
date_default_timezone_set("Asia/Jakarta");
//$etoken = '';

# Fungsi untuk membalik tanggal dari format English (Y-m-d) -> Indo (d-m-Y)
function IndonesiaTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal="$tgl-$bln-$thn";
	return $tanggal;
}

# Fungsi untuk membalik tanggal dari format English (Y-m-d) -> Indo (d-m-Y)
function Indonesia2Tgl($tanggal){
	 $namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
					 "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
					 
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$tanggal ="$tgl ".$namaBln[$bln]." $thn";
	return $tanggal;
}

function hitungHari($myDate1, $myDate2){
        $myDate1 = strtotime($myDate1);
        $myDate2 = strtotime($myDate2);
 
        return ($myDate2 - $myDate1)/ (24 *3600);
}

# Fungsi untuk mengecek nama hari
function nama_hari($tanggal){
	include "koneksi.php";
	$query = "SELECT datediff('$tanggal', CURDATE()) as selisih"; 
	//echo $query ;
	$hasil = mysqli_query($con,$query);
	if (!$hasil)
	{exit("Error in SQL nama_hari");}
	$data  = mysqli_fetch_array($hasil);

	$selisih = $data['selisih'];

	$x  = mktime(0, 0, 0, date("m"), date("d")+$selisih, date("Y")); 
	$day = date("D", $x); 
	$dayList = array(
		'Sun' => 'Minggu',
		'Mon' => 'Senin',
		'Tue' => 'Selasa',
		'Wed' => 'Rabu',
		'Thu' => 'Kamis',
		'Fri' => 'Jumat',
		'Sat' => 'Sabtu'
	);
	return $dayList[$day];
}

# Fungsi untuk membuat format rupiah pada angka (uang)
function format_angka($angka) {
	$hasil =  number_format($angka,0, ",",".");
	return $hasil;
}

# Fungsi untuk format tanggal, dipakai plugins Callendar
function form_tanggal($nama,$value=''){
	echo" <input type='text' name='$nama' id='$nama' size='11' maxlength='20' value='$value'/>&nbsp;
	<img src='images/calendar-add-icon.png' align='top' style='cursor:pointer; margin-top:7px;' alt='kalender'onclick=\"displayCalendar(document.getElementById('$nama'),'dd-mm-yyyy',this)\"/>			
	";
}

function angkaTerbilang($x){
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return angkaTerbilang($x - 10) . " belas";
  elseif ($x < 100)
    return angkaTerbilang($x / 10) . " puluh" . angkaTerbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . angkaTerbilang($x - 100);
  elseif ($x < 1000)
    return angkaTerbilang($x / 100) . " ratus" . angkaTerbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . angkaTerbilang($x - 1000);
  elseif ($x < 1000000)
    return angkaTerbilang($x / 1000) . " ribu" . angkaTerbilang($x % 1000);
  elseif ($x < 1000000000)
    return angkaTerbilang($x / 1000000) . " juta" . angkaTerbilang($x % 1000000);
}

function get_client_ip()
 {
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
          $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';

      return $ipaddress;
 }
 
 function get_client_mac()
 {
      $macaddress = '';
      $_IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
      //$_IP_ADDRESS = getenv('REMOTE_ADDR');
      $_PERINTAH = "arp -a $_IP_ADDRESS";
     // $_PERINTAH = "ipconfig $_IP_ADDRESS";
      ob_start();
      system($_PERINTAH);
      $macaddress  = ob_get_contents();
      ob_clean();

      return $macaddress;
 }

 function send_mail($to,$from,$subject,$msg){
  
    $headers ="MIME-Version: 1.0 ";
    $headers.="from: $from  $subject  ";
    $headers.="Content-type: html;charset=utf-8 ";
    $headers.="X-Priority: 3";
    $headers.="X-Mailer: smail-PHP ".phpversion()."";
    $msg    =$subject.'
    '.$msg;
 
    if( @mail($to,$subject,$msg,$headers) ){
		echo "Email sent successfully !!";	
        return true;
    }else{
        return false;
    }
}

// Mendapatkan jenis web browser pengunjung
function get_client_browser() {
    $browser = '';
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
        $browser = 'Netscape';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
        $browser = 'Firefox';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
        $browser = 'Chrome';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
        $browser = 'Opera';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        $browser = 'Internet Explorer';
    else
        $browser = 'Other';
    return $browser;
}

function milliseconds() {
        $mt = explode(' ', microtime());
        return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
    }

/*function gettoken($gettoken){
     $e_token = $gettoken;
    return $e_token;
}*/

 function decopass($string, $type){
    // Store the cipher method 
      $ciphering = "AES-128-CTR"; 
    // Use OpenSSl Encryption method 
      $iv_length = openssl_cipher_iv_length($ciphering); 
      $options = 0; 
    // Non-NULL Initialization Vector for encryption 
        $encryption_iv = '1234567891011121'; 
    // Store the encryption key 
        $encryption_key = "GeeksforGeeks"; 
        if ($type == 'encrypt') {
          $data =  openssl_encrypt($string, $ciphering, $encryption_key, $options, $encryption_iv);
        } else if ($type == 'decrypt') {
          $data = openssl_decrypt ($string, $ciphering, $encryption_key, $options, $encryption_iv); 
        }
            
        return $data;
    }

?>
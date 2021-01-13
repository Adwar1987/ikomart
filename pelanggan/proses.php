<?php

//echo "Reset Passowrd Pelanggan Ikomart";
//include "inc/koneksi.php"; 

$jenis="";
$email = "";
$password = "";
$pass_confirm = "";

if(isset($_GET['jenis'])) {
	$jenis = $_GET['jenis'];
}

if(isset($_GET['iko'])) {
	$jenis = urldecode($_GET['iko']);
	$jenis = decopass($jenis,'decrypt');
}


if(isset($_GET['email'])) {
	$email = mysqli_real_escape_string($con, $_GET['email']);
}

if(isset($_GET['eml'])) {
	$email2 = mysqli_real_escape_string($con, $_GET['eml']);
}


if(isset($_GET['password'])) {
	$password = $_GET['password'];
}

if(isset($_GET['pass_confirm'])) {
	$pass_confirm = $_GET['pass_confirm'];
}


if(isset($_POST['jenis'])) {
	$jenis = $_POST['jenis'];
}

if(isset($_POST['email'])) {
	$email = urldecode($_POST['email']);
}

if(isset($_POST['password'])) {
	$password = $_POST['password'];
}

if(isset($_POST["pass_confirm"])) {
	  $pass_confirm = $_POST["pass_confirm"];
}

//echo $jenis;
$email_enk =  decopass($email,'encrypt');
$email_dek =  decopass($email2,'decrypt');

/*echo urldecode($email)."<br>";
echo decopass($email,'decrypt')."<br>";
$email_enk2 = decopass('warmansaid@gmail.com','encrypt');
echo $email_enk2."<br>";
echo decopass($email_enk2,'decrypt')."<br>";*/
$subjek = "Reset password Pelanggan Ikomart";

if($password!=$pass_confirm){
	echo "<script>
	alert('Konfirmasi password tidak sama');	
	</script>"; 
}else{
	if($password<>'') {
		$password = md5($password);
		$mySql = "UPDATE user_pelanggan SET pass='$password' WHERE email='$email'";
		//echo $mySql;
		$simpan = mysqli_query($con,$mySql);
		if (!$simpan)
			{ exit("Simpan Gagal: " . $simpan);
		}	
		echo "<script>
		alert('Konfirmasi perubahan password berhasil');	
		window.location='?module=login';
		</script>"; 
		//header('location:?module=login');
	}
	
}

// TAMBAH
if($jenis=='kirim_email' ){ 
// upload Process
		$to=$email;
		$subject = $subjek;
		$from = 'cs.uranglapau@ikomart.id';
		$message='From: Ikomart.id
		Klik link dibawah ini untuk reset password anda :
		dev.ikomart.id?module=reset&iko='.urlencode(decopass('newpass','encrypt')).'&eml='.urlencode($email_enk).'
		Harap informasi ini dirahasiakan';

		send_mail($to,$from,$subject,$message);
	 echo "<script>
	alert('Link reset password dikirimkan, Silahkan buka pada email anda');
	window.location='?module=login';
	</script>"; 
	//header('location:?module=login'); 
}elseif($jenis=='reset' ){ 
	/*$mySql = "UPDATE user_pelanggan SET pass='$password' WHERE email='$email'";
	//echo $mySql;
	$simpan = mysqli_query($con,$mySql);
	if (!$simpan)
		{ exit("Simpan Gagal: " . $simpan);
	}	
	header('location:?module=login'); */
}elseif($jenis=='newpass' ){ 
	
?>
	<div class="single-form">
		<div class="container">
			<div class="row">
				<?php
						if($vb == 'm') {
					?>
						<div class="col-xs-12">
					<?php
						}else{
					?>
						<div class="col-xs-6 col-xs-offset-3">
					<?php
						}
					?>
					<div class="panel panel-default">
						<h1 class="panel-heading m-t-0">Reset Password</h1>
						<div class="panel-body">
							<form class="form-horizontal" id="loginForm" role="form" method="POST">
								<input type="hidden" name="vb" value="<?php echo $vb; ?>">
								<div class="form-group">
									<label for="email" class="col-xs-4 control-label">E-Mail Address</label>
									<div class="col-xs-6">
										<input id="email" type="email" class="form-control" name="email" readonly value="<?php echo $email_dek; ?>" required="required" placeholder="E-Mail" autofocus>
										<input type="hidden" class="form-control" name="do" value="<?php echo $do; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-xs-4 control-label">Password</label>
									<div class="col-xs-6">
										<input id="password" type="password" class="form-control" name="password" required="required"placeholder="Password">
									</div> 
								</div>

								<div class="form-group">
									<label for="password-confirm" class="col-xs-4 control-label">Confirm Password</label><div class="col-xs-6">
										<input id="pass_confirm" type="password" class="form-control" name="pass_confirm" required="required" placeholder="Konfirmasi Password">
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-8 col-xs-offset-4">
										<button type="submit" id="btn-submit" class="btn btn-primary"> Submit </button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}


		// More headers
		
	/* 	$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= 'From: <upg.rssnbkt@gmail.com>' . "\r\n";
		//$headers .= 'Cc: admin@yourdomain.com' . "\r\n";
		@mail($to,$subject,$message,$headers);
		 if(@mail)
		{
		echo "Email sent successfully !!";	
		}  */
?>


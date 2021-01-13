<?php
$nama='';
$email='';
$no_hp='';
$pass='';
$pass_confirm='';
if(isset($_POST["pass"])) {
	  $pass = $_POST["pass"];
	  $pass2 =  md5($pass);
}
if(isset($_POST["pass_confirm"])) {
	  $pass_confirm = $_POST["pass_confirm"];
}
if(isset($_POST["nama"])) {
	  $nama = $_POST["nama"];
}
if(isset($_POST["email"])) {
	  $email = $_POST["email"];
}
if(isset($_POST["no_hp"])) {
	  $no_hp = $_POST["no_hp"];
}
	/*$user_pelanggan = $_POST['user_pelanggan'];*/

if($pass!=$pass_confirm){
echo "<script>
alert('Konfirmasi password tidak sama');	
</script>"; 
}else{
	if($pass<>'') {
		$cek='0';
		$sqlcek = "SELECT '1' as cek from user_pelanggan where email='$email'";
		//echo $sql;
		$cekdata = mysqli_query($con,$sqlcek);
		$rcek=mysqli_fetch_array($cekdata);
		if ($rcek['cek']=='1'){
			echo "<script>
			alert('Akun dengan Email ini sudah ada..');
			</script>"; 
		}else{
			$datafile = mysqli_query($con, "select max(id_user_pelanggan) as lastid from user_pelanggan");
			$edit=mysqli_fetch_array($datafile);
			//$id_produk = $edit['lastid'] + 1; 
			$lastID = $edit['lastid']; 
			$lastNoUrut = substr($lastID,13, 20); 
			$nextNoUrut = $lastNoUrut + 1;
 			$nextID = "PLGIKO".date('Y').sprintf("%04s",$nextNoUrut);
			//echo $nextID;
			//'PLGIKO20200002'
			$sql = "INSERT INTO user_pelanggan  ( id_user_pelanggan, pass, nama, no_hp, email, blokir ) 
			VALUES ('$nextID','$pass2', '$nama', '$no_hp','$email', 'N')";
			//echo $sql;
			$simpan = mysqli_query($con,$sql);
			/*header('location:../index.php?module=login');
			echo "Selamat anda sudah terdaftar, silahkan login dengan e-mail dan password yang dibuat";
			sleep(3);*/
			echo "<script>
			window.location='?module=login';
			alert('Selamat anda sudah terdaftar, silahkan login dengan e-mail dan password yang dibuat'); 
			</script>	";
			//sleep(3);
		}
	}
	
}

?>

<script type="text/javascript"> 
/* mixpanel.track_links(".mp-nav_link", "Click Nav Link", { "User Identity" : "guest" }); function mixpanelRemoveCart(name, qty, price){ mixpanel.track("Remove Product From Cart", {"User Identity" : user_identity,"Product Name" : name,"Qty" : qty,"Price" : price,}); return false; } mixpanel.track_links(".mp-contact_link", "Click to Contact Lemonilo", {"User Identity" : "guest" }); */
</script>
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
					<h1 class="panel-heading m-t-0">Register</h1>
					<div class="panel-body">
						<form class="form-horizontal" id="registerForm" role="form" method="POST" >
							<!-- <input type="hidden" name="_token" value="YFCcsbwwILJvDpPvexUXpNRiEd4NvHiRpomhyaTm"> -->
							<div class="form-group">
								<label for="name" class="col-xs-4 control-label">Full Name</label>
								<div class="col-xs-6">
									<input id="nama" type="text" class="form-control" name="nama" required="required"  value="<?php echo $nama;?>" placeholder="Nama Lengkap" autofocus>
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-xs-4 control-label">E-Mail Address</label>
								<div class="col-xs-6">
									<input id="email" type="email" class="form-control" name="email" required="required" value="<?php echo $email;?>" placeholder="E-Mail">
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-xs-4 control-label">Nomor HP</label>
								<div class="col-xs-6">
									<input id="no_hp" type="text" class="form-control" name="no_hp" required="required" value="<?php echo $no_hp;?>" placeholder="Nomor HP">
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-xs-4 control-label">Password</label>
								<div class="col-xs-6">
									<input id="pass" type="password" class="form-control" name="pass" required="  required" value="<?php echo $pass;?>" placeholder="Password">
								</div>
							</div>
							<div class="form-group">
								<label for="password-confirm" class="col-xs-4 control-label">Confirm Password</label><div class="col-xs-6">
									<input id="pass_confirm" type="password" class="form-control" name="pass_confirm" required="required" placeholder="Konfirmasi Password">
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-6 col-xs-offset-4">
									<button type="submit" id="btn_submit" class="btn btn-primary" > Register </button>
								</div>
							</div>
							<script language="javascript">

								function kirimdata() {
							        var btn = document.getElementById('btn_submit');
							        var pass=document.getElementById("pass").value;
									var pass_confirm=document.getElementById("pass_confirm").value;
							        //alert(pass_confirm);
							        /*if(pass!=pass_confirm){
								        alert('Konfirmasi password tidak sama');
								        document.getElementById("pass_confirm").value='';
										 //window.history.back();
									}else{
										btn.disabled = true;
							        	btn.innerText = 'Kirim...'
										$.ajax({
											url:'module/data_user_pelanggan.php',
											type:'POST',
											//dataType:'html',
											data: {'aksi':'tambah','nama':nama,'email':email,'no_hp':no_hp,'pass':pass},
											success:function (respons) {
												alert(respons);
												location.href = "?module=login";
												//$('#nip_rs').html(respons);
											}, 	
											
										})  
									}*/
							    }
							</script>	
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
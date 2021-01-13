<?php
	$sts_mobile = './';
	if($vb == 'm') {
		$sts_mobile = '../';
	}
	$do='home';
	if(isset($_GET['do'])) {
		$do = $_GET['do'];
	}
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
					<h1 class="panel-heading m-t-0">Login</h1>
					<div class="panel-body">
						<form class="form-horizontal" id="loginForm" role="form" method="POST" action="<?php echo $sts_mobile; ?>pelanggan/cek_login_pelanggan.php">
							<input type="hidden" name="vb" value="<?php echo $vb; ?>">
							<div class="form-group">
								<label for="email" class="col-xs-4 control-label">E-Mail Address</label>
								<div class="col-xs-6">
									<input id="email" type="email" class="form-control" name="email" required="required" value="" placeholder="E-Mail" autofocus>
									<input type="hidden" class="form-control" name="do" value="<?php echo $do; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-xs-4 control-label">Password</label>
								<div class="col-xs-6">
									<input id="password" type="password" class="form-control" name="password" placeholder="Password">
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-8 col-xs-offset-4">
									<button type="submit" id="btn-submit" class="btn btn-primary"> Login </button>
									<a title="Reset" href="javascript:reset()" >Lupa Password ?</a>
									<hr>
									Belum punya akun?
									<!-- <a class="btn btn-link" href="password/reset.html"> Forgot Your Password? </a> -->
									<a class="btn btn-primary" href="?module=register" title="Daftar">Registrasi</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function reset() {
		var email= $('#email').val();
		//alert(email);
		location.href = '?module=reset&jenis=kirim_email&email='+email;
		//$.post("pelanggan/proses.php", { email: "email", jenis: "kirim_email" } );
	}
</script>
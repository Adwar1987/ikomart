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
					<h1 class="panel-heading m-t-0">Login Mitra Ikomart</h1>
					<div class="panel-body">
						<form class="form-horizontal" id="loginForm" role="form" method="POST" action="mitra/cek_login_mitra.php">
							<input type="hidden" name="_token" value="PeAFa88AxgTtxLk9TW5nGl6vhMMmY6qjfI9Xn46g">
							<div class="form-group">
								<label for="email" class="col-xs-4 control-label">E-Mail Address</label>
								<div class="col-xs-6">
									<input id="email" type="email" class="form-control" name="email" value="" placeholder="E-Mail" autofocus>
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
									<a class="btn btn-link" href="password/reset.html"> Forgot Your Password? </a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
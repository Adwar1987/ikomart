<?php
	function redirectTohttps() {
	if($_SERVER['HTTPS']!="on") {
	$redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header("Location:$redirect"); } }
	redirectTohttps();

	include '../inc/cek_session.php';
	/*include 'inc/fungsi_hdt.php';*/
	include '../inc/inc.library.php'; 
	//include 'koneksi.php';

	 if($_SESSION['dev']==0){
		echo '<script>
	alert(\'Anda Menyalahi Hak AKSES!\');
	</script>	'; 
	  header('location:../logout.php');
} 

?>
 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>DASHBOARD WEB Ikomart.id </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- daterange picker -->
    <link href="../aset/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="../aset/plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="../aset/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="../aset/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="../aset/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../aset/plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
	
	<!-- CKEditor -->
	<script type="text/javascript" src="../aset/plugins/ckeditor_4.5.7/ckeditor.js"></script>
    <script type="text/javascript" src="../aset/plugins/ckeditor_4.5.7/styles.js"></script>
  
    <!-- Bootstrap 3.3.4 -->
    <link href="../aset/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
	<link href="../aset/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- Ionicons -->
	<link href="../aset/bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!--<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- DATA TABLES -->
    <link href="../aset/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../aset/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="../aset/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />	
  </head>
  <body class="skin-yellow sidebar-mini fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Iko<br>mart</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Ikomart.id</b></span> 
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
		  
            <ul class="nav navbar-nav">
			
              <!-- Messages: style can be found in dropdown.less-->			  
			  	<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../aset/dist/img/admin.jpg" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">
				  <?php
				   echo $_SESSION['usernm'];
				  ?>
				  </span>
                </a> 
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../aset/dist/img/admin.jpg" class="img-circle" alt="User Image" />
                   <p>
                      <?php echo $_SESSION['usernm']; ?>
                      <small>(( <?php echo $_SESSION['level']; ?>
					  ))</small>
                    </p>
                  </li>                   
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="index.php?module=edit_user&id_user=<?php echo ($_SESSION['id']);?>" class="btn btn-default btn-flat">&nbsp;<i class="fa fa-user"></i>&nbsp;Profil</a>
                    </div>
                    <div class="pull-right">
                      <a href="../logout.php" class="btn btn-default btn-flat">&nbsp;<i class="fa fa-power-off"></i>&nbsp;Keluar</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
               <!--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-info-circle"></i></a>
              </li>-->
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
         <li style="margin:2%;">
			<table>
			<tr>
			<td rowspan="3"><img src="../img/ikomart.jpg"style="margin-right:15px;width:40px;height:35px;" class="img-circle" alt="User Image" /></td>
			<th><h4 class="text-orange">PT. Iko Minang Ritel</h4>
			</th>
			
			 <!--<tr>
			 <td><i class="text-red">
				<a href="index.php?module=edit_user&id_user=<?php //echo $_COOKIE['iduser1'];?>" class="btn btn-xs btn-danger ">&nbsp;<i class="fa fa-user"></i>&nbsp;</a> 
				&nbsp;&nbsp;
				<a href="../logout.php" class="btn btn-xs btn-danger ">&nbsp;<i class="fa fa-power-off"></i>&nbsp;</a>
			</td>
			</tr>-->
			</tr>
			</table>
			</li>
          <!-- search form -->
         <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div> -->
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
			<li><a href="?module=home"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
      <?php
          if($_SESSION['dev'] == 1){
        ?>
      <li class="treeview">
         <a href="#">
          <i class="fa fa-user-secret"></i> <span>Master User</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
        <ul class="treeview-menu">
          <li><a href='?module=user' ><i class="fa fa-user"></i><span>Data <i>User Ikomart</i></span></a></li>
          <li><a href='?module=user_rekan' ><i class="fa fa-user"></i><span>Data <i>User Mitra</i></span></a></li>
          <li><a href='?module=user_pelanggan' ><i class="fa fa-user"></i><span>Data <i>User Pelanggan</i></span></a></li>
        </ul>
      </li>
			
			<li class="treeview">
				 <a href="#">
					<i class="fa fa-tasks"></i> <span>Master Data</span> <i class="fa fa-angle-left pull-right"></i>
				  </a>
				<ul class="treeview-menu">
					<li><a href='?module=unit_krj' ><i class="fa fa-institution"></i><span>Departemen</span></a></li>
					<li><a href='?module=group' ><i class="fa fa-institution"></i><span>Group Produk</span></a></li>
					<li><a href='?module=kelompok' ><i class="fa fa-institution"></i><span>Kelompok Produk</span></a></li>
					<li><a href='?module=kategori' ><i class="fa fa-institution"></i><span>Kategori Produk</span></a></li>
					<li><a href='?module=blog' ><i class="fa fa-newspaper-o"></i><span>Jenis Blog</span></a></li>
					<li><a href='?module=kirim' ><i class="fa fa-send-o"></i><span>Jenis Pengiriman</span></a></li>
					<li><a href='?module=bayar' ><i class="fa fa-money"></i><span>Jenis Pembayaran</span></a></li>
          <li><a href='?module=wilayah' ><i class="fa fa-map-o"></i><span>Wilayah</span></a></li>
					<li><a href='?module=ongkir' ><i class="fa fa-money"></i><span>Ongkos Kirim Dalam Negeri</span></a></li>
          <li><a href='?module=ongkirln' ><i class="fa fa-money"></i><span>Ongkos Kirim Luar Negeri</span></a></li>
				</ul>
			</li>
      <?php
        }
      ?>
			<li class="treeview">
				 <a href="#">
					<i class="fa fa-tasks"></i> <span>Data Isi Web</span> <i class="fa fa-angle-left pull-right"></i>
				  </a>
				<ul class="treeview-menu">
					<li><a href='?module=product' ><i class="glyphicon glyphicon-briefcase"></i><span>Product</span></a></li>
					<li><a href='?module=price' ><i class="glyphicon glyphicon-briefcase"></i><span>Price</span></a></li>
					<?php
            if($_SESSION['dev'] == 1){
          ?>
          <li><a href='?module=berita' ><i class="glyphicon glyphicon-briefcase"></i><span>Blog</span></a></li>
          <li><a href='?module=order' ><i class="glyphicon glyphicon-briefcase"></i><span>Order Pesanan</span></a></li>
          <?php
            }
          ?>
				</ul>
			</li>
			
          
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div style="background:url(../img/0.png)repeat;" class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section  class="content-header">
          <h1> DASHBOARD WEB
            <small>Ikomart.id</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="glyphicon glyphicon-time"></i><?php echo Indonesia2Tgl(date('Y-m-d'));?> </a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section  class="content">
 <!-- diini lah kita kasih artikel nya --> 
<div class="box box-danger">
</div>
	<?php include "isi.php";?>        		
 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
         Ikomart.id <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2020 <a href="#"></a>.</strong> All rights reserved.
		 || <a href="#"><i class="fa fa-facebook"></i></a>&nbsp;&nbsp;<a href="#"><i class="fa fa-twitter"></i></a>&nbsp;&nbsp;<a href="#"><i class="fa fa-instagram"></i></a>
      </footer>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->

<script src="../aset/plugins/jQuery/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../aset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../aset/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../aset/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- InputMask -->
    <script src="../aset/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../aset/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../aset/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- date-range-picker -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script> -->
	  <script src="../aset/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="../aset/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <script src="../aset/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="../aset/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../aset/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../aset/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../aset/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../aset/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../aset/dist/js/demo.js" type="text/javascript"></script>

    <script src="../js/cart.js?t=<?php echo milliseconds(); ?>" type="text/javascript"></script>
    <!-- page script -->
	<script type="text/javascript">
      $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1,'days'), moment().subtract(1,'days')],
                    'Last 7 Days': [moment().subtract(6,'days'), moment()],
                    'Last 30 Days': [moment().subtract(29,'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1,'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                  },
                  startDate: moment().subtract( 29,'days'),
                  endDate: moment()
                },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_square-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_square-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-red',
          radioClass: 'iradio_flat-red'
        });
 
      });
    </script>
    <script type="text/javascript">
      $(function () {
        $('#example1').dataTable({
        "scrollX": true
		});
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>	
  </body>
</html>
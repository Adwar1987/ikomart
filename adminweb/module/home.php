<?php
///include ("../inc/koneksi.php"); 
//include ("../inc/fungsi_hdt");  
?>
<br/>
<!--<div style="margin-right:10%;margin-left:15%" class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<p><i class="icon fa fa-info"></i>
Welcome <?php echo $_SESSION['nama']; ?>! &nbsp;&nbsp;
Anda berada di halaman "<?php echo $_SESSION['level']; ?>"
</p>
</div> -->
<div class="box box-solid box-info">
<div class="box-header">
<i class="fa fa-info"></i>Informasi
</div>
<div class="box-body">
<?php
if($_SESSION['dev']==1){
			
?>
<h4>Hak Akses sebagai Ikomart:</h4>
<li>Mengelola data Produk</li>
<li>Mengelola data Harga</li>
<li>Mengelola data Blog</li>
<li>Mengelola data Order Pesanan</li>

<?php
}elseif($_SESSION['dev']==2){		
?>
<h4>Hak Akses sebagai Mitra:</h4>
<li>Mengelola data Produk</li>
<li>Mengelola data Harga</li>
<?php
}
			
?>

</div>
</div><!-- /.row -->

 
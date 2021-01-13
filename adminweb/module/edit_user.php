<?php 
if($_SESSION['admin']!="1" ){ header("location: ../logout.php"); }
//include './inc/koneksi.php';
//echo $_SESSION['dev'];
if($_SESSION['dev'] == 1){
  if (isset($_POST['submit'])){
    if ((!empty($_POST['nama']))) {
      $sql = "UPDATE user SET user= '".$_POST['user']."',nama= '".$_POST['nama']."', pass = '".md5($_POST['pass'])."'  WHERE id_user = '$_GET[id_user]'";
      $simpan = mysqli_query($con,$sql);

      if ($simpan) {
      echo "<script>alert('Data Berhasil di Update');</script>";
      } else { 
      echo "<script>alert('Gagal Di Update');</script>";
      }
    }
  }

  $data=mysqli_query($con,"select * from user where id_user='$_GET[id_user]'");
  if (!$data)
  {exit("Error in SQL");}
  $edit=mysqli_fetch_array($data);
  $id_user = $edit['id_user'];
  $nama = $edit['nama'];
  $level = $edit['level'];
  $user = $edit['user'];
  $pass = $edit['pass'];
}elseif($_SESSION['dev'] ==2){
  if (isset($_POST['submit'])){
    if ((!empty($_POST['nama']))) {
      $sql = "UPDATE user_rekan SET user_rekan= '".$_POST['user']."',nama= '".$_POST['nama']."', pass = '".md5($_POST['pass'])."'  WHERE id_user_rekan = '$_GET[id_user]'";
      //echo  $sql;
      $simpan = mysqli_query($con,$sql);

      if ($simpan) {
      echo "<script>alert('Data Berhasil di Update');</script>";
      } else { 
      echo "<script>alert('Gagal Di Update');</script>";
      }
    }
  }
  
  $data=mysqli_query($con,"select * from user_rekan where id_user_rekan='$_GET[id_user]'");
  if (!$data)
  {exit("Error in SQL");}
  $edit=mysqli_fetch_array($data);
  $id_user = $edit['id_user_rekan'];
  $nama = $edit['nama'];
  $level = '1';
  $user = $edit['user_rekan'];
  $pass = $edit['pass'];
}

?>
<!----- ------------------------- EDIT DATA MASTER user ------------------------- ----->
<h3 class="box-title margin text-center">Edit Profil</h3>
<center> <div class="batas"> </div></center>
<br/>
<form class="form-horizontal" role="form" method="post">             
  <div class="form-group">
    <label class="col-sm-4 control-label">ID User </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_user" value="<?php echo $id_user; ?>" >
    </div>
  </div> 
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Lengkap</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama" value="<?php echo $nama; ?>">
    </div>
  </div>
	<div class="form-group">
    <label class="col-sm-4 control-label">Level </label>
    <div class="col-sm-5">
     <input type="text" class="form-control" readonly value="<?php echo $level; ?>">
    </div>
  </div>
<hr/>
<div class="form-group">
    <label class="col-sm-4 control-label">Username</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="user" value="<?php echo $user; ?>">
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-4 control-label">Password</label>
    <div class="col-sm-5">
      <input type="password" id="password1"class="form-control" required="required" name="pass" value="<?php echo $pass; ?>">
	  <a class="text-red">*ubah password secara berkala demi menjaga keamanan</a>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Konfirmasi Password</label>
    <div class="col-sm-5">
      <input type="password" id="password2"class="form-control" required="required">	  
    </div>
  </div>
  
  <script type="text/javascript">
window.onload = function () {
document.getElementById("password1").onchange = validatePassword;
document.getElementById("password2").onchange = validatePassword;
}
function validatePassword(){
var pass2=document.getElementById("password2").value;
var pass1=document.getElementById("password1").value;
if(pass1!=pass2)
document.getElementById("password2").setCustomValidity("Passwords Tidak Sama");
else
document.getElementById("password2").setCustomValidity('');}
</script>

	<div class="form-group">
    <label class="col-sm-4 control-label">  </label>
    <div class="col-sm-5">
<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<a href="javascript:history.back()" class="btn btn-info pull-right"><i class="fa fa-backward"></i> Kembali</a>	 
    </div>
  </div>   

</form>

<?php
function UploadImageResizejpeg($new_name,$file,$dir,$width){
   //direktori gambar
   $vdir_upload = $dir;
   $vfile_upload = $vdir_upload . $_FILES[''.$file.'']["name"];
   //echo $vfile_upload;

   //Simpan gambar dalam ukuran sebenarnya
   move_uploaded_file($_FILES[''.$file.'']["tmp_name"], $dir.$_FILES[''.$file.'']["name"]);
	
   //identitas file asli
   $im_src = imagecreatefromjpeg($vfile_upload);
   $src_width = imageSX($im_src);
   $src_height = imageSY($im_src);


   //Set ukuran gambar hasil perubahan
   if ($src_width > $width){
	   $dst_width = $width;
	   $dst_height = ($dst_width/$src_width)*$src_height;
   }else{
	   $dst_width = $src_width;
	   $dst_height = $src_height;
   }

   //proses perubahan ukuran
   $im = imagecreatetruecolor($dst_width,$dst_height);

     //to preserve PNG transparency
  //saving all full alpha channel information
  imagesavealpha($im, true);
  //setting completely transparent color
  $transparent = imagecolorallocatealpha($im, 0, 0, 0, 127);
  $white = imagecolorallocate($im, 255, 255, 255);
  //filling created image with transparent color
  imagefill($im, 0, 0, $white);

  if ($dst_height < 410 ){
    imagecopyresampled($im, $im_src, 30, 30, 0, 0, $dst_width - 60 , $dst_height - 60, $src_width, $src_height);
  }else{
    imagecopyresampled($im, $im_src, 60, 60, 0, 0, $dst_width - 120, $dst_height -120 , $src_width, $src_height);
  }

     //get watermark
  $opath = "../../../img/wmark.png";
  //echo $opath;
  //get watermark size
  $size2 = getimagesize($opath);
  $owidth = $size2[0];
  $oheight = $size2[1];
  $osource = imagecreatefrompng($opath);

    imagecopyresampled($im, $osource, 0, 0, 0, 0, $dst_width, $dst_height, $owidth, $oheight );
  
   //Simpan gambar
   imagejpeg($im,$vdir_upload . $new_name,80);
   
   //Hapus gambar di memori komputer
   imagedestroy($im_src);
   imagedestroy($im);
   imagedestroy($osource);
   $remove_small = unlink("$vfile_upload");
 }
 
 function UploadImageResizepng($new_name,$file,$dir,$width){
   //direktori gambar
   $vdir_upload = $dir;
   $vfile_upload = $vdir_upload . $_FILES[''.$file.'']["name"];

   //Simpan gambar dalam ukuran sebenarnya
   move_uploaded_file($_FILES[''.$file.'']["tmp_name"], $dir.$_FILES[''.$file.'']["name"]);
	
   //identitas file asli
   $im_src = imagecreatefrompng($vfile_upload);
   $src_width = imageSX($im_src);
   $src_height = imageSY($im_src);

   //Set ukuran gambar hasil perubahan
   if ($src_width > $width){
	   $dst_width = $width;
	   $dst_height = ($dst_width/$src_width)*$src_height;
   }else{
	   $dst_width = $src_width;
	   $dst_height = $src_height;
   }

   //proses perubahan ukuran
   $im = imagecreatetruecolor($dst_width,$dst_height);
  // imagealphablending($im, false);
  //to preserve PNG transparency
  //saving all full alpha channel information
  imagesavealpha($im, true);
  //setting completely transparent color
  $transparent = imagecolorallocatealpha($im, 0, 0, 0, 127);
  $white = imagecolorallocate($im, 255, 255, 255);
  //filling created image with transparent color
  imagefill($im, 0, 0, $white);
   
   if ($dst_height < 410 ){
    imagecopyresampled($im, $im_src, 30, 30, 0, 0, $dst_width - 60 , $dst_height - 60, $src_width, $src_height);
  }else{
    imagecopyresampled($im, $im_src, 60, 60, 0, 0, $dst_width - 120, $dst_height -120 , $src_width, $src_height);
  }
   
  // imagesavealpha($im, true);
   
   //get watermark
  $opath = "../../../img/wmark.png";
  //echo $opath;
  //get watermark size
  $size2 = getimagesize($opath);
  $owidth = $size2[0];
  $oheight = $size2[1];
  $osource = imagecreatefrompng($opath);
  imagecopyresampled($im, $osource, 0, 0, 0, 0, $dst_width , $dst_height , $owidth, $oheight );

   //Simpan gambar
   imagepng($im,$vdir_upload . $new_name,9);
   
   //Hapus gambar di memori komputer
   imagedestroy($im_src);
   imagedestroy($im);
   $remove_small = unlink("$vfile_upload");
 }
 
 function UploadImageResizegif($new_name,$file,$dir,$width){
   //direktori gambar
   $vdir_upload = $dir;
   $vfile_upload = $vdir_upload . $_FILES[''.$file.'']["name"];

   //Simpan gambar dalam ukuran sebenarnya
   move_uploaded_file($_FILES[''.$file.'']["tmp_name"], $dir.$_FILES[''.$file.'']["name"]);
	
   //identitas file asli
   $im_src = imagecreatefromgif($vfile_upload);
   $src_width = imageSX($im_src);
   $src_height = imageSY($im_src);

   //Set ukuran gambar hasil perubahan
   if ($src_width > $width){
	   $dst_width = $width;
	   $dst_height = ($dst_width/$src_width)*$src_height;
   }else{
	   $dst_width = $src_width;
	   $dst_height = $src_height;
   }

   //proses perubahan ukuran
   $im = imagecreatetruecolor($dst_width,$dst_height);

     //to preserve PNG transparency
  //saving all full alpha channel information
  imagesavealpha($im, true);
  //setting completely transparent color
  $transparent = imagecolorallocatealpha($im, 0, 0, 0, 127);
  $white = imagecolorallocate($im, 255, 255, 255);
  //filling created image with transparent color
  imagefill($im, 0, 0, $white);

  if ($dst_height < 410 ){
    imagecopyresampled($im, $im_src, 30, 30, 0, 0, $dst_width - 60 , $dst_height - 60, $src_width, $src_height);
  }else{
    imagecopyresampled($im, $im_src, 60, 60, 0, 0, $dst_width - 120, $dst_height -120 , $src_width, $src_height);
  }

   //get watermark
  $opath = "../../../img/wmark.png";
  //echo $opath;
  //get watermark size
  $size2 = getimagesize($opath);
  $owidth = $size2[0];
  $oheight = $size2[1];
  $osource = imagecreatefrompng($opath);
  imagecopyresampled($im, $osource, 0, 0, 0, 0, $dst_width, $dst_height, $owidth, $oheight );

   //Simpan gambar
   imagegif($im,$vdir_upload . $new_name);
   
   //Hapus gambar di memori komputer
   imagedestroy($im_src);
   imagedestroy($im);
   $remove_small = unlink("$vfile_upload");
 }
 
 function resize($new_name, $file, $imgpath, $width, $height){
    /* Get original image x y*/
    list($w, $h) = getimagesize($file['tmp_name']);
    /* calculate new image size with ratio */
    $ratio = max($width/$w, $height/$h);
    $h = ceil($height / $ratio);
    $x = ($w - $width / $ratio) / 2;
    $w = ceil($width / $ratio);

    /* new file name */
    $path = $imgpath;
    /* read binary data from image file */
    $imgString = file_get_contents($file['tmp_name']);
    /* create image from string */
    $image = imagecreatefromstring($imgString);
    $tmp = imagecreatetruecolor($width, $height);
    imagecopyresampled($tmp, $image, 0, 0, $x, 0, $width, $height, $w, $h);
    /* Save image */
    switch ($file['type']) {
       case 'image/jpeg':
          imagejpeg($tmp, $path. $new_name, 100);
          break;
       case 'image/jpg':
          imagejpeg($tmp, $path. $new_name, 100);
          break;
       case 'image/png':
          imagepng($tmp, $path. $new_name, 9);
          break;
       case 'image/gif':
          imagegif($tmp, $path. $new_name);
          break;
          default:
          //exit;
          break;
        }
     return $path;

     /* cleanup memory */
     imagedestroy($image);
     imagedestroy($tmp);
}
?>
<?php
	$folder = "image/blog/";
	if($vb == 'm') {
			$folder = "../image/blog/";
	}
	//echo $folder;
	$id_berita = "";
	if(isset($_GET['id_berita'])){
		$id_berita = $_GET['id_berita'];
		
	if (is_numeric($id_berita)) { 

	$qb = mysqli_query($con, "
	select
		a.id_berita, a.judul, a.sum, a.sumber, a.tanggal, a.link, a.isi,a.img
	from mst_berita a
	where a.id_berita = $id_berita
	");
	$rb = mysqli_fetch_array($qb);
?>						
			<div class="white-box">
						<h3>
						<small>
							<font class="index_kecil_berita"><?php echo nama_hari($rb['tanggal']).", ".Indonesia2Tgl($rb['tanggal']);?> | </font><a href="<?=$rb['link']?>" target="blank"class="index_kecil_sumber"><?=$rb['sumber']?></a><br>
						</small>
						<a class="index_judul_berita" href="<?=$rb['link']?>" target="blank"><?=$rb['judul']?></a></h3>
				<div style="padding: 0 10px; float: left; margin-bottom: 20px; position: relative; min-height: 1px;">
					<img border="0" style="width:450px; height:250px;" src="<?php echo $folder.$rb['img']?>">
				</div>
                <div >
<?php
/*
						<p align="justify" class="bc_isi_berita"><?=$rb['isi']?></p>
*/
					$isi = $rb['isi'];
					// memecah string input berdasarkan karakter '\r\n\r\n'
					$pecah = explode("\r\n\r\n", $isi);
					// string kosong inisialisasi
					$text = "";
					// untuk setiap substring hasil pecahan, sisipkan <p> di awal dan </p> di akhir
					// lalu menggabungnya menjadi satu string utuh $text
					for ($i=0; $i<=count($pecah)-1; $i++)
					{
						$part = str_replace($pecah[$i], "<p align=\"justify\" class=\"p\">".$pecah[$i]."</p>", $pecah[$i]);
						$text .= $part;
					}
					echo $text;
}
?>
				</div><!-- .wb-content -->
            </div><!-- .white-box -->
			
<?php
}
$id_galeri = "";
if(isset($_GET['id_galeri'])){
	$id_galeri = $_GET['id_galeri'];
	
if (is_numeric($id_galeri)) { 

$qb = mysqli_query($con, "
select
	a.id_galeri, a.judul, a.tanggal, a.folder,  a.tanggal, a.id_tgl, a.ket
from mst_galeri a 
where a.id_galeri = $id_galeri
");
$rb = mysqli_fetch_array($qb);
?>						
							<table width="100%" cellpadding="">
								<tr valign="top">
									<td width="100%">
										<center><font class="index_kecil_berita">
										<?php echo nama_hari($rb['tanggal']).", ".Indonesia2Tgl($rb['tanggal']);?>
							</font><br>
										<h1><?=$rb['judul']?></h1></center>
									</td>
								</tr>
								<tr valign="top">
									<td>
										<center>
											<div class="w3-content w3-display-container">
											<?php
											$qf = mysqli_query($con, "
											select
												a.foto
											from mst_galeri_foto a
											where a.id_galeri = '$id_galeri'
											");
											while($rf = mysqli_fetch_array($qf))
											{
?>
												<img class="mySlides" src="<?php $rb['folder']?>/<?=$rf['foto']?>" width="600">
											<?php
											}
											
?>
											<button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
											<button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
											<script>
											var slideIndex = 1;
											showDivs(slideIndex);
											function plusDivs(n) 
											{
												showDivs(slideIndex += n);
											}
											function showDivs(n) {
												var i;
												var x = document.getElementsByClassName("mySlides");
												if (n > x.length) {slideIndex = 1}    
												if (n < 1) {slideIndex = x.length}
												for (i = 0; i < x.length; i++) {
													x[i].style.display = "none";  
												 }
												x[slideIndex-1].style.display = "block";  
											}
											</script>
											</div>
									</center>
								</td>
							</tr>
							<tr valign="top">
								<td >
										<center>
										<br>
										<?=$rb['ket']?></center>
								</td>
							</tr>
						</table>
<?php
	}
}
$id_video = "";
if(isset($_GET['id_video'])){
	$id_video = $_GET['id_video'];
	
if (is_numeric($id_video)) { 

$qb = mysqli_query($con, "
select	a.id_video, a.judul, a.folder, a.link, a.tanggal
from mst_video	a
where a.id_video = $id_video
");
$rb = mysqli_fetch_array($qb);
?>						
							<table width="100%" cellpadding="">
								<tr valign="top">
									<td width="100%">
										<center><font class="index_kecil_berita">
										<?php echo nama_hari($rb['tanggal']).", ".Indonesia2Tgl($rb['tanggal']);?>
							</font><br>
										<h1><?=$rb['judul']?></h1></center>
									</td>
								</tr>
								<tr valign="top">
									<td>
										<center>
											<div class="w3-content w3-display-container">
											<iframe style="width:100%;height:500px" src="https://www.youtube.com/embed/<?php echo $rb['link'];?>" frameborder="0" allowfullscreen></iframe>
											
											</div>
									</center>
								</td>
							</tr>
							<tr valign="top">
								<td >
										<center>
										<br>
										<?=$rb['sum']?></center>
								</td>
							</tr>
						</table>
<?php
	}
}
?>
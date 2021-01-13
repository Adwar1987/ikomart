<script src="./aset/plugins/jQuery/jQuery-2.1.4.min.js"></script> 
<script type="text/javascript" >
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": false,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>

<section class="sbanner-section">
        <div class="breadcrumbs">
            <div class="main-container">
                <ul>
                    <li><a href="?module=home" class="bc-home"><span>Beranda</span></a></li>
                    <li class="bc-middle">Info Berita & Kegiatan</li>
                    <li class="bc-dots">...</li>
					<li class="bc-last">Galeri</li>
                </ul>
            </div><!-- .main-container -->
        </div><!-- .breadcrumbs -->
    </section><!-- .sbanner-section -->

    <section class="section spad">
        <div class="main-container">
            <div class="container">
			<?php
				include 'bc.php';
			?>
                <div class="box-body">
				<table id="example2" class="table table-bordered table-striped">
			<thead>
				<tr class="text-green">
					<th></th> 
				</tr>
			</thead>

			<tbody>
			<?php 
			//include "./inc/inc.library.php";
			// Tampilkan data dari Database
			$sql = "SELECT * from mst_galeri order by tanggal desc";
			//echo $sql;
			$tampil = mysqli_query($con,$sql);
			if (!$tampil)
			{exit("Error in SQL");}
			$no=1;
			while ($data = mysqli_fetch_array($tampil)) { 
			$Kode = $data['id_galeri'];
			?>

				<tr><td>
				<div class="grid-child f-768-1per2 f-no-margin">
					<img class="img-wrap square-service" border="0" style="width:100%; height:160px;" src="<?php echo './img/galeri/'.$data['folder'].'/'.$data['foto_kecil'];?>">
				</div>
                <div>
				<?php echo "<b>".$data['judul']."</b>"."<br>";
				$sqlcek ="select
					a.id_galeri, a.judul, a.ket,
					b.nm_tgl, c.nm_bln, a.thn, d.nm_hr
				from mst_galeri a
				left join mst_tgl b on b.id_tgl = a.id_tgl
				left join mst_bln c on c.id_bln = a.id_bln
				left join mst_hr d on d.id_hr = a.id_hr
				where a.id_galeri = '$Kode'";
				//echo $sqlcek."<br>";
				$qb = mysqli_query($con,$sqlcek );         
				$rb = mysqli_fetch_array($qb);     
				if ( $rb['thn'] > 0 ){
														 
					echo "<u>".$rb['nm_hr'].", ".$rb['nm_tgl']." ".$rb['nm_bln']." ".$rb['thn']."</u><br>";                       
				}else{ 

					echo "<u>".nama_hari($data['tanggal']).", ".Indonesia2Tgl($data['tanggal'])."</u><br>";
				}
				echo  $data['ket']; 
				?>
				</div>
                <div>
				<a href="?module=galeri&file=bc&id_galeri=<?=$rb['id_galeri']?>" class="btn btn-rounded btn-red">Detail</a>
				</div>
				</td>
				<?php
				$no =$no + 1;
				}
				?>
				</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
                            </div>
        </div><!-- .main-container -->
    </section><!-- .section -->

   
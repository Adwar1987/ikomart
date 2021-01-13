	function addcart(id_produk, nama_produk){
	var etoken=$('#etoken').val();
	//alert(etoken);
	 if (id_produk=="") {
			//$('#tabel_cari').hide();
		}else{
			//alert(id_produk); 
			$.ajax({
				url:'cart/index.php',
				type:'POST',
				dataType:'html',
				data:{'action': 'addiko', 'id_produk': id_produk, 'etoken': etoken, 'quantity':'1'},
				success:function (respons) {
					//alert(respons);
					alert(nama_produk + " ditambahkan ke keranjang"); 
					$('#data_cart').html(respons);
					//$('#etoken').val(etoken);
					//alert(etoken);
					/*$('#cart_sum').load(window.location.href +  './cart/index.php');*/
					$( '#cart_sum' ).load('./cart/jml_cart.php');
				}, 
			})  
		/*jml_cart();*/
		}
	}

	function addcart2(id_produk, nama_produk){
	var etoken=$('#etoken').val();
	//alert(etoken);
	 if (id_produk=="") {
			//$('#tabel_cari').hide();
		}else{
			//alert(id_produk); 
			$.ajax({
				url:'../cart/index.php',
				type:'POST',
				dataType:'html',
				data:{'action': 'addiko', 'id_produk': id_produk, 'etoken': etoken, 'quantity':'1'},
				success:function (respons) {
					//alert(respons);
					alert(nama_produk + " ditambahkan ke keranjang"); 
					$('#data_cart').html(respons);
					//$('#etoken').val(etoken);
					//alert(etoken);
					$( '#cart_sum' ).load('../cart/jml_cart.php');
				}, 
			})  
		/*jml_cart();*/
		}
	}


	function delcart(id_produk){
	var etoken=$('#etoken').val();
	/*alert('tes2'); */
	 if (id_produk=="") {
		//$('#tabel_cari').hide();
		}else{
			//alert(id_produk); 
			$.ajax({
				url:'cart/index.php',
				type:'POST',
				dataType:'html',
				data:{'action': 'remove','id_produk': id_produk, 'etoken': etoken},
				success:function (respons) {
					//alert(respons);
					$('#data_cart').html(respons);
					$( '#cart_sum' ).load('./cart/jml_cart.php');
				},	 
			})  
			//jml_cart();
		}
	}
	
	function delcart2(id_produk){
	var etoken=$('#etoken').val();
	/*alert('tes2'); */
	 if (id_produk=="") {
		//$('#tabel_cari').hide();
		}else{
			//alert(id_produk); 
			$.ajax({
				url:'../cart/index.php',
				type:'POST',
				dataType:'html',
				data:{'action': 'remove','id_produk': id_produk, 'etoken': etoken},
				success:function (respons) {
					//alert(respons);
					$('#data_cart').html(respons);
					$( '#cart_sum' ).load('../cart/jml_cart.php');
				},	 
			})  
			//jml_cart();
		}
	}

	function delallcart(){
		var etoken=$('#etoken').val();
	/*alert('tes2'); */
		//alert(id_produk); 
		$.ajax({
			url:'cart/index.php',
			type:'POST',
			dataType:'html',
			data:{'action': "empty",'etoken': etoken},
			success:function (respons) {
				//alert(respons);
				$('#data_cart').html(respons);
				$( '#cart_sum' ).load('./cart/jml_cart.php');
			}, 
		})  
		//jml_cart();
		location.href = "?module=home";

	}
	
	function delallcart2(){
		var etoken=$('#etoken').val();
	/*alert('tes2'); */
		//alert(id_produk); 
		$.ajax({
			url:'../cart/index.php',
			type:'POST',
			dataType:'html',
			data:{'action': "empty",'etoken': etoken},
			success:function (respons) {
				//alert(respons);
				$('#data_cart').html(respons);
				$( '#cart_sum' ).load('../cart/jml_cart.php');
			}, 
		})  
		//jml_cart();
		location.href = "?module=home";

	}

/*	function newcart(){
		var etoken=$('#etoken').val();
		//alert(id_produk); 
		$.ajax({
			url:'cart/index.php',
			type:'POST',
			dataType:'html',
			data:{'action': "new",'etoken': etoken},
			success:function (respons) {
				alert(respons);
				$('#data_cart').html(respons);
			}, 
		})  
		jml_cart();
		location.href = "?module=home";

	}*/

	function upcart(id_produk,quantity){
		var etoken=$('#etoken').val();
		//alert(etoken); 
	 if (id_produk=="") {
			//$('#tabel_cari').hide();
		}else{
			//alert(id_produk); 
			$.ajax({
				url:'cart/index.php',
				type:'POST',
				dataType:'html',
				data:{'action': 'upiko', 'id_produk': id_produk, 'etoken': etoken, 'quantity': quantity},
				success:function (respons) {
					//alert(respons);
					$('#data_cart').html(respons);
					$( '#cart_sum' ).load('./cart/jml_cart.php');
				}, 
			})  
		//jml_cart();
		}
	}
	
	function upcart2(id_produk,quantity){
	var etoken=$('#etoken').val();
		//alert(etoken); 
	 if (id_produk=="") {
			//$('#tabel_cari').hide();
		}else{
			//alert(id_produk); 
			$.ajax({
				url:'../cart/index.php',
				type:'POST',
				dataType:'html',
				data:{'action': 'upiko', 'id_produk': id_produk, 'etoken': etoken, 'quantity': quantity},
				success:function (respons) {
					//alert(respons);
					$('#data_cart').html(respons);
					$( '#cart_sum' ).load('./cart/jml_cart.php');
				}, 
			})  
		//jml_cart();
		}
	}

	function jml_cart(){
		var etoken=$('#etoken').val();
		//alert(etoken); 
		$.ajax({
				url:'cart/jml_cart.php',
				type:'POST',
				dataType:'html',
				data:{ 'etoken': etoken},
				success:function (respons) {
					//alert(respons);
					$('#cart_sum').html(respons);
				}, 
			})  
	}

	Number.prototype.numberFormat = function(decimals, dec_point, thousands_sep) {
	    dec_point = typeof dec_point !== 'undefined' ? dec_point : '.';
	    thousands_sep = typeof thousands_sep !== 'undefined' ? thousands_sep : ',';

	    var parts = this.toFixed(decimals).split('.');
	    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);

	    return parts.join(dec_point);
	}


	/*function hitung(tableID) {
		try {
		   var table = document.getElementById(tableID);
		   var total2 = 0;
		   var rowCount = table.rows.length;
		   //alert(rowCount);
		   for(var i=1; i<rowCount - 1; i++) {
			var row = table.rows[i];
			//alert(row);
			var id_produk = row.cells[1].childNodes[1].value;
			//alert(id_produk);
			var harga = row.cells[2].childNodes[1].value;
			var jml = row.cells[3].childNodes[1].value;
			//alert(harga);
			var total  = harga * jml;
			total2  = total2 +  total;
			row.cells[4].childNodes[1].value= total.numberFormat(0, ',', '.');

			upcart(id_produk,jml);
			//alert(total);
		   }
		   $('#total').val("Rp. " + total2.numberFormat(0, ',', '.'));
			$('#total2').html("Rp. " + total2.numberFormat(0, ',', '.'));
			//hitung()
			
		   }catch(e) {
			alert(e);
		   }
	  }
	  */

	function hitung_tagihan() {
		var e = document.getElementById("id_kirim");
    	var option= e.options[e.selectedIndex];
    	var id_kirim2 = option.getAttribute("data-id_kirim");
		var sberat= $('#tberat').val();
		var berat = parseInt(sberat.replace(".", ""));
		var cberat = parseInt(sberat.substring(sberat.length -3));
		//alert(cberat);
		var stotal = $('#total').val();
		var total = parseInt(stotal.replace(".", ""));
		var sbiaya_handling = $('#biaya_handling').val();
		var biaya_handling = 0;
		if (sbiaya_handling) {
		    biaya_handling = parseInt(sbiaya_handling.replace(".", ""));
		}
		//alert(id_kirim2);
		if(id_kirim2 =='1'){
			biaya_handling = 0;
		}
		var songkos = $('#songkos').val();
		
		var ongkos = 0;
		if(berat>1000){
			 if(cberat>300){
		   	 	ongkos = (Math.ceil(berat/1000)* parseInt(songkos.replace(".", "")) );
		   	}else{
		   		ongkos = (Math.floor(berat/1000)* parseInt(songkos.replace(".", "")) );
		   	}
		   }else{
		   	ongkos = 1* parseInt(songkos.replace(".", ""));
		   }
		if(id_kirim2 =='1'){
			ongkos = 1* parseInt(songkos.replace(".", ""));
		}
		
		//alert(ongkos);
		var total_bayar= total + biaya_handling + ongkos;
		//alert(total_bayar);
		$('#biaya_handling').val(biaya_handling.numberFormat(0, ',', '.'));
		$('#ongkos').val(ongkos.numberFormat(0, ',', '.'));
		$('#total_bayar').val(total_bayar);
		$('#total_bayar2').val(total_bayar.numberFormat(0, ',', '.'));
		document.getElementById("group_ongkos").style.display = "block"
       	document.getElementById("group_tagihan").style.display = "block"
	 }


	function hitung2(tableID) {
		  try {
		   var table = document.getElementById(tableID);
		   var total2 = 0;
		   var tberat = 0;
		   var rowCount = table.rows.length;
		   //alert(rowCount);
		   for(var i=1; i<rowCount - 1; i++) {
			var row = table.rows[i];
			//alert(row);
			var id_produk = row.cells[1].childNodes[1].value;
			//alert(id_produk);
			var harga = row.cells[2].childNodes[1].value;
			var jml = row.cells[3].childNodes[1].value;
			var berat = row.cells[4].childNodes[1].value;
			var berat2 = row.cells[4].childNodes[3].value;
			//alert(berat2);
			var total  = harga * jml;
			total2  = total2 +  total;

			var sberat  = berat * jml;
			tberat  = tberat + sberat;

			row.cells[4].childNodes[3].value= sberat.numberFormat(0, ',', '.');
			row.cells[5].childNodes[1].value= total.numberFormat(0, ',', '.');

			upcart(id_produk,jml);
			//alert(tberat);
		   }
		   var bhandling = 0;
		   //if(tberat>5000){
		   	 bhandling = (Math.ceil(tberat/5000)) * 2500;
		   //}
		   
		   $('#total').val(total2);
		   $('#tberat').val(tberat.numberFormat(0, ',', '.'));
		   $('#biaya_handling').val(bhandling.numberFormat(0, ',', '.'));
			$('#total2').html("Rp. " + total2.numberFormat(0, ',', '.'));
			hitung_tagihan();
			
		   }catch(e) {
			alert(e);
		   }
	  }

	  function Comma(Num) { //function to add commas to textboxes
        Num += '';
		Num = Num.replace(/[^\d]+/g, '');
        Num = Num.replace('.', ''); 
        x = Num.split(',');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        return x1 + x2;
    }
	  function ambildata_negara() {
			var negara=$('#negara').val();
			//alert(negara);
			 if (negara == "Indonesia") {  /*kode indonesia*/
			 	//	alert(negara);
				$.ajax({
					url:'module/get_wilayah.php',
					type:'GET',
					dataType:'html',
					data:'negara='+negara,
					success:function (respons) {
						//alert(respons);
						var hasil = respons.split('|');
						$('#listprovinsi').html(hasil[1]);
						$('#songkos').val("0");
						//hitung_tagihan();
						$('#id_kirim').html('<option value="  data-id_kirim="0" selected> -- Pilih Pengiriman -- </option>');
						$('#id_kirim').val("");
						$('#via_kirim').val("");
						hitung_tagihan();
					}, 
					
				})  
				$('#listkab').html("");
				$('#listkec').html("");
				$('#listkel').html("");
			}else{
				$.ajax({
					url:'module/get_wilayah.php',
					type:'GET',
					dataType:'html',
					data:'negara='+negara,
					success:function (respons) {
						//alert(respons);
						var hasil = respons.split('|');
						//$('#listprovinsi').html(respons[1]);
						//alert(respons[0]);
						$('#songkos').val(hasil[0]);
						
						$('#id_kirim').html(hasil[2]);
						$('#id_kirim').val("DHL Express");
						$('#via_kirim').val("DHL Express");
						hitung_tagihan();

						
					}, 
					
				})  
				$('#provinsi').val("");
				$('#kabupaten').val("");
				$('#kecamatan').val("");
				$('#kelurahan').val("");
				$('#listprovinsi').html("");
				$('#listkab').html("");
				$('#listkec').html("");
				$('#listkel').html("");
			} 
		}

	function ambildata_negara2() {
		var negara=$('#negara').val();
			//alert(negara);
			 if (negara == "Indonesia") {  /*kode indonesia*/
			 	//	alert(negara);
				$.ajax({
					url:'module/get_wilayah.php',
					type:'GET',
					dataType:'html',
					data:'negara='+negara,
					success:function (respons) {
						//alert(respons);
						var hasil = respons.split('|');
						$('#listprovinsi').html(hasil[1]);
						$('#songkos').val("0");
						//hitung_tagihan();
						$('#id_kirim').html('<option value="" data-id_kirim="0" selected> -- Pilih Pengiriman -- </option>');
						$('#id_kirim').val("");
						$('#via_kirim').val("");
						hitung_tagihan();
					}, 
					
				})  
				$('#listkab').html("");
				$('#listkec').html("");
				$('#listkel').html("");
			}else{
				$.ajax({
					url:'../module/get_wilayah.php',
					type:'GET',
					dataType:'html',
					data:'negara='+negara,
					success:function (respons) {
						//alert(respons);
						var hasil = respons.split('|');
						//$('#listprovinsi').html(respons[1]);
						//alert(respons[0]);
						$('#songkos').val(hasil[0]);
						
						$('#id_kirim').html(hasil[2]);
						$('#id_kirim').val("DHL Express");
						$('#via_kirim').val("DHL Express");
						hitung_tagihan();

						
					}, 
					
				})  
				$('#provinsi').val("");
				$('#kabupaten').val("");
				$('#kecamatan').val("");
				$('#kelurahan').val("");
				$('#listprovinsi').html("");
				$('#listkab').html("");
				$('#listkec').html("");
				$('#listkel').html("");
			} 
		}

	  function ambildata_prov() {
			var provinsi=$("#provinsi").val();
		   	var value = $('#listprovinsi option').filter(function() {
		     return this.value == provinsi;
		   	}).data('value');
		  	var msg = value ? value : '';
			//alert(msg);
			// var e = document.getElementById("id_kirim");
   //  		var option= e.options[e.selectedIndex];
   //  		var id_kirim = option.getAttribute("data-id_kirim");
			//alert(id_kirim);
			if (msg=="") {
				//$('#tabel_cari').hide();
			}else{
				$.ajax({
					url:'module/get_wilayah.php',
					type:'GET',
					dataType:'html',
					data:{'provinsi': msg},
					success:function (respons) {
						//alert(respons);
						$('#listkab').html(respons);
					}, 
					 
				})  
			} 
			$('#kabupaten').val("");
			$('#kecamatan').val("");
			$('#kelurahan').val("");
			$('#listkec').html("");
			$('#listkel').html("");
		}
		
		function ambildata_prov2() {
			var provinsi=$("#provinsi").val();
		   	var value = $('#listprovinsi option').filter(function() {
		     return this.value == provinsi;
		   	}).data('value');
		  	var msg = value ? value : '';
			//alert(msg);
			/*var e = document.getElementById("id_kirim");
    		var option= e.options[e.selectedIndex];
    		var id_kirim = option.getAttribute("data-id_kirim");*/
			//alert(id_kirim);
			if (msg=="") {
				//$('#tabel_cari').hide();
			}else{
				$.ajax({
					url:'../module/get_wilayah.php',
					type:'GET',
					dataType:'html',
					data:{'provinsi': msg},
					success:function (respons) {
						//alert(respons);
						$('#listkab').html(respons);
					}, 
					
				})  
			} 

			$('#kabupaten').val("");
			$('#kecamatan').val("");
			$('#kelurahan').val("");
			$('#listkec').html("");
			$('#listkel').html("");
		}

		function ambildata_kab() {
			var negara=$('#negara').val();
			var kabupaten=$('#kabupaten').val();
			var value = $('#listkab option').filter(function() {
		     return this.value == kabupaten;
		   	}).data('value');
		  	var msg = value ? value : '';
			//alert(msg);
			// var e = document.getElementById("id_kirim");
   //  		var option= e.options[e.selectedIndex];
   //  		var id_kirim = option.getAttribute("data-id_kirim");
			//alert(id_kirim);
			if (msg=="") {
				if (negara == "Indonesia") {  /*kode indonesia*/
					$.ajax({
						url:'module/get_wilayah.php',
						type:'GET',
						dataType:'html',
						data:{'kabupaten2': kabupaten},
						success:function (respons) {
							//alert(respons);
							var hasil = respons.split('|');
							$('#listkec').html(hasil[0]);
							//('#id_kirim').html(hasil[1]);
						}, 
						
					})  
				}
			}else{
				$.ajax({
					url:'module/get_wilayah.php',
					type:'GET',
					dataType:'html',
					data:{'kabupaten': msg},
					success:function (respons) {
						//alert(respons);
						var hasil = respons.split('|');
						$('#listkec').html(hasil[0]);
						$('#id_kirim').html(hasil[1]);
					}, 
					
				})  
			} 
			$('#kecamatan').val("");
			$('#kelurahan').val("");
			$('#listkel').html("");
		}

		function ambildata_kab2() {
			var negara=$('#negara').val();
			var kabupaten=$('#kabupaten').val();
			var value = $('#listkab option').filter(function() {
		     return this.value == kabupaten;
		   	}).data('value');
		  	var msg = value ? value : '';
			//alert(msg);
			// var e = document.getElementById("id_kirim");
   //  		var option= e.options[e.selectedIndex];
   //  		var id_kirim = option.getAttribute("data-id_kirim");
			//alert(id_kirim);
			if (msg=="") {
				if (negara == "Indonesia") {  /*kode indonesia*/
					$.ajax({
						url:'../module/get_wilayah.php',
						type:'GET',
						dataType:'html',
						data:{'kabupaten2': kabupaten},
						success:function (respons) {
							//alert(respons);
							var hasil = respons.split('|');
							$('#listkec').html(hasil[0]);
							//$('#id_kirim').html(hasil[1]);
						}, 
						
					})  
				}
			}else{
				$.ajax({
					url:'../module/get_wilayah.php',
					type:'GET',
					dataType:'html',
					data:{'kabupaten': msg},
					success:function (respons) {
						//alert(respons);
						var hasil = respons.split('|');
						$('#listkec').html(hasil[0]);
						$('#id_kirim').html(hasil[1]);
					}, 
					
				})  
			} 
			$('#kecamatan').val("");
			$('#kelurahan').val("");
			$('#listkel').html("");
		}


		function ambildata_kec() {
			var kecamatan=$('#kecamatan').val();
			var value = $('#listkec option').filter(function() {
		     return this.value == kecamatan;
		   	}).data('value');
		  	var msg = value ? value : '';

		  	var e = document.getElementById("id_kirim");
    		var option= e.options[e.selectedIndex];
    		var id_kirim = option.getAttribute("data-id_kirim");

			//alert(kecamatan);
			 if (msg=="") {
				//$('#tabel_cari').hide();
			}else{
				$.ajax({
				url:'module/get_wilayah.php',
				type:'GET',
				dataType:'html',
				data:'kecamatan='+msg,
				success:function (respons) {
					$('#listkel').html(respons);
				}, 
			})  
			} 
			$('#kelurahan').val("");
		}

		function ambildata_kec2() {
			var kecamatan=$('#kecamatan').val();
			var value = $('#listkec option').filter(function() {
		     return this.value == kecamatan;
		   	}).data('value');
		  	var msg = value ? value : '';

		  	var e = document.getElementById("id_kirim");
    		var option= e.options[e.selectedIndex];
    		var id_kirim = option.getAttribute("data-id_kirim");
			//alert(kecamatan);
			 if (msg=="") {
				//$('#tabel_cari').hide();
			}else{
				$.ajax({
				url:'../module/get_wilayah.php',
				type:'GET',
				dataType:'html',
				data:'kecamatan='+msg,
				success:function (respons) {
					$('#listkel').html(respons);
				}, 
			})  
			} 
			$('#kelurahan').val("");
		}

function ambildata_kirim() {
	var negara=$('#negara').val();
	var kabupaten=$('#kabupaten').val();
	var id_kab = $('#listkab option').filter(function() {
		return this.value == kabupaten;
		}).data('value');
	var id_kab = id_kab ? id_kab : '';
	var kelurahan=$('#kelurahan').val();
	var id_kel = $('#listkel option').filter(function() {
		return this.value == kelurahan;
		}).data('value');
	var id_kel = id_kel ? id_kel : '';

		//alert(via_bayar);
	if (id_kel=="") {
		if (negara == "Indonesia") {  /*kode indonesia*/
			$.ajax({
				url:'module/get_wilayah.php',
				type:'GET',
				dataType:'html',
				data:{'kelurahan2': kelurahan},
				success:function (respons) {
					//alert(respons);
					$('#id_kirim').html(respons);
				}, 	
			})  
		}
	}else{
		$.ajax({
			url:'module/get_wilayah.php',
			type:'GET',
			dataType:'html',
			data:{'kelurahan': id_kel, 'id_kab': id_kab, 'kabupaten3': kabupaten},
			success:function (respons) {
				//alert(respons);
				$('#id_kirim').html(respons);
			}, 
		}) 
	}

}

function ambildata_kirim2() {
	var negara=$('#negara').val();
	var kabupaten=$('#kabupaten').val();
	var id_kab = $('#listkab option').filter(function() {
		return this.value == kabupaten;
		}).data('value');
	var id_kab = id_kab ? id_kab : '';
	var kelurahan=$('#kelurahan').val();
	var id_kel = $('#listkel option').filter(function() {
		return this.value == kelurahan;
		}).data('value');
	var id_kel = id_kel ? id_kel : '';

		//alert(via_bayar);
	if (id_kel=="") {
		if (negara == "Indonesia") {  /*kode indonesia*/
			$.ajax({
				url:'../module/get_wilayah.php',
				type:'GET',
				dataType:'html',
				data:{'kelurahan2': kelurahan},
				success:function (respons) {
					//alert(respons);
					$('#id_kirim').html(respons);
				}, 	
			})  
		}
	}else{
		$.ajax({
			url:'../module/get_wilayah.php',
			type:'GET',
			dataType:'html',
			data:{'kelurahan': id_kel, 'id_kab': id_kab, 'kabupaten3': kabupaten},
			success:function (respons) {
				//alert(respons);
				$('#id_kirim').html(respons);
			}, 
		}) 
	}

}

function ambildata_ongkos() {
	var kabupaten=$('#kabupaten').val();
		var id_kab = $('#listkab option').filter(function() {
		     return this.value == kabupaten;
		   	}).data('value');
		var id_kab = id_kab ? id_kab : '';

		var kelurahan=$('#kelurahan').val();
		var id_kel = $('#listkel option').filter(function() {
		     return this.value == kelurahan;
		   	}).data('value');
		var id_kel = id_kel ? id_kel : '';

		var e = document.getElementById("id_kirim");
    	var option= e.options[e.selectedIndex];
    	var id_kirim = option.getAttribute("data-id_kirim");
    	var via_kirim = option.getAttribute("data-value");
    	$('#via_kirim').val(via_kirim);
    	//alert(id_kirim);
		//alert(via_kirim);
		$.ajax({
			url:'module/get_wilayah.php',
			type:'GET',
			dataType:'html',
			data:{'kirim': id_kirim, 'kelurahan3': kelurahan,'kabupaten3': kabupaten,'id_kab': id_kab, 'id_kel': id_kel},
			success:function (respons) {
				//alert(respons);
				$('#songkos').val(respons);
				hitung_tagihan();
			}, 
		}) 

}

function ambildata_ongkos2() {
	var kabupaten=$('#kabupaten').val();
		var id_kab = $('#listkab option').filter(function() {
		     return this.value == kabupaten;
		   	}).data('value');
		var id_kab = id_kab ? id_kab : '';

		var kelurahan=$('#kelurahan').val();
		var id_kel = $('#listkel option').filter(function() {
		     return this.value == kelurahan;
		   	}).data('value');
		var id_kel = id_kel ? id_kel : '';

		var e = document.getElementById("id_kirim");
    	var option= e.options[e.selectedIndex];
    	var id_kirim = option.getAttribute("data-id_kirim");
    	var via_kirim = option.getAttribute("data-value");
    	$('#via_kirim').val(via_kirim);

		//alert(via_kirim);
		$.ajax({
			url:'../module/get_wilayah.php',
			type:'GET',
			dataType:'html',
			data:{'kirim': id_kirim, 'kelurahan3': kelurahan,'kabupaten3': kabupaten,'id_kab': id_kab, 'id_kel': id_kel},
			success:function (respons) {
				//alert(respons);
				$('#songkos').val(respons);
				hitung_tagihan();
			}, 
		}) 

}
		

function filproduk(id_group, id_kelompok, id_kategori){
	//var etoken=$('#etoken').val();
	//alert(etoken);
	 if (id_kelompok=="") {
			//$('#tabel_cari').hide();
		}else{
			//alert(id_produk); 
			$.ajax({
				url:'module/get_produk.php',
				type:'GET',
				dataType:'html',
				data:{'action': 'filproduk', 'id_group': id_group, 'id_kelompok': id_kelompok, 'id_kategori': id_kategori},
				success:function (respons) {
					//alert(respons);
					//$("#container-iko").html(respons);
					$(".container-iko").html(respons);
				}, 
			})  
		/*jml_cart();*/
		}
	}

function filmerk(merk){
	//var etoken=$('#etoken').val();
	//alert(etoken);
	 if (merk=="") {
			//$('#tabel_cari').hide();
		}else{
			//alert(id_produk); 
			$.ajax({
				url:'module/get_produk.php',
				type:'GET',
				dataType:'html',
				data:{'action': 'filmerk', 'merk': merk},
				success:function (respons) {
					//alert(respons);
					//$("#container-iko").html(respons);
					$(".container-iko").html(respons);
				}, 
			})  
		/*jml_cart();*/
		}
	}

function pilih_alamat() {
		var keyword=$('#id_user').val();
		//alert(keyword);
		if (keyword=="") {
			//$('#tabel_cari').hide();
		}else{
			//alert(keyword);
			$.ajax({
				url:'module/get_wilayah.php',
				data:{'alamat': keyword},
				success:function (respons) {
					//alert(respons);
					$('#lookup').html(respons);
				}
			})  
					 //window.location.href = "index.php?module=pengajuan&aksi=tambah&keyword=" + keyword; 
		}  
		$('#myModal').modal('show');
	}


function pilih_alamat2() {
		var keyword=$('#id_user').val();
		//alert(keyword);
		if (keyword=="") {
			//$('#tabel_cari').hide();
		}else{
			//alert(keyword);
			//alert('../module/get_wilayah.php');
			$.ajax({
				url:'../module/get_wilayah.php',
				data:{'alamat': keyword,'vb':'m'},
				success:function (respons) {
					//alert(respons);
					$('#lookup').html(respons);
				}
			})  
					 //window.location.href = "index.php?module=pengajuan&aksi=tambah&keyword=" + keyword; 
		}  
		$('#myModal').modal('show');
}

function del_alamat(id_order){
	var keyword=$('#id_user').val();
	/*alert('tes2'); */
	 if (keyword=="") {
		//$('#tabel_cari').hide();
		}else{
			//alert(id_produk); 

			$.ajax({
				url:'module/get_wilayah.php',
				data:{'alamat': keyword},
				data:{'delalamat': id_order, 'id_user': keyword},
				success:function (respons) {
					//alert(respons);
					//$('#lookup').html(respons);
				}
			}) 
			//jml_cart();
		}
}

function del_alamat2(id_order){
	var keyword=$('#id_user').val();
	/*alert('tes2'); */
	 if (keyword=="") {
		//$('#tabel_cari').hide();
		}else{
			//alert(id_produk); 

			$.ajax({
				url:'../module/get_wilayah.php',
				data:{'alamat': keyword},
				data:{'delalamat': id_order, 'id_user': keyword},
				success:function (respons) {
					//alert(respons);
					//$('#lookup').html(respons);
				}
			}) 
			//jml_cart();
		}
}

function detail_bayar() {
	$('#myModalbayar').modal('show');
}

function detail_bayar2() {
	document.getElementById("myModalbayar2").style.display = "block"
}

function tutup_detail_bayar() {
	document.getElementById("myModalbayar2").style.display = "none"
}

	
function kosong_prov() {
	$('#provinsi').val("");
}
	
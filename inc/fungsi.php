<?php
function nm_bln($bln)
{
	$nama_bln = '';
	$arr_bln = array(
			'1' => 'Januari',
			'2' => 'Februari',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'Mei',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember');
	foreach ($arr_bln as $key => $value)
	{
		if ($key == $bln)
		{
			$nama_bln = $value;
		}
	}
	return $nama_bln;
}

function nm_hr($bln)
{
	$nama_bln = '';
	$arr_bln = array(
			'1' => 'Senin',
			'2' => 'Selasa',
			'3' => 'Rabu',
			'4' => 'Kamis',
			'5' => 'Jumat',
			'6' => 'Sabtu',
			'7' => 'Minggu');
	foreach ($arr_bln as $key => $value)
	{
		if ($key == $bln)
		{
			$nama_hr = $value;
		}
	}
	return $nama_hr;
}

function nm_tgl($tgl)
{
	$nm_tgl = '';
	$arr_tgl = array(
			'1' => '01',
			'2' => '02',
			'3' => '03',
			'4' => '04',
			'5' => '05',
			'6' => '06',
			'7' => '07',
			'8' => '08',
			'9' => '09',
			'10' => '10',
			'11' => '11',
			'12' => '12',
			'13' => '13',
			'14' => '14',
			'15' => '15',
			'16' => '16',
			'17' => '17',
			'18' => '18',
			'19' => '19',
			'20' => '20',
			'21' => '21',
			'22' => '22',
			'23' => '23',
			'24' => '24',
			'25' => '25',
			'26' => '26',
			'27' => '27',
			'28' => '28',
			'29' => '29',
			'30' => '30',
			'31' => '31'	
	);
	foreach ($arr_tgl as $key => $value)
	{
		if ($key == $tgl)
		{
			$nm_tgl = $value;
		}
	}
	return $nm_tgl;
}

function jml_hari($bln)
{
	$i = date("L");
	$jml_hari = 0;
	if ($i == 1)
	{
		$f = 29;
	}
	else
	{
		$f = 28;
	}
	
	$arr_jml_hari = array(
			'1' => 31,
			'2' => $f,
			'3' => 31,
			'4' => 30,
			'5' => 31,
			'6' => 30,
			'7' => 31,
			'8' => 31,
			'9' => 30,
			'10' => 31,
			'11' => 30,
			'12' => 31);

	foreach ($arr_jml_hari as $key => $value)
	{
		if ($key == $bln)
		{
			$jml_hari = $value;
		}
	}
	return $jml_hari;
}
?>
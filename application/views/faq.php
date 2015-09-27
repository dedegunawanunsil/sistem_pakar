<div class="jumbotron">
Ini adalah tugas mata kuliah <b>Kecerdasan Buatan</b> Teknik Informatika Universitas Siliwangi, TI-C 2013. Anggota tim kami :
<ul>
	<?php
	$anggota = array(
		'137006107' => 'Dede Gunawan',
		'137006089' => 'Deni Dian',
		'137006001' => 'Agung Fatwa M',
		'137006002' => 'Yusef Andria',
		'137006003' => 'Firdan Kusuma G',
		'137006004' => 'Rendi Supriadi',
		'137006005' => 'Asep Anang',
	);
	foreach ($anggota as $npm => $nama) {
		echo "<li>{$nama} &laquo;{$npm}&raquo;</li>";
	}
	?>

</ul>
</div>
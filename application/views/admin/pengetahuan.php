<div style="margin-top:10px;">
	<?php 
	echo "Penyakit beserta gejalanya :";
	$penyakit = (@$data['penyakit']) ? $data['penyakit'] : die();
	$gejala = (@$data['gejala']) ? $data['gejala'] : die();
	echo "<ul>";
	foreach ($penyakit['used'] as $key => $value) {
		echo "<li>".$value->nm_penyakit." (<small><i>";
		echo $value->nm_latin."</i></small>) gejala :";
		echo "<ul>";
		foreach (@$gejala['used'][$value->id] as $key2 => $value2) {
			echo "<li>{$value2->nm_gejala}</li>";
		}
		echo "</ul>";
		echo "</li>";
	}
	echo "</ul>";
	echo "Penyakit yang tidak ada gejalanya :";
	echo "<ul>";
	foreach ($penyakit['unused'] as $key => $value) {
		echo "<li>".$value->nm_penyakit." (<small><i>";
		echo $value->nm_latin."</i></small>)";
		echo "</li>";
	}
	echo "</ul>";

	echo "Gejala yang tidak terikat dengan penyakit :";
	echo "<ul>";
	foreach ($gejala['unused'] as $key => $value) {
		echo "<li>".$value->nm_gejala;
		echo "</li>";
	}
	echo "</ul>";
	
	?>
</div>
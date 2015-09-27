<div style="margin-top:10px;">
	<form action="#" method="post" class="form-check">
		<div class="row">
			<div class="col-md-12">
				<h3>Detail Rekaman Konsultasi</h3>
				<p>Pemilik : <b><?php echo @$data->nama_pemilik;?></b></p>
				<p>Jenis Sapi : <b><?php echo @$data->jenis_sapi;?></b></p>
				<p>Varietas Sapi : <b><?php echo @$data->varietas_sapi;?></b></p>
				<p>Usia Sapi : <b><?php echo @$data->usia;?></b></p>
				<p>Jenis Kelamin Sapi : <b><?php echo @$data->kelamin_sapi;?></b></p>
				<p>Lokasi Pemeliharaan : <b><?php echo @$data->lokasi;?></b></p>
				<p>Diagnosa Penyakit : <b><?php echo @$data->nm_penyakit;?> <small><i>(<?php echo @$data->nm_latin;?>)</i></small></b></p>
				<p><b>Definisi :</b> <br/><?php echo @$data->definisi;?></p>
				<p><b>Solusi :</b> <br/><?php echo @$data->solusi;?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<a href="<?php echo base_url().$_SESSION['user_level']."/".$url;?>" class="btn btn-primary">Kembali</a>
				</div>
			</div>
		</div>
	</form>
</div>
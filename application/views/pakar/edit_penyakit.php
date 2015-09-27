<div style="margin-top:10px;">
	<form action="#" method="post" class="form-check">
		<div class="row">
			<div class="col-md-12">
				<?php echo validation_errors('<p class="alert alert-danger">', '</p>');?>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-6">			
				<div class="form-group">
					<span><small>Nama Penyakit :</small></span>
					<input class="form-control requiered nm_penyakit" name="nm_penyakit" placeholder="Nama Penyakit" type="text"  autocomplete="off" value="<?php echo @$data->nm_penyakit;?>" />
				</div>
			</div>
			<div class="col-md-6">			
				<div class="form-group">
					<span><small>Nama Latin :</small></span>
					<input class="form-control requiered nm_latin" name="nm_latin" placeholder="Nama Latin" type="text"  autocomplete="off" value="<?php echo @$data->nm_latin;?>" />
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<span><small>Definisi :</small></span>
					<textarea class="form-control requiered" name="definisi" placeholder="Definisi" style="resize:none;" ><?php echo @$data->definisi;?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<span><small>Solusi :</small></span>
					<textarea class="form-control requiered" name="solusi" placeholder="Solusi" style="resize:none;"><?php echo @$data->solusi;?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
						<?php
						if (($url == 'edit') || ($url == 'tambah')) {?>
							<button type="submit" name="submit" class="btn btn-primary form-control" value="submit">Simpan</button>
						<?php } else { ?>
							<a href="<?php echo base_url();?>pakar/penyakit" class="btn btn-primary">Kembali</a>
						<?php }
						
						?>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
$("form.form-check").submit(function(e) {
	e.preventDefault();
	var inputs = $(this).find('.requiered');
	var success = 0;
	for (var i = 0; i < inputs.length; i++) {
		var _in = $(inputs[i]);
		var _val = _in.val();
		if (_val == '') {
			_in.focus();
			break;
		}
		else
		{
			success = success + 1;
		}
	}
	if (success >= inputs.length
	) {
		$(this).unbind();

	};
});
</script>
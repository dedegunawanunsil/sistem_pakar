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
					<span><small>Nama Gejala :</small></span>
					<input class="form-control requiered nm_gejala" name="nm_gejala" placeholder="Nama Gejala" type="text"  autocomplete="off" value="<?php echo @$data->nm_gejala;?>" />
				</div>
			</div>
			
		</div>
		
		<div class="row">
			<div class="col-md-6">
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
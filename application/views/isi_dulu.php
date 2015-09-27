<div style="margin-top:10px;">
	<form action="#" method="post" class="form-check">
		<div class="row">
			<div class="col-md-12">			
				<div class="form-group">
					<span><small>Nama Pemilik :</small></span>
					<input class="form-control requiered" name="nama_pemilik" placeholder="Nama Pemilik" type="text" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">			
				<div class="form-group">
					<span><small>Jenis Sapi :</small></span>
					<select name="jenis_sapi" class="form-control requiered" autocomplete="off">
						<option value="" selected>--Pilih Salah Satu--</option>
						<?php
						if (@$jenis_sapi && is_array($jenis_sapi)) {
							foreach ($jenis_sapi as $_jenis) {
								echo "<option value=\"{$_jenis->id}\">{$_jenis->nama_jenis}</option>";
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="col-md-6">			
				<div class="form-group">
					<span><small>Varietas Sapi :</small></span>
					<select name="varietas_sapi" class="form-control requiered" autocomplete="off">
						<option value="" selected>--Pilih Salah Satu--</option>
						<?php
						if (@$varietas_sapi && is_array($varietas_sapi)) {
							foreach ($varietas_sapi as $_jenis) {
								echo "<option value=\"{$_jenis->id}\">{$_jenis->nama_jenis}</option>";
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">			
				<div class="form-group">
					<span><small>Jenis Kelamin Sapi :</small></span>
					<select name="kelamin_sapi" class="form-control requiered" autocomplete="off">
						<option value="" selected>--Pilih Salah Satu--</option>
						<option value="J">Jantan</option>
						<option value="B">Betina</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">			
				<div class="form-group">
					<span><small>Usia : (dalam bulan)</small></span>
					<input class="form-control requiered" name="usia" placeholder="Usia" type="text" data-type="integer" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<span><small>Lokasi Tempat Pemeliharan :</small></span>
					<textarea class="form-control requiered" name="lokasi_pemeliharaan" placeholder="Lokasi Tempat Pemeliharan" style="resize:none;" type="text"></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary form-control" value="submit">Mulai Konsultasi</button>
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
	if (success >= inputs.length) {
		var $input = $("<input type='hidden' name='session_id_valid requiered' value='<?php echo @$session_id_valid;?>'/>")
		$(this).append($input);
		$(this).unbind();

	};
});
</script>
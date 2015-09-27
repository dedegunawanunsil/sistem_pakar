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
					<span><small>Email :</small></span>
					<input class="form-control requiered user_nama" name="user_nama" placeholder="Isi Email" type="email"  autocomplete="off" value="<?php echo @$data->user_nama;?>" readonly="readonly">
				</div>
			</div>
			<div class="col-md-6">			
				<div class="form-group">
					<span><small>Level User :</small></span>
					<select name="user_level" class="form-control requiered" autocomplete="off" value="<?php echo @$data->user_level;?>" >
						<option value="admin">Administrator</option>
						<option value="pakar">Ahli / Pakar</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">			
				<div class="form-group">
					<span><small>Password :</small></span>
					<input class="form-control <?php
						if ($url != 'edit') echo 'requiered';?> user_password" name="user_password" placeholder="Passsword" type="password" autocomplete="off" >
				</div>
			</div>
			<div class="col-md-6">			
				<div class="form-group">
					<span><small>Password :</small></span>
					<input class="form-control <?php
						if ($url != 'edit') echo 'requiered';?> confirm_password" name="confirm_password" placeholder="Confirm Passsword" type="password" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
						<?php
						if ($url == 'edit') {?>
							<button type="submit" name="submit" class="btn btn-primary form-control" value="submit">Simpan</button>
						<?php } else { ?>
							<a href="<?php echo base_url();?>admin/pakar" class="btn btn-primary">Kembali</a>
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
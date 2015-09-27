<div style="margin-top:10px;padding:40px !important;">
	<form method="post" action="#">
		<div class="row">
			<div class="col-md-12">
				<?php echo validation_errors('<p class="alert alert-danger">', '</p>');?>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<input type="email" class="form-control" name="email" placeholder="Email"/>
				</div>			
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password"/>
				</div>			
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<button type="submit" class="form-control btn btn-success" name="submit">Login</button>
				</div>			
			</div>
		</div>
	</form>
</div>
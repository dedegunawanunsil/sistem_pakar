<div id="navbar" class="collapse navbar-collapse">
	<ul class="nav navbar-nav">
		<?php
		if(!isset($_SESSION['user_level'])) {
		?>
			<li><a href="<?php echo base_url();?>home">Beranda</a></li>
			<li><a href="<?php echo base_url();?>konsultasi">Konsultasi</a></li>
			<li><a href="<?php echo base_url();?>home/faq">Tentang Kami</a></li>
		<?php 
		}
		else if(isset($_SESSION['user_level']) &&
			$_SESSION['user_level'] == 'pakar')
		{?>
			<li><a href="<?php echo base_url();?>pakar/dashboard">Beranda</a></li>
			<li><a href="<?php echo base_url();?>pakar/penyakit">Penyakit</a></li>
			<li><a href="<?php echo base_url();?>pakar/gejala">Gejala</a></li>
			<li><a href="<?php echo base_url();?>pakar/relasi">Relasi</a></li>
			
		<?php } 
		else if(isset($_SESSION['user_level']) &&
			$_SESSION['user_level'] == 'admin')
		{?>
			<li><a href="<?php echo base_url();?>admin/dashboard">Beranda</a></li>
			<li><a href="<?php echo base_url();?>admin/pakar">Pakar</a></li>
			<li><a href="<?php echo base_url();?>admin/pengetahuan">Pengetahuan</a></li>
			<li><a href="<?php echo base_url();?>admin/rekaman">Rekaman Konsultasi</a></li>							
		<?php 
		}
		?>
	</ul>
	<ul class="nav navbar-nav pull-right">
		<?php
		if(!isset($_SESSION['user_level'])) {
		?>
			<li><a href="<?php echo base_url();?>auth/login">Masuk</a></li>
		<?php } else { ?>
			<li><a href="<?php echo base_url();?>auth/logout">Keluar</a></li>
		<?php } ?>
	</ul>
</div><!--/.nav-collapse -->
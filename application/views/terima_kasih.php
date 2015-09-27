<div class="message jumbotron" style="margin:10px">Terima Kasih Telah Mendownload File <b><?php echo $judul;?></b> ini, Tunggu <span class="time">10</span> Detik</div>
<br/>
<script type="text/javascript">
var $start = 10;
setInterval(function(){ 
	$(".time").text($start);
	$start--;
	if($start == 1) {
		window.location.href = "<?php echo $link;?>";
	}
	if($start <= 0) {
		<?php $_referer = @$_SERVER['HTTP_REFERER'];?>
		$(".message").html("Jika File yang anda ingin download tidak otomatis di download, silahkan refresh kembali halaman<br/>File Yang telah anda download silahkan ganti sesuai judul lagu yang anda inginkan.<br/><a class='btn btn-primary closesss' href='#'>Klik Tombol Ini menutup halaman</a>");
		clearInterval();
		$(".closesss").click(function(e) {
			e.preventDefault();
			window.close();
		});
	}
}, 1000);
</script>
<p style="margin-top:15px">Silahkan Cari Lagu Terbaru </p>
<form role="search" action="<?php echo base_url();?>s/" class="form" >
	<div class="form-group">
		<div class="input-group">
			<input type="text" class="form-control query" name="query"  placeholder="Cari Lagu Terbaru ..." <?php if(@$query) { echo "value='".urldecode($query)."'";}?>>
			<span class="input-group-btn">
				<button class="btn btn-default submit" type="submit" name="submit" >Cari</button>
			</span>
		</div><!-- /input-group -->
	</div>
</form>
<script type="text/javascript">
function escapeShowTitle(title) {
	title = title.replace(/'/g, "");
    title = escape(title)
    return title
}
$(".form").submit(function(event) {
	event.preventDefault();
	var $_i_form = $(this).find(".query")[0];
	var q = $($_i_form).val();
	var url= $(this).attr('action')+escapeShowTitle(q);
	if(q.length > 0) {
		document.location.href = url;
	}
	else
	{
		$($_i_form).attr('placeholder', 'Ketikkan Lagu Yang ingin anda cari');
		$($_i_form).focus();
	}
});
</script>
<div class="hasil_pencarian">
<?php echo @$data;?>
</div>
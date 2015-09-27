Hasil Pencarian : menampilkan <?php echo @$start;?> - <?php echo (@$end+@$start-1);?> dari <?php echo @$total_file;?> file, <br/>

<?php
if(is_array($data)) {
	foreach($data as $_data) { ?>
		<div class="media">
			<div class="media-left media-middle">
				<a href="<?php echo base_url();?>dl?url=<?php echo $_data['url'];?>">
					<img class="media-object" style="width:50px;" src="<?php echo base_url();?>assets/mp3.jpg" alt="<?php echo $_data['nama'];?>" >
				</a>
			</div>
			<div class="media-body">
				<h4 class="media-heading"><a href="<?php echo base_url();?>dl?url=<?php echo $_data['url'];?>" target="_blank"> <?php echo @$_data['nama'];?></a></h4>
				Ukuran File : <?php echo @$_data['size'];?>. Telah Di Download <?php echo @$_data['total_download'];?> Kali, sejak <?php echo @$_data['tanggal'];?>
			</div>
		</div>
		<hr/>
	<?php }
}
?>
<nav>
	<ul class="pagination">
    <li <?php if($page_number == 1) echo ' class="disabled" ';?>>
		<a href="<?php echo base_url().'s/'.$query.'/'.($page_number-1);?>" aria-label="Sebelumnya">
			<span aria-hidden="true">&laquo;</span>
		</a>
    </li>
	<?php 
	for($i = 1; $i <= $pages_total;$i++) { 
		if($i-5 < $page_number && $i+5 > $page_number) {
		?>
		<li <?php if($page_number == $i) echo ' class="active" ';?>><a href="<?php echo base_url().'s/'.$query.'/'.$i;?>"><?php echo $i;?></a></li>
	<?php } 
		}?>
    <li <?php if($page_number == $pages_total || $pages_total == "0") echo ' class="disabled" ';?>>
		<a href="<?php echo base_url().'s/'.$query.'/'.($page_number+1);?>" aria-label="Selanjutnya">
			<span aria-hidden="true">&raquo;</span>
		</a>
    </li>
  </ul>
</nav>

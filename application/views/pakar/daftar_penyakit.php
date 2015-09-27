<?php echo '<script type="text/javascript" src="'.base_url().'assets/plugins/datatables/jquery.dataTables.js"></script>';
echo '<script type="text/javascript" src="'.base_url().'assets/plugins/datatables/dataTables.bootstrap.js"></script>';?>
<div style="margin-top:10px;">
	<a href="<?php echo base_url().$_SESSION['user_level']."/".$url."/tambah";?>" class="btn btn-danger">Tambah <?php echo ucwords($url);?></a>
	<br/>
	<br/>
	<div class="row">
		<div class="col-md-12">	
			<table class="dataTables1 table">
				<thead>
					<tr>
						<th>No.</th>
						<?php 
						if ($field && is_array($field)) {
							foreach ($field as $value) {
								echo "<th>$value</th>";
							}
						}
						?>			
						<th>Opsi</th>			
					</tr>
				</thead>
				<tbody>
					<?php 
					if($data->num_rows() > 0) {
						$data = $data->result();
					}
					if ($data && is_array($data)) {
						$start = 0;
						foreach ($data as $_data) {
							if ($field && is_array($field)) {
							?>
							<tr>
							<td><?php echo $start+1;?></td>
							<?php
								foreach ($field as $key => $value) {
									echo "<td>".$_data->{$key}."</td>";
								}
							?>
							<td>
								<?php
								if (!(isset($filter['detail']) && (in_array($_data->id, $filter['detail']) || in_array("all", $filter['detail'])) )) {?>
								<a href="<?php echo base_url().$_SESSION['user_level']."/".$url."/detail/".$_data->id;?>">Detail</a>&nbsp;
								<?php }	?> 
								<?php
								if (!(isset($filter['edit']) && (in_array($_data->id, $filter['edit']) || in_array("all", $filter['edit'])))) {?>
								
								<a href="<?php echo base_url().$_SESSION['user_level']."/".$url."/edit/".$_data->id;?>">Edit</a>&nbsp; 
								<?php }	?>
								<?php
								if (!(isset($filter['hapus']) && (in_array($_data->id, $filter['hapus']) || in_array("all", $filter['hapus'])))) {?>
								<a href="<?php echo base_url().$_SESSION['user_level']."/".$url."/hapus/".$_data->id;?>">Hapus</a>
							</td>			
								<?php }	?>
							</tr>
							<?php 
							$start++;
							}
						}
					}
					?>	
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">$(".dataTables1").dataTable();</script>

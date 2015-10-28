    <div style="padding-top:15px">
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <select class="form-control" id="penyakit-select">
                        <?php
                        echo "<option value='0' selected>--Pilih Penyakit--</option>";
                        foreach ($penyakit as $value) {
                            printf("<option value='%s'>%s</option>", $value->id, $value->nm_penyakit);
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <a href="#" class="btn btn-primary saveRelasi">Simpan</a>
                </div>
            </div>
        </div>
        <div id="wait" style="display:none">Tunggu Beberapa saat</div>
        <div class="sideBySide row">
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery.sortable.js"></script>

    <script type="text/javascript">
    $("#penyakit-select").on('change', function() {
		$(".sideBySide").empty();
		$.ajax({
			'url' : "<?php echo base_url();?>pakar/relasi/get_table/"+$(this).val(),
			'method' : 'get',
			'success' : function(ab) {
				$(".sideBySide").html(ab);
				$(".source, .target").sortable({
			      connectWith: ".connected"
			    });
			}
		});
    });
    $(".saveRelasi").click(function(e) {
    	e.preventDefault();
    	var items = [];
    	$(".sideBySide .target li").each(function() {
    		//items.push(item);
    		items.push($(this).attr('data-id'));
		});
		$.ajax({
			'url' : "<?php echo base_url();?>pakar/relasi/update_relasi/"+$("#penyakit-select").val(),
			'method' : 'post',
			'data' : 'data='+JSON.stringify(items),  
			success : function(ab) {
				console.log(ab);

			}
		}).fail(function(e) {
			console.log(e);
		});
    });
    $(document).ajaxStart(function(){
    	$("#wait").css("display", "block");
	});

	$(document).ajaxComplete(function(){
	    $("#wait").css("display", "none");
	}); 
    </script>
    <style type="text/css">
        ul.source, ul.target {
      min-height: 50px;
      margin: 0px 25px 10px 0px;
      padding: 2px;
      border-width: 1px;
      border-style: solid;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      list-style-type: none;
      list-style-position: inside;
    }
    ul.source {
      border-color: #f8e0b1;
    }
    ul.target {
      border-color: #add38d;
    }
    .source li, .target li {
      margin: 5px;
      padding: 5px;
      -webkit-border-radius: 4px;
      -moz-border-radius: 4px;
      border-radius: 4px;
      text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
    }
    .source li {
      background-color: #fcf8e3;
      border: 1px solid #fbeed5;
      color: #c09853;
    }
    .target li {
      background-color: #ebf5e6;
      border: 1px solid #d6e9c6;
      color: #468847;
    }
    .sortable-dragging {
      border-color: #ccc !important;
      background-color: #fafafa !important;
      color: #bbb !important;
    }
    .sortable-placeholder {
      height: 40px;
    }
    .source .sortable-placeholder {
      border: 2px dashed #f8e0b1 !important;
      background-color: #fefcf5 !important;
    }
    .target .sortable-placeholder {
      border: 2px dashed #add38d !important;
      background-color: #f6fbf4 !important;
    }
    </style>

<?php
if(is_array($data)) {
	foreach($data as $_data) {
		printf("<a href='%s' style='font-size:%s'>%s</a>", $data->url, $data->popularity, $data->caption);
	}
}
?>
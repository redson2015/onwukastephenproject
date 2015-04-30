<?php
function getOptions2($ids,$v){
	$jassonArray = json_decode($ids,true);
	$options="<option value=''>Select</option>";
	//echo var_dump($jassonArray);
	//echo var_dump($jassonArray);
	foreach($jassonArray as $x => $x_value) {
		$options.="<option ";
		
		if (($v==implode("", $x_value))) {
			$options.="Selected ";
		}
		$options.= "value='".implode("", $x_value)."'>".implode("", $x_value)."</option>";
		
	}
	
	return $options;
	

}



function getTime($time){
	$option="";
	$date = date_create();
	date_time_set($date, 8,00);
	/* date_add($date,date_interval_create_from_date_string("1 hour"));
	 echo date_format($date, 'H:i:s'); */
	for ($i = 8; $i < 22; $i++) {
		$d = date_format($date, 'H:i');
		$option.="<option value='".$d."'";
		if ($d==$time){
				
			$option.=" Selected";
		}

		$option.=">".$d."</option>";
		date_add($date,date_interval_create_from_date_string("1 hour"));
	}

	return $option;
}
?>
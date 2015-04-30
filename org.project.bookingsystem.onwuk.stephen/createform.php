<?php 

function getTable($tableRows) {
	$table = "<table class='bookingEdit'>\n".getTableBody($tableRows)."</table>";
	return ($table);
}


function getTableBody($rows) {
	$body = "";
	for ($i = 0; $i < count($rows); $i++) {
		$body .="  <tr>";
		$row = $rows[$i];
		for ($j = 0; $j < count($row); $j++) {
			if($j==1){
				$body .= "<td class='adminTable'>".$row[$j]."</td>";

			}else{
				$body .= "<td>".$row[$j]."</td>";
			}
		}
		$body .= "</tr>\n";
	}
	return ($body);
}





?>
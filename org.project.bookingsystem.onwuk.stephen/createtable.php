<?php 

function getTable($headings, $tableRows) {
	$table = "<table class='booktable'>\n".getTableHeadings($headings).getTableBody($tableRows)."</table>";
	return ($table);
}

function getTableHeadings($headings) {
	$firstRow = "<tr>";
	for ($i = 0; $i < count($headings); $i++) {
		$firstRow .="<th>".$headings[$i]."</th>";
	}
	$firstRow .= "</tr>\n";
	return ($firstRow);
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


function getbookingHeadings(){

	$headings = array("Booking ID", "User ID", "Booking Date", "Room_Id", "Module ID", "Time Starting", "Time Ending", "Notes" );
	return $headings;

}

function getbuildingHeadings(){
	
	$headings = array("Building Id", "Building Name", "Campus Id");
	return $headings;
	
}




?>
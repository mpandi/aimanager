<?php
function get_details($id){
	global $connect;
	$que = mysql_query("SELECT * FROM customers WHERE id = '$id'") or die(mysql_error());
	if(mysql_num_rows($que) == 0){
		return false;
	}
    else{
		while($rs = mysql_fetch_assoc($que)){
			$nei[] = $rs;
		}
		return $nei;
	}
}
?>
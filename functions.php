<?php
function check_employee_code($code){
	global $connect;
	$que = mysql_query("SELECT * FROM complainers WHERE employee_code = '$code'") or die(mysql_error());
	if(mysql_num_rows($que) == 0){
		return false;
	}
    else{
		return true;
	}
}
function check_complaint_id($id){
	global $connect;
	$que = mysql_query("SELECT * FROM messages WHERE complaint_id = '$id'") or die(mysql_error());
	if(mysql_num_rows($que) == 0){
		return false;
	}
    else{
		return true;
	}
}
function get_complaint_from_id($id){
	global $connect;
	$que = mysql_query("SELECT complaint FROM messages WHERE complaint_id = '$id' LIMIT 1") or die(mysql_error());
	if(mysql_num_rows($que) == 0){
		return false;
	}
    else{
		while($rs = mysql_fetch_assoc($que)){
			$nei = $rs['complaint'];
		}
		return $nei;
	}
}
function check_station($station){
	global $connect;
    $station = strtoupper($station);
	$que = mysql_query("SELECT * FROM complaint_stations WHERE station = '$station'") or die(mysql_error());
	if(mysql_num_rows($que) == 0){
		return false;
	}
    else{
		return true;
	}
}
function check_type($type){
	global $connect;
    $type = strtoupper($type);
	$que = mysql_query("SELECT * FROM complaint_types WHERE type_ = '$type'") or die(mysql_error());
	if(mysql_num_rows($que) == 0){
		return false;
	}
    else{
		return true;
	}
}
function get_station($comp_id){
	global $connect;
	$que = mysql_query("SELECT station FROM messages WHERE complaint_id = '$comp_id' ORDER BY id ASC LIMIT 1") or die(mysql_error());
	if(mysql_num_rows($que) == 0){
		return false;
	}
   else{
		while($rs = mysql_fetch_assoc($que)){
			$nei = $rs['station'];
		}
		return $nei;
	}
}
function get_employee($comp_id){
	global $connect;
	$que = mysql_query("SELECT employee_code FROM messages WHERE complaint_id = '$comp_id' ORDER BY id ASC LIMIT 1") or die(mysql_error());
	if(mysql_num_rows($que) == 0){
		return false;
	}
   else{
		while($rs = mysql_fetch_assoc($que)){
			$nei = $rs['employee_code'];
		}
		return $nei;
	}
}
function get_designation($comp_id){
	global $connect;
	$que = mysql_query("SELECT designation FROM messages WHERE complaint_id = '$comp_id' ORDER BY id ASC LIMIT 1") or die(mysql_error());
	if(mysql_num_rows($que) == 0){
		return false;
	}
   else{
		while($rs = mysql_fetch_assoc($que)){
			$nei = $rs['designation'];
		}
		return $nei;
	}
}
function get_complaint_type($comp_id){
	global $connect;
	$que = mysql_query("SELECT complaint_type FROM messages WHERE complaint_id = '$comp_id' ORDER BY id ASC LIMIT 1") or die(mysql_error());
	if(mysql_num_rows($que) == 0){
		return false;
	}
   else{
		while($rs = mysql_fetch_assoc($que)){
			$nei = $rs['complaint_type'];
		}
		return $nei;
	}
}
function get_station_id($station){
	global $connect;
	$que = mysql_query("SELECT id FROM complaint_stations WHERE station = '$station'") or die(mysql_error());
	if(mysql_num_rows($que) == 0){
		return false;
	}
   else{
	   while($rs = mysql_fetch_assoc($que)){
			$nei = $rs['id'];
		}
	   return $nei;
	}
}
function get_monitor($station_id){
	global $connect;
	$que = mysql_query("SELECT email,phone,username FROM users WHERE complaint_station = '$station_id' OR complaint_station = 'ALL'") or die(mysql_error());
	if(mysql_num_rows($que) == 0){
		return false;
	}
   else{
	   while($rs = mysql_fetch_assoc($que)){
			$nei = array($rs['email'],$rs['phone'],$rs['username']);
		}
	   return $nei;
	}
}
?>
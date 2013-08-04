<?php
include ('osrmlib.php');

include ('input.php');

$result_file[]="node;lat;lon\n";

/*
 * Distance and time between all listed points
 */
	for ($i=0;$i<$size;$i++)
	{
	$arrres= nearest($csv[$i]["lat"],$csv[$i]["lon"]);
	
	$result_file[]=["node" =>$csv[$i]["node"],"lat"=>$arrres[0],"lon"=>$arrres[1]];		
	}
	
include ('output.php');
?>

<?php
include ('osrmlib.php');

include ('input.php');

$result_file[]="from;to;status;distance;time\n";

/*
 * Distance and time between all listed points
 */
for ($i=0;$i<$size;$i++)
	for ($j=0;$j<$size;$j++)
	{
	if ($i==$j) continue;
	$arrres= request($csv[$i]["node"],$csv[$i]["lat"],$csv[$i]["lon"],$csv[$j]["node"],$csv[$j]["lat"],$csv[$j]["lon"]);
	$result_file[]=$arrres;
	}

include ('output.php');
?>

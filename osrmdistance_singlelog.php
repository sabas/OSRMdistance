<?php
include ('osrmlib.php');

include ('input.php');

append("from;to;status;distance;time",$out);

/*
 * Distance and time between all listed points
 */
for ($i=0;$i<$size;$i++)
{
	for ($j=0;$j<$size;$j++)
	{
	if ($i==$j) continue;
	$arrres= request($csv[$i]["node"],$csv[$i]["lat"],$csv[$i]["lon"],$csv[$j]["node"],$csv[$j]["lat"],$csv[$j]["lon"]);
	$res=implode(";",$arrres);
	append($res,$out);
	}
}

	function append($message,$file='log.txt')
	{
		$handle=fopen($file,'a');
		if (!$handle) echo ("File cannot be opened");
		$message.=PHP_EOL;
		fwrite ($handle, $message);
		fclose($handle);
	}
		
?>

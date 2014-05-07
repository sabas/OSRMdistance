<?php

/* default */
$in="input.csv";
$list="list.csv";
$out="dump.csv";

if(php_sapi_name()=="cli")
{
    $in=$argv[1];
    $list=$argv[2];
    $out=$argv[3];
}
else
{
    $in=$_GET['in'];
    $list=$_GET['list'];
    $out=$_GET['out'];
}

$csv=csvRead($in);
$size=count($csv);

$csvlist=csvRead($list);
$sizelist=count($csvlist);

$starttime=time();

append("from;to;status;distance;time",$out);

/*
 * Distance and time between all listed points
 */
for ($i=0;$i<$sizelist;$i++)
{
	if(isset($csvlist[$i][0])&&isset($csvlist[$i][1]))
	{
	$arrres= request($csv[$csvlist[$i][0]]["node"],$csv[$csv[$csvlist[$i][0]]["lat"],$csv[$csvlist[$i][0]]["lon"],$csv[$sizelist[$i][1]]["node"],$csv[$sizelist[$i][1]]["lat"],$csv[$sizelist[$i][1]]["lon"]);
	append(csvDump($arrres),$out);
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

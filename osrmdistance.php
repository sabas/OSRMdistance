<?php
include ('osrmlib.php');

/* default */
$in="input.csv";
$out="dump.csv";

if(php_sapi_name()=="cli")
{
    $in=$argv[1];
    $out=$argv[2];
}
else
{
    $in=$_GET['in'];
    $out=$_GET['out'];
}

$csv=csvRead($in);
$size=count($csv);
$result_file=array();
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

/*
 * Distance and time between a point and all the others
 *
    $node=72990694;
    $lat=40.7208189;
    $lon=8.5652056;

	for ($j=0;$j<$size;$j++)
	{
	$arrres= request($node,$lat,$lon,$csv[$j]["node"],$csv[$j]["lat"],$csv[$j]["lon"]);
	$result_file[]=$arrres;
	}
 */

if(php_sapi_name()=="cli")
{
    file_put_contents ($out,csvDump($result_file));
}
else
{
    attachDownload($out,$result_file);
}
?>

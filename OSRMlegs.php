<?php
include ('osrmlib.php');

if(php_sapi_name()!="cli") die("CLI only");

/*
 * START
 */

$in="input.csv";
$out="dump.csv";

$in=$argv[1];
$out=$argv[2];
if(!isset($argv[3])) $argv[3]=FALSE;

$geometry=$argv[3];

$csv=csv_to_array($in);
$size=count($csv);

$startTime=microtime(TRUE);

$header="from;to;status;distance;time";
if($geometry)$header.=";geometry";
append($header."\n",$out);

/*
 * Distance and time between points
 */

$rows=array();
for ($i=0;$i<$size;$i++)
{
	$arrres= request($csv[$i]["node1"],$csv[$i]["lat1"],$csv[$i]["lon1"],$csv[$i]["node2"],$csv[$i]["lat2"],$csv[$i]["lon2"],$geometry);
    $rows[]=$arrres;
}
append(csvDump($rows),$out);

/*
 * END
 */

$endTime=microtime(TRUE);
$elapsed=$endTime - $startTime;

echo "Finished in ".$elapsed." seconds\n";
		
?>

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
if(isset($argv[3]) $argv[3]=FALSE;

$geometry=$argv[3];

$csv=csv_to_array($in);
$size=count($csv);

$startTime=microtime(TRUE);

$header="from;to;status;distance;time";
if($geometry)$header.=";geometry";
append($header."\n",$out);

/*
 * Distance and time between all points
 */

for ($i=0;$i<$size;$i++)
{
	$rows=array();
	for ($j=0;$j<$size;$j++)
	{
	if ($i==$j) continue;
	$arrres= request($csv[$i]["node"],$csv[$i]["lat"],$csv[$i]["lon"],$csv[$j]["node"],$csv[$j]["lat"],$csv[$j]["lon"],$geometry);
	$rows[]=$arrres;
	}
	append(csvDump($rows),$out);
}

/*
 * END
 */

$endTime=microtime(TRUE);
$elapsed=$endTime - $startTime;

echo "Finished in ".$elapsed." seconds\n";
		
?>

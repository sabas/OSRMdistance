<?php
include ('osrmlib.php');

if(php_sapi_name()!="cli") die("CLI only");

/*
 * START
 */

$in="input.csv";
$in2="input2.csv";
$out="dump.csv";

$in=$argv[1];
$in2=$argv[2];
$out=$argv[3];
if(!isset($argv[4])) $argv[4]=FALSE;

$geometry=$argv[4];

$csv=csv_to_array($in);
$csv2=csv_to_array($in2);
$size=count($csv);
$size2=count($csv2);

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
	for ($j=0;$j<$size2;$j++)
	{
	$arrres= request($csv[$i]["node"],$csv[$i]["lat"],$csv[$i]["lon"],$csv2[$j]["node"],$csv2[$j]["lat"],$csv2[$j]["lon"],$geometry);
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

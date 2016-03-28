<?php
require('osrmlib.php');

if(php_sapi_name()!="cli") die("CLI only");

/*
 * START
 */

$in="input.csv";
$in2="nearest.csv";
$out="result.csv";

$in=$argv[1];
$in2=$argv[2];
$out=$argv[3];

$result_file[]="node;distance\n";

$csv1=csv_to_array($in);
$csv2=csv_to_array($in2);
$size=count($csv1);

for ($i=0;$i<$size;$i++)
{
	$arrres= haversine($csv1[$i]["lat"],$csv1[$i]["lon"],$csv2[$i]["lat"],$csv2[$i]["lon"]);
	$result_file[]=["node" =>$csv1[$i]["node"],"distance"=>$arrres];		
}
	
writeFile(csvDump($result_file),$out);
?>

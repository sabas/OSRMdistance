<?php
if(php_sapi_name()!="cli") die("CLI only");

/*
 * START
 */

$in="input.csv";
$out="dump.csv";

$in=$argv[1];
$out=$argv[2];

$result_file[]="node;lat;lon\n";

$csv=csv_to_array($in);
$size=count($csv);

for ($i=0;$i<$size;$i++)
{
	$arrres= nearest($csv[$i]["lat"],$csv[$i]["lon"]);
	$result_file[]=["node" =>$csv[$i]["node"],"lat"=>$arrres[0],"lon"=>$arrres[1]];		
}
	
writeFile(csvDump($result_file),$out);
?>

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

$csv=csv_to_array($in);
$size=count($csv);

$fmto=$argv[3]; // FROM or TO
if($fmto != "FROM" && $fmto != "TO") die("Third parameter must be FROM or TO");
$node=$argv[4];

$startTime=microtime(TRUE);

append("from;to;status;distance;time\n",$out);

$node=explode(";",$node);

for ($j=0;$j<$size;$j++)
{
    if($fmto=="FROM")
	$arrres= request($node[0],$node[1],$node[2],$csv[$j]["node"],$csv[$j]["lat"],$csv[$j]["lon"]);
    else
	$arrres= request($csv[$j]["node"],$csv[$j]["lat"],$csv[$j]["lon"],$node[0],$node[1],$node[2]);

	append(csvDump($arrres),$out);
}

/*
 * END
 */

$endTime=microtime(TRUE);
$elapsed=$endTime - $startTime;

echo "Finished in ".$elapsed." seconds\n";
?>

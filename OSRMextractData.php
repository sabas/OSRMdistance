<?php
if(php_sapi_name()!="cli") die("CLI only");

include ('osrmlib.php');

/*
 * START
 */

$in="input.osm";
$out="dump.csv";

$in=$argv[1];
$out=$argv[2];
$result_file=[];

/*
 * Extract data with simplexml
 */

$result_file[]="node;lat;lon\n";
$f=simplexml_load_file($in);
foreach ($f->children() as $elm)
{
	if ($elm->getName()!="node") continue;
	$attr=$elm->attributes();
	$name=$elm->xpath("tag[@k='name']"); //by default the node label is the tag name=*
	$node='';
	if(count($name)==0) $node=$attr["id"];
	else
		$node=$name[0]["v"];
	$result_file[]=[$node,$attr["lat"],$attr["lon"]];
}

writeFile(csvDump($result_file),$out);
?>

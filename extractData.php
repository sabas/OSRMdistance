<?php
include ('osrmlib.php');

include ('input.php');

$result_file[]="node;lat;lon\n";
$f=simplexml_load_file($in);
foreach ($f->children() as $elm)
{
	if ($elm->getName()!="node") continue;
	$attr=$elm->attributes();
	$name=$elm->xpath("tag[@k='name']");
	$node='';
	if(count($name)==0) $node=$attr["id"];
	else
		$node=$name[0]["v"];
	$result_file[]=[$node,$attr["lat"],$attr["lon"]];
}

include ('output.php');
?>

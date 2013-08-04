<?php
include ('osrmlib.php');

include ('input.php');

if(php_sapi_name()=="cli")
{
    $node=$argv[3];
}
else
{
    $node=$_GET['node'];
}

$result_file[]="from;to;status;distance;time\n";

$node=explode(";",$node);

	for ($j=0;$j<$size;$j++)
	{
	$arrres= request($node[0],$node[1],$node[2],$csv[$j]["node"],$csv[$j]["lat"],$csv[$j]["lon"]);
	$result_file[]=$arrres;
	}

include ('output.php');
?>

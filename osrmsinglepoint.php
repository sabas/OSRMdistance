<?php
include ('osrmlib.php');

/* default */
$in="input.csv";
$out="dump.csv";

if(php_sapi_name()=="cli")
{
    $in=$argv[1];
    $out=$argv[2];
    $node=$argv[3];
}
else
{
    $in=$_GET['in'];
    $out=$_GET['out'];
    $node=$_GET['node'];
}

$csv=csvRead($in);
$size=count($csv);
$result_file=array();
$result_file[]="from;to;status;distance;time\n";

$node=explode(";",$node);

	for ($j=0;$j<$size;$j++)
	{
	$arrres= request($node[0],$node[1],$node[2],$csv[$j]["node"],$csv[$j]["lat"],$csv[$j]["lon"]);
	$result_file[]=$arrres;
	}


if(php_sapi_name()=="cli")
{
    file_put_contents ($out,csvDump($result_file));
}
else
{
    attachDownload($out,$result_file);
}
?>

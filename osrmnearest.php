<?php
include ('osrmlib.php');

/* default */
$in="input.csv";
$out="dump.csv";

if(php_sapi_name()=="cli")
{
    $in=$argv[1];
    $out=$argv[2];
}
else
{
    $in=$_GET['in'];
    $out=$_GET['out'];
}

$csv=csvRead($in);
$size=count($csv);
$result_file=array();
$result_file[]="node;lat;lon\n";

/*
 * Distance and time between all listed points
 */
	for ($i=0;$i<$size;$i++)
	{
	$arrres= nearest($csv[$i]["lat"],$csv[$i]["lon"]);
	
	$result_file[]=["node" =>$csv[$i]["node"],"lat"=>$arrres[0],"lon"=>$arrres[1]];		
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

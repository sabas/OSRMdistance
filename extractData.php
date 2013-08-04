<?php
include ('osrmlib.php');

/* default */
$in="input.osm";
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

$result_file=array();
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

if(php_sapi_name()=="cli")
{
    file_put_contents ($out,csvDump($result_file));
}
else
{
    attachDownload($out,$result_file);
}
?>

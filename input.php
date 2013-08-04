<?php

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

$starttime=time();
?>

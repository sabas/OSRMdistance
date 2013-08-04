<?php
$endtime=time();
echo "Operation lasted ".time_diff_conv($starttime,$endtime)."\n";

if(php_sapi_name()=="cli")
{
    file_put_contents ($out,csvDump($result_file));
}
else
{
    attachDownload($out,$result_file);
}
?>

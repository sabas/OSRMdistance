<?php
function attachDownload($fname,$file)
{
header('Content-disposition: attachment; filename='.$fname);
header('Content-type: text/csv');
echo csvDump($file);
}

function request($node1,$lat1,$lon1,$node2,$lat2,$lon2)
{
	$results=array();
	$request=file_get_contents("http://localhost:5000/viaroute?loc=".$lat1.",".$lon1."&loc=".$lat2.",".$lon2);
	$json=json_decode($request, true);
		
	$results["start"]='"'.$node1.'"';
	$results["stop"]='"'.$node2.'"';
		
		if ($json["status"]!=0) 
		{
			$status=$json["status"];
			$distance=0;
			$time=0;
		}
		else
		{
			$status="OK";
			$distance=$json["route_summary"]["total_distance"];
			$time=$json["route_summary"]["total_time"];
		}
	
	$results["status"]=$status;
	$results["distance"]=$distance;
	$results["time"]=$time;
	return $results;
}

function nearest($lat,$lon)
{
	$request=file_get_contents("http://localhost:5000/nearest?loc=".$lat.",".$lon);
	$json=json_decode($request, true);
		if ($json["status"]!=0) 
		{
			$status=$json["status"];
            return [$lat,$lon];
		}
		else
		{
			$status="OK";
            return $json["mapped_coordinate"];
		}
}

function csvRead($file)
{
	if (($handle = fopen($file, "r")) !== FALSE) {
		$k=0;

		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
			++$k;
			
			if ($k==1)
			{
				$i=-1;
				foreach ($data as $cell)
				{
					$titles[++$i]=$cell;
				}
			continue;
			}
			
			$i=-1;
				foreach ($data as $cell)
				{
				$csv[$k-2][$titles[++$i]]=$cell;
				}
		}
		fclose($handle);
	}
	return $csv;
}

function csvDump($arr)
{
	$tmp='';
	foreach ($arr as $line)
	{
        if (!is_array($line))$tmp.=$line;
        else
		$tmp.= implode(";",$line)."\n";
    }	
    return 	$tmp;
}

/* from http://www.php.net/manual/en/function.time.php#107092 */
function time_diff_conv($start, $s) {
    $t = array( //suffixes
        'd' => 86400,
        'h' => 3600,
        'm' => 60,
    );
    $s = abs($s - $start);
    $string='';
    foreach($t as $key => &$val) {
        $$key = floor($s/$val);
        $s -= ($$key*$val);
        $string .= ($$key==0) ? '' : $$key . "$key ";
    }
    return $string . $s. 's';
}
?>

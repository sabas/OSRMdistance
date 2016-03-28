<?php

function doCurl($url)
{
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $request= curl_exec($ch);
    curl_close($ch);
    return $request;
}

/*
 * WRAPPER
 */

$counter=0;

function request($node1,$lat1,$lon1,$node2,$lat2,$lon2,$geometry=FALSE)
{
	global $counter;
	
	$counter++;
	if(($counter % 10000) == 0) echo "Done ".$counter."\n";

	$results=array();
	//connection refused when no osrm is active
    $request=doCurl("http://localhost:5000/viaroute?loc=".$lat1.",".$lon1."&loc=".$lat2.",".$lon2);

	$json=json_decode($request, true);

    if(count($json) == 0){
        die("Some coordinates are invalid: ".$node1." (".$lat1.",".$lon1.") - ".$node2." (".$lat2.",".$lon2.")");
    }
	$results["start"]='"'.$node1.'"';
	$results["stop"]='"'.$node2.'"';
		
		if ($json["status"]!=200) 
		{
			$status=$json["status"];
			$distance=0;
			$time=0;
            $geom="";
		}
		else
		{
			$status="OK";
			$distance=$json["route_summary"]["total_distance"];
			$time=$json["route_summary"]["total_time"];
            $geom=$json["route_geometry"];
		}
	
	$results["status"]=$status;
	$results["distance"]=$distance;
	$results["time"]=$time;
    if($geometry) $results["geometry"]=$geom;
	return $results;
}

function nearest($lat,$lon)
{
	$request=doCurl("http://localhost:5000/nearest?loc=".$lat.",".$lon);
	$json=json_decode($request, true);

		if ($json["status"]!=200) 
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

/**
* @link http://gist.github.com/385876
*/
function csv_to_array($filename='', $delimiter=';')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
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

function append($message,$file='log.txt')
{
    writeFile($message,$file,"a+");
}

function writeFile($message,$file='log.txt',$flag="w")
{
	$handle=fopen($file,$flag);
	if (!$handle) echo ("File cannot be opened");
	fwrite($handle, $message);
	fclose($handle);
}

function haversine($lat1,$lon1,$lat2,$lon2)
{
    $R = 6372797.560856;

    $dlat = deg2rad($lat2-$lat1);
    $dlon = deg2rad($lon2-$lon1);

	$lonh=sin($dlon*0.5);
	$lonh*=$lonh;
	
	$lath=sin($dlat*0.5);
	$lath*=$lath;
	
	$tmp= cos(deg2rad($lat1))*cos(deg2rad($lat2));

    return 2*$R*asin(sqrt($lath+$tmp*$lonh));
}
?>

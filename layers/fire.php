<?php
header('Content-Type: application/json');

$JSON=json_decode(file_get_contents("https://www.rfs.nsw.gov.au/feeds/majorIncidents.json"),true);
foreach($JSON['features'] as $gk => $gv)
{
	$category=$JSON['features'][$gk]['properties']['category'];
	if($category=="Emergency Warning")
	{
		$featurecolor="#E91A25";;
	}
	else if($category=="Watch and Act")
	{
		$featurecolor="#F3ED31";
	}
	else if($category=="Advice")
	{
		$featurecolor="#4287CF";
	}
	else if($category=="Not Applicable")
	{
		$featurecolor="#FFFFFF";
	}
	
	$JSON['features'][$gk]['properties']['stroke']=$featurecolor;
	$JSON['features'][$gk]['properties']['stroke-width']=2;
	$JSON['features'][$gk]['properties']['stroke-opacity']=0.5;
	$JSON['features'][$gk]['properties']['fill']=$featurecolor;
	$JSON['features'][$gk]['properties']['fill-opacity']=0.5;
	$JSON['features'][$gk]['properties']['name']=$gv['properties']['title'];
}
echo(json_encode($JSON,JSON_PRETTY_PRINT));
?>
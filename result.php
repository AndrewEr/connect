<!DOCTYPE HTML PUBLIC
"-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Explore Wines in a Region</title>
</head>
<body bgcolor="white">

	<?php
	require_once('connect.php');
	
	
	function showerror() {
     die("Error " . mysql_errno() . " : " . mysql_error());
  	}
	?>
	
	<?php

		$wineName = $_GET['wineName'];
		$wineryName = $_GET['wineryName'];
		$regionName = $_GET['regionName'];
		$variety = $_GET['variety'];
		$startyear = $_GET['startyear'];
		$endyear = $_GET['endyear'];
		$minStock = $_GET['minStock'];
		$minOrders = $_GET['minOrders'];
		
		if($wineName == 'All')
			result_wineName ="*";
			
		if($wineryName == 'All')
			result_wineryName ="*";
		
		if($regionName == 'All')
			result_regionName ="*";
			
		if($variety == 'All')
			result_variety ="*";
			
		if($startyear == 'All')
			result_startyear ="*";
			
		if($endyear == 'All')
			result_endyear ="*";
			
		if($minStock == 'All')
			result_minStock="*";
			
		if($minOrders == 'All')
			result_minOrders ="*";
			
		$result_query="SELECT wine_id, wine_name, description, year, winery_name
					FROM winery, region, wine
					WHERE winery.region_id = region.region_id
					AND wine.winery_id = winery.winery_id";

  // ... then, if the user has specified a region, add the regionName
  // as an AND clause ...
  if (isset($regionName) && $regionName != "All") {
    $query .= " AND region_name = '{$regionName}'";
  }

  // ... and then complete the query.
  $query .= " ORDER BY wine_name";
		}
		echo $wineName;
		echo "<br>";
		echo $wineryName;
		echo "<br>";
		echo $regionName;
		echo "<br>";
		echo $variety;
		echo "<br>";
		echo $startyear;
		echo "<br>";
		echo $endyear;
		echo "<br>";
		echo $minStock;
		echo "<br>";
		echo $minOrders;
		echo "<br>";
	
	?>

</body>
</html>

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
		$minCost = $_GET['minCost'];
		$maxCost = $_GET['maxCost'];
		
		echo "<br>Wine Name:";
		echo $wineName;
		echo "<br>Winery Name:";
		echo $wineryName;
		echo "<br>Region Name:";
		echo $regionName;
		echo "<br>Variety:";
		echo $variety;
		echo "<br>Starting Year:";
		echo $startyear;
		echo "<br>Ending Year:";
		echo $endyear;
		echo "<br>Minimum Stock:";
		echo $minStock;
		echo "<br>Minimum Order:";
		echo $minOrders;
		echo "<br>";
			
		$result_query = "SELECT wine.wine_name AS Wine_Name,grape_variety.variety AS Grape_Variety, 
						wine.year AS Wine_Year, winery.winery_name AS Winery_Name,
						region.region_name AS Region_Name, inventory.cost AS Price, 
						inventory.on_hand AS Quantity_Available, items.qty AS Quantity_Sold, 
						(inventory.cost * inventory.on_hand) AS Revenue
						FROM wine,winery, region,grape_variety,wine_variety, inventory, items
						WHERE wine.winery_id = winery.winery_id AND
						winery.region_id = region.region_id AND
						wine_variety.wine_id = wine.wine_id AND
						wine_variety.variety_id = grape_variety.variety_id AND
						wine.wine_id = inventory.wine_id AND
						wine.wine_id = items.wine_id " ;
		
		
		if(isset($wineName) && $wineName != "All")
		{
			$result_query .=" AND wine.wine_name = '{$wineName}'";
		}
		if(isset($wineryName) && $wineryName != "All")
		{
			$result_query .=" AND winery.winery_name = '{$wineryName}'";
		}
		if(isset($regionName) && $regionName != "All")
		{
			$result_query .=" AND region.region_name = '{$regionName}'";
		}
		if(isset($variety) && $variety != "All")
		{
			$result_query .=" AND grape_variety.variety = '{$variety}'";
		}
		if(isset($minStock) && $minStock != "All")
		{
			$result_query .=" AND inventory.on_hand = '{$minStock}'";
		}
		if(isset($minOrders) && $minOrders != "All")
		{
			$result_query .=" AND items.qty = '{$minOrders}'";
		}
					
					
	 	$result_query .= " ORDER BY wine_name;";
		
	
	?>

</body>
</html>

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
	
	if(isset($_GET['submit']))
	{
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
		
		$errorstring = "" ;

		if(!$wineName)
			$errorstring = $errorstring."Wine Name cannot be empty.<br>";
		if(!$wineryName)
			$errorstring = $errorstring."Winery Name cannot be empty.<br>";
		if(!$regionName)
			$errorstring = $errorstring."Region Name cannot be empty.<br>";
		if(!$variety)
			$errorstring = $errorstring."Grape Variety cannot be empty.<br>";
		if(!$startyear)
			$errorstring = $errorstring."Starting Year cannot be empty.<br>";
		if(!$endyear)
			$errorstring = $errorstring."Ending Year cannot be empty.<br>";
			
		if($endyear < $startyear)
			$errorstring = $errorstring."Starting Year must be before End year<br>";
			
		if(!$minStock)
		{
			$errorstring = $errorstring."Minimum Stock cannot be empty.<br>";
		}
		else if(!is_numeric($minStock) && !$minStock == "All")
		{
				$errorstring = $errorstring."Minimum Stock must be in number.<br>";
		}
		
		if(!$minOrders)
		{
			$errorstring = $errorstring."Minimum Order cannot be empty.<br>";			
		}
		else if(!is_numeric($minOrders) && !$minStock == "All")
		{
			$errorstring = $errorstring."Minimum Orders must be in number.<br>";
		}
		
		if(!$minCost)
		{
			$errorstring = $errorstring."Minimum Cost cannot be empty.<br>";
		}
		else if(!is_numeric($minCost) && !$minStock == "All")
		{
			$errorstring = $errorstring."Minimum Cost must be in number.<br>";
		}
		else if($maxCost < $minCost)
		{
			$errorstring = $errorstring."Maximum Cost cannot be smaller than Minimum Cost.<br>";
		}
		
		if(!$maxCost)
		{
			$errorstring = $errorstring."Maximum Cost cannot be empty.<br>";
		}
		else if(!is_numeric($maxCost) && !$minStock == "All")
		{
			$errorstring = $errorstring."Maximum Cost must be in number.<br>";
		}
		else if($maxCost < $minCost)
		{
			$errorstring = $errorstring."Maximum Cost cannot be smaller than Minimum Cost.<br>";
		}
		
		
		if($errorstring != "")
		{
			echo "<center><br><br>Error. Please take note of the following :<br> $errorstring";
			$complete = false;
		}
		if($errorstring == "")
		{
			require_once('connect.php');

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
			if(isset($startyear) && $startyear != "All")
			{
				$result_query .=" AND wine.year >= '{$startyear}'";
			}
			if(isset($endyear) && $endyear != "All")
			{
				$result_query .=" AND wine.year <= '{$endyear}'";
			}
			if(isset($minStock) && $minStock != "All")
			{
				$result_query .=" AND inventory.on_hand = '{$minStock}'";
			}
			if(isset($minOrders) && $minOrders != "All")
			{
				$result_query .=" AND items.qty = '{$minOrders}'";
			}
			if(isset($minCost) && $minCost != "All")
			{
				$result_query .=" AND inventory.cost >= '{$minCost}'";
			}
			if(isset($maxCost) && $maxCost != "All")
			{
				$result_query .=" AND inventory.cost <= '{$maxCost}'";
			}	
					
	 		//Query Ends
	 		
	 		$result = mysql_query($result_query);

    		$rowsFound = @ mysql_num_rows($result);
    	
    		// Print one row of results
        	//. The wine name, grape varieties, year, winery, and region. 
       	 	//2. The cost of the wine in the inventory.
			//3. The total number of bottles available at any price.
			//4. The total stock sold of the wine.
			//5. The total sales revenue for the wine.
    	
			if ($rowsFound > 0 && $rowsFound <= 500) 
    		{     
      			echo "<br><br>Wines from $regionName<br><br>";
      			echo "{$rowsFound} records found matching your criteria<br>";
      			echo "<table border ='1'> <tr> <td>Wine Name</td><td>Grape Variety</td><td>Wine Year</td><td>Winery Name</td>
      			<td>Region Name </td><td>Price</td><td>Number of wine available</td><td>Number of wine sold</td><td>Revenue</td></tr>";
      		
      			while ($row = mysql_fetch_array($result, MYSQL_NUM)) 
      			{
   					 printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>", 
   					 $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9]);
				}

 			}   	 
    		else
    		{
    		 	echo "Your search produced ".$rowsFound." results. Please go back and refine your search";
    		} 	
    		
    	}
    }
	?>
  	
</body>
</html>
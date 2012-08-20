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
		require_once('db.php');
	
	 	if (!($connection = @ mysql_connect(DB_HOST, DB_USER, DB_PW))) 
	 	{
    		die("Could not connect");
  		}
  		
  		if (!mysql_select_db(DB_NAME, $connection))
  		{
    		showerror();
 		}

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
					
	 	$result_query .= " ORDER BY wine_name, variety;";
	 	
	 	//Query Ends
	 	
	 	$result = mysql_query($result_query);

    	$rowsFound = @ mysql_num_rows($result);
    	
    	// Print one row of results
        //. The wine name, grape varieties, year, winery, and region. 
        //2. The cost of the wine in the inventory.
		//3. The total number of bottles available at any price.
		//4. The total stock sold of the wine.
		//5. The total sales revenue for the wine.
    	
		if ($rowsFound > 0) 
    	{     
      		echo "Wines from $regionName<br><br>";
      		echo "{$rowsFound} records found matching your criteria<br>";

		 		echo 
	      		"\n<table border ='1'>\n<tr>" .
	           	"\n\t<th>Wine Name</th>" .
   	       		"\n\t<th>Grape Variety</th>" .
    	      	"\n\t<th>Wine Year</th>" .
        	  	"\n\t<th>Region Name</th>" .
   	       		"\n\t<th>Wine Price</th>" .
    	      	"\n\t<th>Number of wine in stock</th>" .
        	  	"\n\t<th>Number of wine sold</th>" .
          		"\n\t<th>Revenue</th>\n</tr>";
      
      		
     		while ($row = @ mysql_fetch_array($result)) 
      		{
       	 		echo 
       	 		"\n<tr>\n\t<td>{$row["wine_name"]}</td>" .
            	"\n\t<td>{$row["variety"]}</td>" .
            	"\n\t<td>{$row["year"]}</td>" .
            	"\n\t<td>{$row["region.region_name"]}</td>" .
            	"\n\t<td>{$row["inventory.cost"]}</td>" .
           	 	"\n\t<td>{$row["inventory.on_hand"]}</td>" .
           	 	"\n\t<td>{$row["items.qty"]}</td>" .
           	 	"\n\t<td>{$row["(inventory.cost * inventory.on_hand)"]}</td>\n</tr>";	
      		} 
      		
      		// while($row = mysql_fetch_array($result))
// 			{
// 				echo "<tr>";
// 				
// 				foreach ($row as $attribute)
// 				{
// 					echo "<td>$attribute</td>";
// 				}
// 				echo "</tr>"; 
//			}

			echo "\n</table>";
       		
	
 		}
   	 
    	else
    	{
    	 	echo "Your search produced ".$rowsFound." results. Please go back and refine your search";
    	} 

	?>

</body>
</html>

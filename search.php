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
	echo 'Status:<br>';
	require_once('connect.php');
	?>
	
	<?php
	
	if($_GET['submit'])
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
			if(!is_numeric($minStock) && !$minStock == "All")
			{
				$errorstring = $errorstring."Minimum Stock must be in number.<br>";
			}
			
		}
		
		if(!$minOrders)
		{
			$errorstring = $errorstring."Minimum Order cannot be empty.<br>";
			if(!is_numeric($minOrders) && !$minStock == "All")
			{
				$errorstring = $errorstring."Minimum Orders must be in number.<br>";
			}
			
		}
		
		if(!$minCost)
		{
			$errorstring = $errorstring."Minimum Cost cannot be empty.<br>";
			if(!is_numeric($minCost) && !$minStock == "All")
			{
				$errorstring = $errorstring."Minimum Cost must be in number.<br>";
				if($maxCost < $minCost)
				{
					$errorstring = $errorstring."Maximum Cost cannot be smaller than Minimum Cost.<br>";
				}
			}
		}
		
		if(!$maxCost)
		{
			$errorstring = $errorstring."Maximum Cost cannot be empty.<br>";
			if(!is_numeric($maxCost) && !$minStock == "All")
			{
				$errorstring = $errorstring."Maximum Cost must be in number.<br>";
				if($maxCost < $minCost)
				{
					$errorstring = $errorstring."Maximum Cost cannot be smaller than Minimum Cost.<br>";
				}
			}
			
		}
		
		if($errorstring != "")
			echo "<center><br><br>Error. Please take note of the following :<br> $errorstring";
			
		if($errorstring == "")
			header('location:result.php');
	}
	?>

	<form method="get">
	
	<table border ="1" align = "center">
  	<tr>
		<td>
			Wine Name:
		</td>
		<td>
			<input type="text" name ="wineName" value="All">
		</td>
	</tr>
	
	<tr>
		<td>
			Winery Name:
		</td>
		
		<td>
		<input type = "text" name ="wineryName" value="All">
		</td>
	</tr>

	<tr>
		<td>
			Region Name:
		</td>
		<td>
			<?php
			$options = '';
			$filter =  mysql_query("select region_name from region") or die(mysql_error());
			
			while(($row = mysql_fetch_array($filter)) != false)
			{
				$options .="<option>" . $row['region_name'] ."</option>";
			}
			$regionName="<select name ='regionName'> ". $options ." </select>";
			echo "$regionName";  
			?>
			
		</td>
	</tr>
  
	<tr>
		<td>
			Grape Variety:
		</td>
		<td>
			<?php

			$options = '';
			$filter =  mysql_query("select variety from grape_variety") or die(mysql_error());
   
			while(($row = mysql_fetch_array($filter)) != false)
			{
				$options .="<option>" . $row['variety'] ."</option>";
			}
			$variety= "<select name ='variety'> ". $options ." </select>";
			echo "$variety";  
			?>
			         
		</td>
	</tr>
	
	<tr>
		<td>
			Range Years:
		</td>
		<td>
				From:
				<?php
				$options = '';
				$filter =  mysql_query("select distinct year from wine order by year asc") or die(mysql_error());
   
				while(($row = mysql_fetch_array($filter)) != false)
				{
					$options .="<option>" . $row['year'] . "</option>";
				}
				$year="<select name ='startyear'> ". $options ." </select>";
				echo "$year";
				?>
				
				To:
				<?php
				$options = '';
				$filter =  mysql_query("select distinct year from wine order by year asc") or die(mysql_error());
   
				while(($row = mysql_fetch_array($filter))!=false)
				{	
					$options .="<option>" . $row['year'] . "</option>";
				}
				$year="<select name ='endyear'> ". $options ." </select>";
				echo "$year";
				?>
				
		</td>
	</tr>
	<tr>
		<td>
		Minimum Stock:
		</td>
		<td>
		<input type="text" name ="minStock" value="All">
		</td>
	</tr>
	<tr>
		<td>
		Minimum Orders:
		</td>
		<td>
		<input type="text" name ="minOrders" value="All">
		</td>
	</tr>
	<tr>
		<td>
			Range Costs:
		</td>
		<td>
				Minimum:
				<input type="text" name ="minCost" value="All">
				Maximum:
				<input type="text" name ="maxCost" value="All">
		</td>
	</tr>
	<tr>
		<td colspan ="2">
		<center>
		<input type='submit' name = 'submit' value ='SEARCH' />
		</center>
		</td>	
    
  </form>

</body>
</html>

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
		
		$errorstring = "" ;

		
		if($errorstring != "")
			echo "Error. Please take note of the following :<br> $errorstring";

		if($errorstring == "")
			header('location: result.php');
	}
	?>
	
	<form method="get" action="result.php">
	
	<table border ="1">
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
		<input type='submit' name = 'submit' value ='SEARCH' />
		</td>	
    
  </form>

</body>
</html>

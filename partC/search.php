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
	require_once('../connect.php');
	?>
	
	<form method="GET" action ="results.php" >
	
	<table border ="1" align = "center">
  	<tr>
		<td>
			Wine Name:
		</td>
		<td>
			<input type="text" name ="wineName" value='<?php if(!isset($complete)) echo "All"; else if($complete == false) echo $wineName; else echo ""   ?>'>
		</td>
	</tr>
	
	<tr>
		<td>
			Winery Name:
		</td>
		
		<td>
		<input type = "text" name ="wineryName" value='<?php if(!isset($complete)) echo "All"; else if($complete == false) echo $wineryName; else echo ""   ?>'>
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
			$variety= "<select name ='variety'> <option> All </option>". $options ." </select>";
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
				$year="<select name ='startyear'>". $options ." </select>";
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
				$year="<select name ='endyear'>". $options ." </select>";
				echo "$year";
				?>
				
		</td>
	</tr>
	<tr>
		<td>
		Minimum Stock:
		</td>
		<td>
		<input type="text" name ="minStock" value='<?php if(!isset($complete)) echo "All"; else if($complete == false) echo $minStock; else echo ""   ?>'>
		</td>
	</tr>
	<tr>
		<td>
		Minimum Orders:
		</td>
		<td>
		<input type="text" name ="minOrders" value='<?php if(!isset($complete)) echo "All"; else if($complete == false) echo $minOrders; else echo ""   ?>'>
		</td>
	</tr>
	<tr>
		<td>
			Range Costs:
		</td>
		<td>
				Minimum:
				<input type="text" name ="minCost" value='<?php if(!isset($complete)) echo "All"; else if($complete == false) echo $minCost; else echo ""   ?>'>
				Maximum:
				<input type="text" name ="maxCost" value='<?php if(!isset($complete)) echo "All"; else if($complete == false) echo $maxCost; else echo ""   ?>'>
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

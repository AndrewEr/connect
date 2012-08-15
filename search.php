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
	
	
	<form action="query_results.php" method="GET">
	<table border ="1" action=" " method ="GET">
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
   
			while(($row = mysql_fetch_array($filter))!=false)
			{
				$options .="<option>" . $row['region_name'] ."</option>";
			}
			
			$regionName="<form id ='regionName' name= 'regionName' method='get'>
			
			<select name ='regionName'> ". $options ." </select>
			</form>";
 
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
   
				while(($row = mysql_fetch_array($filter))!=false)
				{
					$options .="<option>" . $row['variety'] . "</option>";
				}
    
				$variety="<form id ='variety' name= 'variety' method='get'>
				<select name ='variety'> ". $options ." </select>
				</form>";
 
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
   
				while(($row = mysql_fetch_array($filter))!=false)
				{
					
					$options .="<option>" . $row['year'] . "</option>";
				}
				
				echo $row['year'];
				
				$year="<form id ='year' name= 'year' method='get'>
				<select name ='year'> ". $options ." </select>
				</form>";
				
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
				
				echo $row['year'];
				
				$year="<form id ='year' name= 'year' method='get'>
				<select name ='year'> ". $options ." </select>
				</form>";
				
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

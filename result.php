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

<!DOCTYPE HTML PUBLIC
"-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Explore Wines in a Region</title>
</head>
<body bgcolor="white">
  <form action="query_results.php" method="GET">
  
  
  	<br>
  	Wine Name:
  	<input type="text" name ="wineName" value="All">
  
  	<br>
  	<br>
  	
  	Winery Name:
  	<input type = "text" name ="wineryName value="All">
  	
  	<br>
  	<br>
  	
  	Region Name:
  	
  	
  	<?php
	
	//require_once('db.php');
	//if (!$dbconn = mysql_connect(DB_HOST, DB_USER, DB_PW)) {
	//echo 'Could not connect to mysql on ' . DB_HOST . "\n";
	//exit; }

	//echo 'Connected to mysql on ' . DB_HOST . "\n";
	//if (!mysql_select_db(DB_NAME, $dbconn)) {
	//echo 'Could not use database ' . DB_NAME . "\n";
	//echo mysql_error() . "\n";
	//exit;
	//}
	//echo 'Conndected to database ' . DB_NAME . "\n";

   $options = '';
   $filter =  mysql_query("select region_name from region") or die(mysql_error());
   
   while(($row = mysql_fetch_array($filter))!=false)
   {
      $options .="<option>" . $row['region_name'] . "</option>";
        }
               
        $regionName="<form id ='regionName' name= 'regionName' method='get'>
        <select name ='regionName'> ". $option ." </select>
		</form>";
 
   echo "$regionName";
               
	?>

    
  </form>
  <br>
</body>
</html>

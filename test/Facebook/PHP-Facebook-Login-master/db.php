<?php

	$host = 'localhost';
	$db_name = 'kompetis_V3';
	$user = 'kompetis_user';
	$password = 'rahasia';

	try 
	{
		global $dbc;
		$dbc = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);  
	}  
	catch(PDOException $e)
	{  
		    echo $e->getMessage();  
	}  

?>
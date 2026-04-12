<?php
  $hostname= 'localhost';
  $username= 'root';
  $password= '';
  $dbname= 'store_db';
  $conn = new mysqli($hostname, $username, $password, $dbname);
	
	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
?>
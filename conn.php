<?php
	
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'ajax_crud';

	$con = new mysqli($servername, $username, $password, $dbname);

	if($con->connect_error)
	{
		die("Connection Failed: " . $conn->connect_error);
	}
?>
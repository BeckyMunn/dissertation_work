<?php
try
{
	$pdo = new PDO('mysql:host=localhost;dbname=catdb', 'root', 'rolorolo22');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES "utf8"');
}

catch (PDOException $e)
{
	$error = 'Unable to connect to the database server.';
	include 'error.html.php';
	exit();
}

try
{
	$firstNameErr = "";
	$lastNameErr = "";
	$result = "";
	$firstname = $_GET["firstname"];
	$lastname = $_GET["lastname"];


	if ($firstname == "") {
			$lastNameErr = "";
			$firstNameErr = "First name required";
			$result = "Please try again";
	}
	elseif ($lastname == ""){
			$firstNameErr = "";
			$lastNameErr = "Last name required";
			$result = "Please try again";
	}
	else {
		$sql = "INSERT INTO volunteers SET first_name = '$firstname', last_name = '$lastname'";
		$pdo->query($sql);
		$result = "Success! $firstname $lastname added to the database.";
	}
}

catch (PDOException $e)
{
	$error = 'Error adding volunteer: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}

include 'add_volunteer_result.html.php';

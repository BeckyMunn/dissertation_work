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

try{
    $id = $_POST['id'];
    $sql1 = "DELETE FROM `volunteer_roles` WHERE vol_id = $id";
    $sql2 = "DELETE FROM `volunteers` WHERE id = $id";
    $pdo->query($sql1);
    $pdo->query($sql2);
    $result4 = "Success! Volunteer Deleted.";
}
catch (PDOException $e)
{
	$error = 'Error deleting volunteer: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}


$id = $_POST['id'];

$details = "<span class=\"error\">" . $result4 . "</span>";


include 'edit_volunteers_details.html.php';
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
	$sql = 'SELECT id, first_name, last_name FROM volunteers';
	$result = $pdo->query($sql);
}
catch (PDOException $e)
{
	$error = 'Error fetching volunteers: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}

$list = "<form action=\"edit_volunteers_details.php\" method=\"get\"><select name = \"name\"><option value= \"0\">Please select a volunteer...</option>";

while ($row = $result->fetch())
{
  $list .= "<option value=" . $row['id'] . ">" . "$row[first_name]" . " " . "$row[last_name]" . "</option>";
}
$list .= "<input type=\"submit\"></form>";

include 'edit_volunteers_selection.html.php';

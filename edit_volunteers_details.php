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
  $selected_volunteer = $_GET["name"];
  $sql = "SELECT id, first_name, last_name FROM volunteers WHERE id = '$selected_volunteer'";
  $result = $pdo->query($sql);
}
catch (PDOException $e)
{
	$error = 'Error fetching volunteers: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}

$details = "<form action=\"edit_volunteers.php\">";

while ($row = $result->fetch())
{
  $details .= "First name:<br>";
  $details .= "<input type=\"text\" name=\"firstname\" value=\"" . $row['first_name'] . "\">";
  $details .= "<br>";
  $details .= "Last name:<br>";
  $details .= "<input type=\"text\" name=\"lastname\" value=\"" . $row['last_name'] . "\">";
  $details .= "<br><br>";
  $details .= "<input type=\"hidden\" id=\"id\" name=\"id\" value =\"" . $row['id'] . "\">";
  $details .= "<input type=\"hidden\" id=\"orgfirstname\" name=\"orgfirstname\" value =\"" . $row['first_name'] . "\">";
  $details .= "<input type=\"hidden\" id=\"orglastname\" name=\"orglastname\" value =\"" . $row['last_name'] . "\">";
}

$details .= "<input type=\"submit\" value=\"Edit\"></form>";

include 'edit_volunteers_details.html.php';

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
  $selected_volunteer = $_POST["name"];
  $sql1 = "SELECT id, first_name, last_name FROM volunteers WHERE id = '$selected_volunteer'";
//  $sql2 = "SELECT volunteer_roles.role_id, roles.role From roles INNER JOIN volunteer_roles ON roles.id = volunteer_roles.role_id WHERE vol_id = '$selected_volunteer'";
  $result1 = $pdo->query($sql1);
//  $result2 = $pdo->query($sql2);
}
catch (PDOException $e)
{
	$error = 'Error fetching volunteers: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}

$result4 = "";

$details = "<form action=\"edit_volunteers.php\"method=\"POST\">";

while ($row = $result1->fetch())
{
  $details .= "First name:<br>";
  $details .= "<input type=\"text\" name=\"firstname\" value=\"" . $row['first_name'] . "\">";
  $details .= "<br>";
  $details .= "Last name:<br>";
  $details .= "<input type=\"text\" name=\"lastname\" value=\"" . $row['last_name'] . "\">";
  $details .= "<br/>";
  $details .= "<input type=\"hidden\" id=\"id\" name=\"id\" value =\"" . $row['id'] . "\">";
  $details .= "<input type=\"hidden\" id=\"orgfirstname\" name=\"orgfirstname\" value =\"" . $row['first_name'] . "\">";
  $details .= "<input type=\"hidden\" id=\"orglastname\" name=\"orglastname\" value =\"" . $row['last_name'] . "\">";
}
$details .= "<br/>";
$details .= "<p>Press \"ctrl c\" to select all the roles you wish to assign. Failure to select roles will result in the removal of all roles previously assigned.</p>";
$details .= "<select name=\"roles[]\" multiple=\"multiple\" style=\"width: 175px; height: 100px;\">";
$details .= "<option value=\"1\">Sound Console</option>";
$details .= "<option value=\"2\">Mics</option>";
$details .= "<option value=\"3\">Platform Mics</option>";
$details .= "<option value=\"4\">Car Watch</option>";
$details .= "<option value=\"5\">Door Watch</option>";
$details .= "</select>";
$details .= "<span class=\"error\">" . $result4 . "</span>";
$details .= "<br/><br/>";
$details .= "<input type=\"submit\" value=\"Edit\"></form>";

include 'edit_volunteers_details.html.php';
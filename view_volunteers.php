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
	$sql = 'SELECT id, first_name, last_name FROM volunteers ORDER BY first_name';
	$result = $pdo->query($sql);
}
catch (PDOException $e)
{
	$error = 'Error fetching volunteers: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}


$str = "<table class=\"table table-bordered table-hover \"><thead><tr><th scope=\"col\">First Name</th><th scope=\"col\">Last Name</th><th scope=\"col\">Roles</th></tr></thead><tbody \">";

while ($row = $result->fetch())
{
    $str .= "<tr>";
    $str .= "<td class=\"col-md-1\">" . $row['first_name'] . "</td>";
    $str .= "<td class=\"col-md-5\">" . $row['last_name'] . "</td>";
    $roles = "";
    $sql2= "SELECT roles.role From roles INNER JOIN volunteer_roles ON roles.id = volunteer_roles.role_id INNER JOIN volunteers ON volunteers.id = volunteer_roles.vol_id WHERE volunteers.id = '". $row['id'] ."' ORDER BY roles.id";
    $roles_result = $pdo->query($sql2);
    while ($row = $roles_result->fetch())
    {
        $roles .= $row['role'];
        $roles .= ", ";
    }
	$str .= "<td class=\"col-md-5\">" . $roles . "</td>";
	$str .= "</tr>";
}

$str .= "</tbody></table>";

include 'view_volunteers.html.php';

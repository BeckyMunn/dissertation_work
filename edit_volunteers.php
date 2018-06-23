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
  $firstname = $_GET['firstname'];
  $lastname = $_GET['lastname'];
  $orgfirstname = $_GET['orgfirstname'];
  $orglastname = $_GET['orglastname'];
  $id = $_GET['id'];

  if ($firstname == "") {
    $lastNameErr = "";
    $firstNameErr = "* First name required";
    $result = "Please try again";
  }
  elseif ($lastname == "") {
    $firstNameErr = "";
    $lastNameErr = "* Last name required";
    $result = "Please try again";
  }

  else {
    $sql = "UPDATE volunteers SET first_name = '$firstname', last_name = '$lastname' WHERE id = $id";
    $pdo->query($sql);
    $result = "Success! $firstname $lastname edited.";
    $orgfirstname = $firstname;
    $orglastname = $lastname;
  }
}
catch (PDOException $e)
{
	$error = 'Error editing volunteer: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}

$details = "<form action=\"edit_volunteers.php\">";
$details .= "First name:<br>";
$details .= "<input type=\"text\" name=\"firstname\" value=\"" . $orgfirstname . "\">";
$details .= "<span class=\"error\">" . $firstNameErr . "</span>";
$details .= "<br>";
$details .= "Last name:<br>";
$details .= "<input type=\"text\" name=\"lastname\" value=\"" . $orglastname . "\">";
$details .= "<span class=\"error\">" . $lastNameErr . "</span>";
$details .= "<br><br>";
$details .= "<input type=\"hidden\" id=\"id\" name=\"id\" value =\"" . $id . "\">";
$details .= "<input type=\"hidden\" id=\"orgfirstname\" name=\"orgfirstname\" value =\"" . $orgfirstname . "\">";
$details .= "<input type=\"hidden\" id=\"orglastname\" name=\"orglastname\" value =\"" . $orglastname . "\">";
$details .= "<span class=\"error\">" . $result . "</span>";
$details .= "<br></br>";
$details .= "<input type=\"submit\" value=\"Edit\"></form>";

include 'edit_volunteers.html.php';

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
  $selected_volunteer = $_POST["id"];
  $sql1 = "SELECT id, first_name, last_name FROM volunteers WHERE id = '$selected_volunteer' ORDER BY first_name";
  $result1 = $pdo->query($sql1);
}
catch (PDOException $e)
{
	$error = 'Error fetching volunteer roles: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}
try
{
  $firstNameErr = "";
  $lastNameErr = "";
  $result4 = "";
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $orgfirstname = $_POST['orgfirstname'];
  $orglastname = $_POST['orglastname'];
  $id = $_POST['id'];

//creates sql to add new roles to user

	$rolesArray = $_POST['roles'];
	$i = 0;
	$sql6 = "INSERT INTO `volunteer_roles`(`vol_id`, `role_id`) VALUES";
	foreach ($rolesArray as $key => $value) {
	        $i++;
            $sql6 .= "($id,$value)";
            if (next($rolesArray)==true) $sql6 .= ",";
    }

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
    $sql4 = "UPDATE volunteers SET first_name = '$firstname', last_name = '$lastname' WHERE id = $id";
    $sql5 = "DELETE FROM `volunteer_roles` WHERE vol_id = $id";
    $pdo->query($sql4);
    $pdo->query($sql5);
    $pdo->query($sql6);
    $result4 = "Success! $firstname $lastname edited.";
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

$details = "<span class=\"error\">" . $result4 . "</span>";


include 'edit_volunteers_details.html.php';

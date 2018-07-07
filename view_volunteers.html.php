<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../custom.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

  <div class="sidenav">
    <a class="tab" href="index.html">Home</a>
    <h1>Volunteers</h1>
    <a class="tab" href="view_volunteers.php">View Volunteers</a>
    <a class="tab" href="edit_volunteers_selection.php">Edit Volunteers</a>
    <a class="tab" href="add_volunteers.html.php">Add Volunteers</a>
    <h1>Schedules</h1>
    <a class="tab" href="view_schedules.php">View Schedules</a>
    <a class="tab" href="add_schedules.php">Add Schedules</a>
  </div>

<div class="main">
	<h1>View Volunteers</h1>
  <form action="volunteers_by_role.php" method="get" class="form-inline">
  <div class="form-group">
  <select name = "role" class="form-control">
    <option value= "0">Please select a role...</option>
    <option value= "0">All Roles</option>
    <option value = "1"> Sound Console</option>
    <option value = "2"> Mic</option>
    <option value = "3"> Platform Mic</option>
    <option value = "4"> Car Watch</option>
    <option value = "5"> Door Watch</option>
    </div>
    <input type="submit" class="btn btn-primary">
    <br>
  </form>
  <small>Here is a list of all the volunteers currently registered for duty.</small>
	<p><?php echo $str; ?></p>
</div>

</body>
</html>

<!--Side bar sourced from - https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_sidenav-->

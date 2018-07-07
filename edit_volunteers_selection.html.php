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
	<h1>Edit Volunteers</h1>
  <p> Please select a volunteer from the dropdown below to see the volunteers details.</p>
  <?php echo $list; ?>
</div>

</body>
</html>

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
    <a class="tab" href="#">View/Edit Schedules</a>
    <a class="tab" href="#">Add Schedules</a>
  </div>
<div class="main">
	<h1>Edit Volunteers</h1>
  <p> Here are the details for the Volunteer.</p>
  <form action="edit_volunteers_selection.php">
    <input type="submit" value="Start Again" />
    <br></br>
  </form>
  <?php echo $details; ?>
</div>

</body>
</html>

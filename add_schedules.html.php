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
    <a class="tab" href="view_schedules.php">View/Edit Schedules</a>
    <a class="tab" href="add_schedules.php">Add Schedules</a>
</div>

<div class="main">
    <h1>Add Schedules</h1>

    <small>Please select a date range to generate a schedule for.</small>
    <form action="add_schedules.php">
      From:
      <input type="date" name="from">
      To:
      <input type="date" name="to">
      <input type="submit" class="btn btn-primary">
    </form>
    <p><?php echo $schedule; ?></p>

</div>

</body>
</html>
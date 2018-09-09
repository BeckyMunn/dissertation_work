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
    <h1>View Schedules</h1>

    <small>Please select a date range to view schedule.</small>
    <form action="view_schedules.php" class="form-inline">
    <div class="form-group">
      From:
      <input type="date" name="from" class="form-control">
      </div>
      <div class="form-group">
      To:
      <input type="date" name="to" class="form-control">
      </div>
      <input type="radio" name="mode" value="Standard" checked> Standard
      <input type="radio" name="mode" value="Printer" > Printer Friendly
      <input type="submit" name="submit_button" value="Submit" class="btn btn-primary"/>
    </form>
    <p><?php echo $schedule; ?></p>
</div>

</body>
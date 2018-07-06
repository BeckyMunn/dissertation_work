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
    if (isset($_GET['from'])){
        $dateFrom = $_GET['from'];
        $dateTo = $_GET['to'];
        $sql = "SELECT date, day, CONCAT(v1.first_name, ' ', v1.last_name) as sound_console, CONCAT(v2.first_name, ' ', v2.last_name) as platform_mic, CONCAT(v3.first_name, ' ', v3.last_name) as windows_mic, CONCAT(v4.first_name, ' ', v4.last_name) as centre_mic, CONCAT(v5.first_name, ' ', v5.last_name) as notice_boards_mic, CONCAT(v6.first_name, ' ', v6.last_name) as car_watch, CONCAT(v7.first_name, ' ', v7.last_name) as door_watch FROM `schedules` LEFT OUTER JOIN volunteers v1 ON v1.id = schedules.sound_console LEFT OUTER JOIN volunteers v2 ON v2.id = schedules.platform_mic LEFT OUTER JOIN volunteers v3 ON v3.id = schedules.windows_mic LEFT OUTER JOIN volunteers v4 ON v4.id = schedules.centre_mic LEFT OUTER JOIN volunteers v5 ON v5.id = schedules.notice_boards_mic LEFT OUTER JOIN volunteers v6 ON v6.id = schedules.car_watch LEFT OUTER JOIN volunteers v7 ON v7.id = schedules.door_watch WHERE date BETWEEN '$dateFrom' and '$dateTo' ORDER BY date;";
        $result = $pdo->query($sql);

        $schedule = "<p>Here is the schedule for the defined date. If this table is empty, please enter a valid date range.</p>";
        $schedule .= "<table class=\"table table-bordered table-hover \"><thead><tr><th scope=\"col\">Date</th><th scope=\"col\">Day</th><th scope=\"col\">Sound Console</th><th scope=\"col\">Platform Mic</th><th scope=\"col\">Window Mic</th><th scope=\"col\">Center Mic</th><th scope=\"col\">Notice Board Mic</th><th scope=\"col\">Car Watch</th><th scope=\"col\">Door Watch</th></tr></thead><tbody \">";

        while ($row = $result->fetch())
        {
            $schedule .= "<tr>";
            $schedule .= "<td class=\"col-md-1\">" . $row['date'] . "</td>";
            $schedule .= "<td class=\"col-md-1\">" . $row['day'] . "</td>";
            $schedule .= "<td class=\"col-md-1\">" . $row['sound_console'] . "</td>";
            $schedule .= "<td class=\"col-md-1\">" . $row['platform_mic'] . "</td>";
            $schedule .= "<td class=\"col-md-1\">" . $row['windows_mic'] . "</td>";
            $schedule .= "<td class=\"col-md-1\">" . $row['centre_mic'] . "</td>";
            $schedule .= "<td class=\"col-md-1\">" . $row['notice_boards_mic'] . "</td>";
            $schedule .= "<td class=\"col-md-1\">" . $row['car_watch'] . "</td>";
            $schedule .= "<td class=\"col-md-1\">" . $row['door_watch'] . "</td>";
            $schedule .= "</tr>";
        }

        $schedule .= "</tbody></table>";
	}
	else {
	    $schedule = "";
	}
}
catch (PDOException $e)
{
	$error = 'Error fetching volunteers: ' . $e->getMessage();
	include 'error.html.php';
	exit();
}

include 'view_schedules.html.php';
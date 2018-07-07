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

        $sql_date_range = "SELECT date FROM `schedules` WHERE date BETWEEN '$dateFrom' and '$dateTo' ORDER BY date ASC";
        $date_range = $pdo->query($sql_date_range);
        $sql_sound_console_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '1' ORDER BY last_used DESC";
        $sound_console_last_used = $pdo->query($sql_sound_console_last_used);
        $sql_mics_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '2' ORDER BY last_used DESC";
        $mics_last_used = $pdo->query($sql_mics_last_used);
        $sql_platform_mic_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '3' ORDER BY last_used DESC";
        $platform_mic_last_used = $pdo->query($sql_platform_mic_last_used);
        $sql_car_watch_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '4' ORDER BY last_used DESC";
        $car_watch_last_used = $pdo->query($sql_car_watch_last_used);
        $sql_door_watch_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '5' ORDER BY last_used DESC";
        $door_watch_last_used = $pdo->query($sql_door_watch_last_used);

//--------------------------------------------- Create schedule
        while ($row = $date_range ->fetch())
        {
            $used_for_this_date = array();
            $date_row = $row['date'];

            //--------------------------------------------- Sound Console
            $found = "0";
            $row = $sound_console_last_used ->fetch();
            $vol_id = $row['vol_id'];
            if ($row == NULL) {
                $sql_sound_console_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '1' ORDER BY last_used DESC";
                $sound_console_last_used = $pdo->query($sql_sound_console_last_used);
                $row = $sound_console_last_used ->fetch();
                $vol_id = $row['vol_id'];
             }
            $sql_update_sound = "UPDATE schedules SET sound_console = '$vol_id' WHERE date = '$date_row'";
            $update_sound = $pdo->query($sql_update_sound);
            array_push($used_for_this_date, $vol_id);
            $sql_update_sound_last_used = "UPDATE volunteer_roles SET last_used = '$date_row' WHERE vol_id = '$vol_id' and role_id = 1";
            $update_sound_last_used = $pdo->query($sql_update_sound_last_used);

            //--------------------------------------------- Platform Mic
            $found = "0";
            $row = $platform_mic_last_used ->fetch();
            $vol_id = $row['vol_id'];
            if ($row == NULL) {
                $sql_platform_mic_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '3' ORDER BY last_used";
                $platform_mic_last_used = $pdo->query($sql_platform_mic_last_used);
                $row = $platform_mic_last_used ->fetch();
                $vol_id = $row['vol_id'];
             }

            while ($found != "1"){
                if (in_array("$vol_id", $used_for_this_date))
                {
                    $row = $platform_mic_last_used ->fetch();
                    $vol_id = $row['vol_id'];
                    if ($row == NULL) {
                        $sql_platform_mic_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '3' ORDER BY last_used DESC";
                        $platform_mic_last_used = $pdo->query($sql_platform_mic_last_used);
                        $row = $platform_mic_last_used ->fetch();
                        $vol_id = $row['vol_id'];
                     }
                  $found = "0";
                }
                else if (!in_array('$vol_id', $used_for_this_date)) {
                    $found = "1";
                }
            }

            $sql_update_plat_mics = "UPDATE schedules SET platform_mic = '$vol_id' WHERE date = '$date_row'";
            $update_plat_mics = $pdo->query($sql_update_plat_mics);
            array_push($used_for_this_date, $vol_id);
            $sql_update_plat_mics_last_used = "UPDATE volunteer_roles SET last_used = '$date_row' WHERE vol_id = '$vol_id' and role_id = 3";
            $update_plat_mics_last_used = $pdo->query($sql_update_plat_mics_last_used);


            //--------------------------------------------- Mics
            $found = "0";
            $row = $mics_last_used ->fetch();
            if ($row == NULL) {
                $sql_mics_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '2' ORDER BY last_used DESC";
                $mics_last_used = $pdo->query($sql_mics_last_used);
                $row = $mics_last_used ->fetch();
            }
            $vol_id = $row['vol_id'];
            while ($found != "1"){
                if (in_array("$vol_id", $used_for_this_date))
                {
                    $row = $mics_last_used ->fetch();
                    $vol_id = $row['vol_id'];
                    if ($row == NULL) {
                        $sql_mics_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '2' ORDER BY last_used DESC";
                        $mics_last_used = $pdo->query($sql_mics_last_used);
                        $row = $mics_last_used ->fetch();
                        $vol_id = $row['vol_id'];
                     }
                  $found = "0";
                }
                else {
                    $found = "1";
                }
            }
            $sql_update_mics = "UPDATE schedules SET windows_mic = $vol_id WHERE date = '$date_row'";
            $update_mics = $pdo->query($sql_update_mics);
            array_push($used_for_this_date, $vol_id);
            $sql_update_mics_last_used = "UPDATE volunteer_roles SET last_used = '$date_row' WHERE vol_id = '$vol_id' and role_id = 2";
            $update_mics_last_used = $pdo->query($sql_update_mics_last_used);


            $found = "0";
            $row = $mics_last_used ->fetch();
            if ($row == NULL) {
                $sql_mics_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '2' ORDER BY last_used DESC";
                $mics_last_used = $pdo->query($sql_mics_last_used);
                $row = $mics_last_used ->fetch();
            }
            $vol_id = $row['vol_id'];
            while ($found != "1"){
                if (in_array("$vol_id", $used_for_this_date))
                {
                    $row = $mics_last_used ->fetch();
                    $vol_id = $row['vol_id'];
                    if ($row == NULL) {
                        $sql_mics_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '2' ORDER BY last_used DESC";
                        $mics_last_used = $pdo->query($sql_mics_last_used);
                        $row = $mics_last_used ->fetch();
                        $vol_id = $row['vol_id'];
                     }
                  $found = "0";
                }
                else {
                    $found = "1";
                }
            }
            $sql_update_mics = "UPDATE schedules SET centre_mic = $vol_id WHERE date = '$date_row'";
            $update_mics = $pdo->query($sql_update_mics);
            array_push($used_for_this_date, $vol_id);
            $sql_update_mics_last_used = "UPDATE volunteer_roles SET last_used = '$date_row' WHERE vol_id = '$vol_id' and role_id = 2";
            $update_mics_last_used = $pdo->query($sql_update_mics_last_used);


            $found = "0";
            $row = $mics_last_used ->fetch();
            if ($row == NULL) {
                $sql_mics_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '2' ORDER BY last_used DESC";
                $mics_last_used = $pdo->query($sql_mics_last_used);
                $row = $mics_last_used ->fetch();
            }
            $vol_id = $row['vol_id'];
            while ($found != "1"){
                if (in_array("$vol_id", $used_for_this_date))
                {
                    $row = $mics_last_used ->fetch();
                    $vol_id = $row['vol_id'];
                    if ($row == NULL) {
                        $sql_mics_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '2' ORDER BY last_used DESC";
                        $mics_last_used = $pdo->query($sql_mics_last_used);
                        $row = $mics_last_used ->fetch();
                        $vol_id = $row['vol_id'];
                     }
                  $found = "0";
                }
                else {
                    $found = "1";
                }
            }
            $sql_update_mics = "UPDATE schedules SET notice_boards_mic = $vol_id WHERE date = '$date_row'";
            $update_mics = $pdo->query($sql_update_mics);
            array_push($used_for_this_date, $vol_id);
            $sql_update_mics_last_used = "UPDATE volunteer_roles SET last_used = '$date_row' WHERE vol_id = '$vol_id' and role_id = 2";
            $update_mics_last_used = $pdo->query($sql_update_mics_last_used);


            //--------------------------------------------- Car Watch
            $found = "0";
            $row = $car_watch_last_used ->fetch();
            if ($row == NULL) {
                $sql_car_watch_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '4' ORDER BY last_used DESC";
                $car_watch_last_used = $pdo->query($sql_car_watch_last_used);
                $row = $car_watch_last_used ->fetch();
             }
            $vol_id = $row['vol_id'];
            while ($found != "1"){
                if (in_array("$vol_id", $used_for_this_date))
                {
                    $row = $car_watch_last_used ->fetch();
                    $vol_id = $row['vol_id'];
                    if ($row == NULL) {
                        $sql_car_watch_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '4' ORDER BY last_used DESC";
                        $car_watch_last_used = $pdo->query($sql_car_watch_last_used);
                        $row = $car_watch_last_used ->fetch();
                        $vol_id = $row['vol_id'];
                     }
                  $found = "0";
                }
                else {
                    $found = "1";
                }
            }
            $sql_update_sound = "UPDATE schedules SET car_watch = $vol_id WHERE date = '$date_row'";
            $update_sound = $pdo->query($sql_update_sound);
            array_push($used_for_this_date, $vol_id);
            $sql_update_car_last_used = "UPDATE volunteer_roles SET last_used = '$date_row' WHERE vol_id = '$vol_id' and role_id = 4";
            $update_car_last_used = $pdo->query($sql_update_car_last_used);


            //--------------------------------------------- Door Watch
            $found = "0";
            $row = $door_watch_last_used ->fetch();
            if ($row == NULL) {
                $sql_door_watch_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '5' ORDER BY last_used DESC";
                $door_watch_last_used = $pdo->query($sql_door_watch_last_used);
                $row = $door_watch_last_used ->fetch();
             }
            $vol_id = $row['vol_id'];
            while ($found != "1"){
                if (in_array("$vol_id", $used_for_this_date))
                {
                    $row = $door_watch_last_used ->fetch();
                    $vol_id = $row['vol_id'];
                    if ($row == NULL) {
                        $sql_door_watch_last_used = "SELECT vol_id FROM `volunteer_roles` WHERE role_id = '5' ORDER BY last_used DESC";
                        $door_watch_last_used = $pdo->query($sql_door_watch_last_used);
                        $row = $door_watch_last_used ->fetch();
                        $vol_id = $row['vol_id'];
                     }
                  $found = "0";
                }
                else {
                    $found = "1";
                }
            }
            $sql_update_door = "UPDATE schedules SET door_watch = $vol_id WHERE date = '$date_row'";
            $update_door = $pdo->query($sql_update_door);
            array_push($used_for_this_date, $vol_id);
            $sql_update_door_last_used = "UPDATE volunteer_roles SET last_used = '$date_row' WHERE vol_id = '$vol_id' and role_id = 5";
            $update_door_last_used = $pdo->query($sql_update_door_last_used);
        }
//--------------------------------------------- End


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

include 'add_schedules.html.php';
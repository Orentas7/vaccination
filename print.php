<?php
    fwrite(STDOUT, "\nEnter date\n");

    $date = fgets(STDIN);
    $date = str_replace(array("\r", "\n"), '', $date);

    $users = file_get_contents('users.json');
    $tempArray = json_decode($users, true);

    $appointments = [];

    foreach($tempArray as $user) {
        if ($user["date"] == $date) {
            array_push($appointments, $user);
        }
    }

    function cmp($a, $b) {
        return strcmp($a["time"], $b["time"]);
    }


    usort($appointments, "cmp");

    if ($appointments == null) {
        fwrite(STDOUT, "\nAppointment not found\n");
    }
    else {
        print_r($appointments);
    }
?>
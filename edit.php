<?php
    fwrite(STDOUT, "\nEnter your national identification number\n");

    $nin = fgets(STDIN);
    $nin = str_replace(array("\r", "\n"), '', $nin);

    $users = file_get_contents('users.json');
    $tempArray = json_decode($users, true);

    $currentUser = null;

    foreach($tempArray as $key => $user) {
        if ($user["nin"] == $nin) {
            $currentUser = $user;
            unset($tempArray[$key]);
        }
    }

    if ($currentUser === null) {
        fwrite(STDOUT, "\nUser not found\n");
    }
    else {
        fwrite(STDOUT, "\n User found, current vaccination date " . $currentUser["date"] . ", and time " . $currentUser["time"] . ", enter new date\n");
        
        $date = fgets(STDIN);
        $currentUser["date"] = str_replace(array("\r", "\n"), '', $date);

        fwrite(STDOUT, "enter new time\n");

        $time = fgets(STDIN);
        $currentUser["time"] = str_replace(array("\r", "\n"), '', $time);

        $counter = 0;
        if (!preg_match("/(\d{4})[.\s]?(0[1-9]|1[012])[.\s]?(0[1-9]|[12][0-9]|3[01])/", $date)) {
            fwrite(STDOUT, "\nInvalid date format\n");
            $counter++;
        }if (!preg_match("/(0[89]|1[0-7])[:\s](00|15|30|45)/", $time)) {
            fwrite(STDOUT, "\nInvalid time format\n");
            $counter++;
        }
        if ($counter) {
            fwrite(STDOUT, "\nAre you sure you want to update you appointment? (yes/no)\n");

            $confirmation = fgets(STDIN);
            
            if (str_starts_with($confirmation, "yes")) {
                array_push($tempArray, $currentUser);         
                $jsonData = json_encode($tempArray);
                file_put_contents('users.json', $jsonData);
            }
        }
    }
?>
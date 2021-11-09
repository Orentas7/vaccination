<?php
    $id = uniqid();

    fwrite(STDOUT, "\nEnter your name\n");    

    $name = fgets(STDIN);
    $name = str_replace(array("\r", "\n"), '', $name);

    fwrite(STDOUT, "\nEnter your email address\n");     

    $email = fgets(STDIN);
    $email = str_replace(array("\r", "\n"), '', $email);

    fwrite(STDOUT, "\nEnter your phone number e.g. +370 642 12345\n");    

    $phoneNumber = fgets(STDIN);
    $phoneNumber = str_replace(array("\r", "\s", "\n"), '', $phoneNumber);

    fwrite(STDOUT, "\nEnter your national identification number (must be 11 numbers)\n");     

    $nin = fgets(STDIN);
    $nin = str_replace(array("\r", "\n"), '', $nin);

    fwrite(STDOUT, "\nEnter date you want to get vaccinated (y.m.d)\n");     

    $date = fgets(STDIN);
    $date = str_replace(array("\r", "\n"), '', $date);

    fwrite(STDOUT, "\nEnter time you want to get vaccinated from 08:00 to 17:00 in 15 minutes intervals\n");     

    $time = fgets(STDIN);
    $time = str_replace(array("\r", "\n"), '', $time);
    $counter = 0;

    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        fwrite(STDOUT, "\nInvalid name format\n");
        $counter++;
    } 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        fwrite(STDOUT, "\nInvalid email format\n");
        $counter++;
    }
    if (!preg_match("/\+\d{3}\s?\d{3}\s?\d{5}/", $phoneNumber)) {
        fwrite(STDOUT, "\nInvalid phone number format\n");
        $counter++;
    }
    if (!preg_match("/\d{11}/", $nin)) {
        fwrite(STDOUT, "\nInvalid national identification number format\n");
        $counter++;
    }
    if (!preg_match("/(\d{4})[.\s]?(0[1-9]|1[012])[.\s]?(0[1-9]|[12][0-9]|3[01])/", $date)) {
        fwrite(STDOUT, "\nInvalid date format\n");
        $counter++;
    }
    if (!preg_match("/(0[89]|1[0-7])[:\s](00|15|30|45)/", $time)) {
        fwrite(STDOUT, "\nInvalid time format\n");
        $counter++;
    }
    if (!$counter) {
        $userInfo = compact("id", "name", "email", "phoneNumber", "nin", "date", "time");
        $users = file_get_contents('users.json');
        $tempArray = json_decode($users, true);
        array_push($tempArray, $userInfo);
        $jsonData = json_encode($tempArray);
        file_put_contents('users.json', $jsonData);
    }
?>
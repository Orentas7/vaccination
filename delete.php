<?php
    fwrite(STDOUT, "\nEnter your national identification number\n");

    $nin = fgets(STDIN);

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
        fwrite(STDOUT, "\n User found, are you sure you want to delete user (" . $currentUser["nin"] . ")? (yes/no)\n");

        $confirmation = fgets(STDIN);
        
        if (str_starts_with($confirmation, "yes")) {         
            $jsonData = json_encode($tempArray);
            file_put_contents('users.json', $jsonData);
        }
    }
?>
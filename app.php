<?php
fwrite(STDOUT, "\nAvailable commands: register, print, edit, delete.\n");

$command = fgets(STDIN);

if (str_starts_with($command, "register")) {
    require 'register.php';
}
if (str_starts_with($command, "delete")) {
    require 'delete.php';
}
if (str_starts_with($command, "print")) {
    require 'print.php';
}
if (str_starts_with($command, "edit")) {
    require 'edit.php';
}
?>
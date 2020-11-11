<?php
function echohelp($input)
{
    echo "\nUsage: ".$input." [options] \n";
    echo "\nOptions:\n -t|--ticket \t\t\tDisplay price and how many tickets are left or in stock \n";
    echo " -b|--booking \t\t\tBook tickets\n";
    echo " -c|--check = Booking number \tCheck booking status\n";
    echo " -h|--help\t\t\tprint this manual.\n";
}

?>
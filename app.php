<?php
require_once 'file\menuhelp.php';
require_once 'file\booking.php';
require_once 'file\bookinfo.php';
require_once 'file\ticket.php';
$input = $_SERVER['argv'];

$optind = NULL;
$shortopts  = "htbc::";
$longopts  = array('help','ticket','booking','check::');
$opts = getopt($shortopts, $longopts,$optind );
$args = array_slice($_SERVER['argv'], $optind); 
$checkerr=0;

//Help-------------------------------------------------------------
if(array_key_exists('help', $opts) || array_key_exists('h', $opts))
{
    if(count($args)>=1)
    {
        error($input[0]);
    }
    else
    {
    echohelp($input[0]);
    }
    $checkerr++;
}

//Display price and how many tickets are left or in stock-----------
if(array_key_exists('ticket', $opts) || array_key_exists('t', $opts))
{
    if(count($args)>=1)
    {
        error($input[0]);
    }
    else
    {
        showticket();
    }
    $checkerr++;
}

//Book Tickets-------------------------------------------------------
if(array_key_exists('booking', $opts) || array_key_exists('b', $opts))
{
    if(count($args)>=1)
    {
        error($input[0]);
    }
    else
    {
        booking();
    }
    $checkerr++;
}

//Check Book Info-------------------------------------------------------
if(array_key_exists('check', $opts) || array_key_exists('c', $opts))
{
    if(count($args)>=1)
    {
        error($input[0]);
    }
    if(!isset($opts['check']))
    {
        $opts['check'] = $opts['c']; 
    }
    else
    {
        $opts['c'] = $opts['check']; 
    }

    if($opts['check']!='')
    {
        getbookinfo(trim($opts['check']));
    }
    getbookinfo('');
    $checkerr++;
}


function error($filename)
{
    echo "\nInvalid arguments!!!\n";
    echo "Usage the following command for help.\n";
    echo $filename." -h \n";
}

if($checkerr==0){
    error($input[0]);
  
}

?>
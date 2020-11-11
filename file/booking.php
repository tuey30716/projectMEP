<?php
require_once 'file\ticket.php';
require_once 'file\bookinfo.php';
require_once 'file\writetext.php';
function booking(){

showticket();

while(1){
echo "\n\tChoose zone of ticket to book    :";
$zone=trim(fgets(STDIN));

if(strcmp($zone,"A")==0 OR strcmp($zone,"B")==0 OR strcmp($zone,"C")==0 OR strcmp($zone,"D")==0)
    {
        break;
    }
else fprintf(STDERR, "\n\tPlease Input Only Zone Name: 'A','B','C','D'\n");
}

$ticketinfo=getticketprice($zone);

while(1){
    echo "\n\tHow many tickets you want to book:";
    $ticketnum=trim(fgets(STDIN));
    if($ticketnum<=$ticketinfo['Qty'])
    {
        break;
    }
else fprintf(STDERR, "\n\tOut of ticket, Please Input Again.\n");
}

echo "\n\tPlease input your 'name lastname':";
fscanf(STDIN,"%s %s",$name,$lastname);

while(1){
echo "\n\tPlease input your email address  :";
$email=trim(fgets(STDIN));
$pattern="/\w+\@\w+\.\w+/";
if(preg_match($pattern, $email)==1){
    break;
}
else fprintf(STDERR, "\n\tError Email Format. Input Email again with 'name'@'address'.com\n");
}
echo "\n\tPlease input your phone number   :";
$phonenum=trim(fgets(STDIN));

$bookname=ucwords($name." ".$lastname);
echo "\n".str_repeat("-",55)."\n";
$bookingnumber=uniqid();
echo "\tSummary";
echo "\n\tBooking Number :".$bookingnumber;
echo "\n\tTicket Zone    :".$zone;
echo "\n\tTicket amount  :".$ticketnum;
echo "\n\tName Lastname  :".$bookname;
echo "\n\tEmail address  :".$email;
echo "\n\tPhone Number   :".$phonenum;

$totalprice=$ticketinfo['Price']*$ticketnum;
echo "\n\tTotal Price    :".number_format($totalprice, 2, '.', ',');

configqty($ticketinfo['Zone'],$ticketinfo['Qty'],$ticketnum);
writebookinfo($bookingnumber,$bookname,$zone,$ticketnum,$email,$phonenum,$totalprice);

echo "\n".str_repeat("-",55)."\n";

while(1){
echo "\nPrint Summary to text file? (y/n): ";
$answer=trim(fgets(STDIN));
if(strtolower($answer)=='y'){
    writetext($bookingnumber,$bookname,$zone,$ticketnum,$email,$phonenum,$totalprice);
    break;
}
elseif(strtolower($answer)=='n'){
break;
}
else fprintf(STDERR, "\n\tInvalid Input. Please Input Only 'y' or 'n'\n");
}
}
 ?>
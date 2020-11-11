<?php 
function writetext($bookingnumber,$bookname,$zone,$ticketnum,$email,$phonenum,$totalprice){
    $inputtext= "Booking Number :".$bookingnumber."\n";
    $inputtext.="Ticket Zone    :".$zone."\n";
    $inputtext.="Ticket amount  :".$ticketnum."\n";
    $inputtext.="Name Lastname  :".$bookname."\n";
    $inputtext.="Email address  :".$email."\n";
    $inputtext.="Phone Number   :".$phonenum."\n";
    $inputtext.="Total Price    :".number_format($totalprice, 2, '.', ',');
    file_put_contents("printsummary\\".$bookingnumber." ".$bookname.".txt",$inputtext);
}
?>
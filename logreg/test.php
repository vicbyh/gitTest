<?php
$date = '27/12/2013'; 
//Date that needs to be tested goes here 

function isItValidDate($date) {
  if(preg_match("/^(\d{2})\/(\d{2})\/(\d{4})$/", $date, $matches))
   {
    if(checkdate($matches[2], $matches[1], $matches[3]))
      {
       return true; 
      }
   }
 }

if(isItValidDate($date))
 {
  echo 'It’s a valid Date';
 }
 else
 {
 echo 'Entered Date is invalid..!!';
 }
?>
<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['mail']) && isset($_SESSION['userid'])) { 


$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');
}

else {
  session_destroy();
  header ('location: ../index.html');
} 
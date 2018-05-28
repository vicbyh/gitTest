<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['mail'])) { 


$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');
}

else {
  session_destroy();
  header ('location: ../index.html');
} 
<?php
session_start();
/* Kontrollerar att man är inloggad som admin */
if (isset($_SESSION["admin"])) { 
$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');
}

else {
  session_destroy();
  header ('location: ../index.html');
} 
?>
<!DOCTYPE html>
<html>
     <head> 
         	<link rel="stylesheet" href="logreg.css">
          <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
         	<meta charset="UTF-8">
     </head>
     <body>
           <title>Start Admin</title>
           <div class="navbar">
              <a href="../index.html">Logga ut</a>
              <a> <img src="../Bilder/header2.png" alt="logpic" id="logo"></a>
           </div>
           <div class="sidenav">
              <a href="startAdmin.php">Start</a>
              <a href="userlist.php">Användar- inställningar</a>
              <a href="alltodolists.php">Inspektera Att-göra-listor</a>
            </div>

            <p class= "hello"> Hej och välkommen Tjänsteleverantör! </p>
            <div class="bildanv">
              <img src="../Bilder/admincool.gif" alt="nicepic" id= "underbild">
            </div>  

          		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
          		<script src="logreg.js"></script>
     </body>
</html>
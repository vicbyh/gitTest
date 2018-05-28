<?php
session_start();
$userId = $_SESSION["userid"];
if (isset($_SESSION['username']) && isset($_SESSION['mail']) && isset($_SESSION['userid'])) { 


$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');
echo '<h1>Välkommen ' .  $_SESSION['username'] . '!</h1>';
}

else {
  session_destroy();
  header ('location: login.html');
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
 <title>Start</title>
 <div class="navbar">
  <a href="logoutprocess.php">Logga ut</a>
  <a href="kontaktaoss.php">Kontakta oss</a>
  <a href="omoss.php">Om oss</a>
  <img src="../Bilder/header2.png" alt="logpic" id="logo"></a>
	</div>
<div class="sidenav">
  <a href="start.php">Start</a>
  <a href="todolist.php">Att göra-lista</a>
  <a href="schema.php">Kalender</a>
  <a href="links.php">Länkar</a>
</div>
<h1>Start</h1>
<div class="toDoToday">
  <h2>Att göra idag:<h2>
<?php $i = 1;
$todaysDate = date("d/m/Y");
$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE Datum='$todaysDate' AND Anvandar_ID='$userId' ORDER BY Tid");
while ($row = mysqli_fetch_array($tasks)) { ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td class="task"><?php echo $row['Aktivitets_Namn'];  ?> </td>
          <td class="tidRow"><?php echo "kl: "; echo $row['Tid']; echo "<br>"; ?> </td>
        </tr>
        <?php $i++; } ?>

</div>
<div class="erbjudandeIdag">
  <h2>Dagens erbjudande från mecenat</h2>
  <img src="../Bilder/erbjudande.png" alt="dagensErbjudande" id="dagensErbjudande">
  <h2>Händer på nation idag</h2>
  <img src="../Bilder/nationidag.png" alt="dagensNation" id="dagensNation">
</div>






		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="logreg.js"></script>
 </body>
</html>
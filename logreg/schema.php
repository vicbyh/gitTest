<?php 
require 'bootstrap.php';
?>

<!DOCTYPE html>
<html>
 <head> 
 	<link rel="stylesheet" href="logreg.css">
  <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
 	<meta charset="UTF-8">
 </head>
 <body>
 <title>Schema</title>
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
  <div class="schemaBtns">
  <input type="button" value="Lägg till bokning" id="bokning_Btn">
  <input type="button" value="Ta bord bokning" id="bokning_Del_Btn">
  <input type="button" value="Lägg till schemalänk" id="bokning_Del_Btn">
<div>
	<img src="../Bilder/schema.png" alt="schema" id="schema"></a>

		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="logreg.js"></script>
 </body>
</html>
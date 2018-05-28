<?php
require 'bootstrap.php';
?>
<!DOCTYPE html>
<html>
 <head> 
 	<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
  <link rel="stylesheet" href="logreg.css">
 	<meta charset="UTF-8">
 </head>
 <body>
 <title>Kontakta oss</title>
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
    <form class="kontaktaOssForm" method="POST" action="kontaktaoss.html">
        <h1>Har du feedback eller frågor? Eller behöver du support? Skriv ditt ärende här nedan</h1>
        <p><label for="mail">E-post</label></p>
        <input type="text" placeholder="Vänligen skriv in din e-post" id="kontaktaOssEpost">  
        <p><label for="arende">Ärende</label></p>
        <textarea placeholder="Skriv in ditt ärende" name="kontaktaossTxt"></textarea>  
        <p><input type="button" value="Skicka!" id="kontaktaOssBtn"></p>
    </form>

		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="logreg.js"></script>
 </body>
</html>
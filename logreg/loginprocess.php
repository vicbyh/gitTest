<?php
session_start();		

if (isset($_POST['mail']) && isset($_POST['pass']) ) { 

	$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');
	

	$mail = mysqli_real_escape_string($db,trim($_POST['mail']));
	$pass = mysqli_real_escape_string($db,trim($_POST['pass']));

	$getPass = mysqli_query($db,"SELECT Losenord FROM Anvandare WHERE Epost='$mail'");
	$getPass2 = mysqli_fetch_assoc($getPass);
	$sqlPass = $getPass2['Losenord'];

	$getSalt = mysqli_query($db,"SELECT Salt FROM Anvandare WHERE Epost='$mail'");
	$getSalt2 = mysqli_fetch_assoc($getSalt);
	$sqlSalt = $getSalt2['Salt'];

	$getUserName = mysqli_query($db,"SELECT Anvandar_Namn FROM Anvandare WHERE Epost='$mail'");
	$getUserName2 = mysqli_fetch_assoc($getUserName);
	$sqlUserName = $getUserName2['Anvandar_Namn'];

	$getUserId = mysqli_query($db,"SELECT Anvandar_ID FROM Anvandare WHERE Epost='$mail'");
	$getUserId2 = mysqli_fetch_assoc($getUserId);
	$sqlUserId = $getUserId2['Anvandar_ID'];

	$getAnvandarTyp = mysqli_query($db,"SELECT Anvandar_Typ FROM Anvandare WHERE Epost='$mail'");
	$getAnvandarTyp2 = mysqli_fetch_assoc($getAnvandarTyp);
	$sqlAnvandarTyp = $getAnvandarTyp2['Anvandar_Typ'];

	$compare = sha1($sqlSalt . $_POST['pass']);

	if ($sqlPass == $compare) {

		if ($sqlAnvandarTyp == "Kund") { 
			$_SESSION["username"] = $sqlUserName;
			$_SESSION["mail"] = $mail; 
			$_SESSION["userid"] = $sqlUserId;
			header ("location: start.php"); 
		}
		else if ($sqlAnvandarTyp == "Admin") {
			$_SESSION["admin"] = $sqlUserName;
			header ("location: startAdmin.php");
		}
	}

	else {
		echo "Fel lösenord eller mail. Du skickas tillbaka till login.";
		session_destroy();
		header("Refresh: 3; url=login.html");

	}


}
else {
	session_destroy();
	header("location: login.html");
}



?>
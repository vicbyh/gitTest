<?php
	
if (isset($_POST['alias']) && isset($_POST['mail']) && isset($_POST['pass'])) { 

$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');


$alias = mysqli_real_escape_string($db,trim($_POST['alias']));
$mail = mysqli_real_escape_string($db,trim($_POST['mail']));
$pass = mysqli_real_escape_string($db,trim($_POST['pass']));


function createsalt(){
	$myString = $_POST['alias'];
	$myArray = str_split ($myString);
	$done = "";
	for ($x = 0; $x < strlen($myString); $x++) {
		$done .= substr(sha1($myArray[$x]),rand(1,30),2);
	}
	return $done;
}

$uniquesalt = createsalt();
$hashedPass = sha1($uniquesalt . $pass);

$mailafterat = substr($mail, stripos($mail, '@') +1);

if (strlen($alias) >= 1 && strlen($mail) >= 1 && strlen($pass) >=1 && strpos($mail, '@') && strpos($mailafterat, '.') ) {

	$testalias = mysqli_query($db,"SELECT Anvandar_Namn FROM Anvandare WHERE Anvandar_Namn='$alias'");
	$testalias2 = mysqli_fetch_assoc($testalias);
	$testaliasrow = $testalias2['Anvandar_Namn'];
	$testmail = mysqli_query($db, "SELECT Epost FROM Anvandare WHERE Epost='$mail'");
	$testmail2 = mysqli_fetch_assoc($testmail);
	$testmailrow = $testmail2['Epost'];

	if ($testmailrow=="" && $testaliasrow =="") {
		mysqli_query($db, "INSERT INTO Anvandare (Anvandar_Namn, Epost, Losenord, Salt) VALUES ('$alias', '$mail', '$hashedPass', '$uniquesalt')");
		echo "Registreringen lyckades! <br> Du skickas till login-sidan!";
		header("Refresh: 3; url=login.html");
	}
	else{  
		echo "Mailen eller användarnamnet är upptaget!";
		header("Refresh: 3; url=registration.html");
	
	}

	
	}
	else {
	echo "Alla fält måste fyllas i korrekt!";
	header("Refresh: 3; url=registration.php");
	}

}
else {
	header("location: registration.html");
}

	

?>
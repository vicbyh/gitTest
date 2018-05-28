<?php
$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');

$email = mysqli_real_escape_string($db,$_POST['mail']);
$password = mysqli_real_escape_string($db,$_POST['pass']);

//hämtar lösenord och salt från databasen
$sql = "SELECT Losenord, Salt FROM Anvandare WHERE Epost = '$email'";


$result = mysqli_query($db, $sql);
$getResult = mysqli_fetch_assoc($result);


$db_password = $getResult['Losenord'];
$db_salt = $getResult['Salt'];

//jämföra det lagrade lösenordet med det användaren matar in
$compare = hash('sha256', ($db_salt . $password));

if ($compare == $db_password) 
{
	session_start();
	$_SESSION['mail'] = $email;
	header('Location: registration.html');
}
$db->close();

?>
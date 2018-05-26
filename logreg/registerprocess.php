<?php
	
$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');


$user = mysqli_real_escape_string($db,$_POST['alias']);
$email = mysqli_real_escape_string($db,$_POST['mail']);
$password = mysqli_real_escape_string($db,$_POST['pass']);

$reg = "/^[A-z0-9._]+@[A-z]+\.[a-z]+$/";

function createsalt()
{
	$string = "";
	$char = "abcdefghijklmnopqrstuvxyzåäöABCDEFGHIJKLMNOPQRSTUVXYZÅÄÖ123456789";
	$length = strlen($char);
	for ($i=0; $i < 10; $i++) { 
		$string .= $char[rand(0, $length - 1)];
	}
	return $string;
}

		if (trim($user) == "" || trim($email) == "" || trim($password) == "")
		{

			alert("Name must be filled out!!");	
		}  
		else if (!preg_match ($reg, $email))
		{
			header("Location: login.html");
		}
		else {
			$salt = createsalt();
			//krypterar lösenordet
			$hash = hash('sha256',($salt . $password));

			$sql = "INSERT INTO Anvandare (Anvandar_Namn, Epost, Losenord, Salt) VALUES ('$user', '$email', '$hash', '$salt')";

			$db->query($sql);
		}

		$db->close();

?>
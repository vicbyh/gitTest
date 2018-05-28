<?php  

$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');


$delete = mysqli_real_escape_string($db, $_POST['text']);


if (isset($_POST['submit']) && !empty($delete)){

	$sql = "DELETE FROM Anvandare WHERE Epost = '$delete'";
	mysqli_query($db, $sql);
	echo "Användare har raderats!";
	header("refresh: 2; url=userlist.php");

}

else if (isset($_POST['submitAdmin']) && !empty($delete)){
	$sql = "UPDATE Anvandare SET Anvandar_Typ = 'Admin' WHERE Epost ='$delete'";
	mysqli_query($db, $sql);
	echo "Användare är nu admin!";
	header("refresh: 2; url=userlist.php");


}

else if (isset($_POST['submitKund'])&& !empty($delete)){
	$sql = "UPDATE Anvandare SET Anvandar_Typ = 'Kund' WHERE Epost ='$delete'";
	mysqli_query($db, $sql);
	echo "Användare är nu kund!";
	header("refresh: 2; url=userlist.php");
}
else {
	echo 'Error! Undersök om du skrev in rätt mail.';
	header("refresh: 2; url=userlist.php");
}

$db->close();

?>
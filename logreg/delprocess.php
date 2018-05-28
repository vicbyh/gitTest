<?php  

$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');


$delete = mysqli_real_escape_string($db, $_POST['text']);


if (isset($delete))
{

	$sql = "DELETE FROM Anvandare WHERE Epost = '$delete'";
	mysqli_query($db, $sql);
	echo "Användare har raderats!";
	header("refresh: 2; url=userlist.php");

}

$db->close();

?>
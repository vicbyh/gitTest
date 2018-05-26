<?php 
	$errors = "";
	
$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');

if (isset($_POST['submit'])) {
	$task = $_POST['task'];
	$datum = $_POST['datum'];
	$tid = $_POST['tid'];
	if (empty($task) || empty($datum) || empty($tid)) {
		$errors = "Du måste fylla i alla fält";
	}else {
	mysqli_query($db, "INSERT INTO Aktivitet (Aktivitets_Namn, Datum, Tid) VALUES ('$task', '$datum', '$tid')");
	header('location: todolist.php');
	}
}

if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];
	mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
	header('location: todolist.php');}

$tasks = mysqli_query($db, "SELECT * FROM tasks");
	

?>
<!DOCTYPE html>
<html>
 <head> 
 	<link rel="stylesheet" href="logreg.css">
 	<meta charset="UTF-8">
 </head>
 <body>
 <title>Att göra-lista</title>
 <div class="navbar">
  <a href="#home">Logga ut</a>
  <a href="#news">Kontakta oss</a>
  <a href="#contact">Om oss</a>
  <a href="#img"> <img src="../Bilder/header2.png" alt="logpic" id="logo"></a>
	</div>
	<div class="sidenav">
  <a href="#about">Start</a>
  <a href="#services">Att göra-lista</a>
  <a href="#clients">Kalender</a>
  <a href="#contact">Mitt konto</a>
  <a href="#contact">Länkar</a>
</div>
			<div class="heading">
		<h2>Att göra-lista</h2>
	</div>
	<form method="POST" action="todolist.php" class="tdListForm">
	<?php if (isset($errors)) { ?>
		<p><?php echo $errors; ?></p>
	<?php } ?>
	
		<input type="text" name="task" class="task_input" placeholder="Skriv in aktivitet">
		<input type="text" class="datumTxt" placeholder="Skriv in datum på formen DD/MM/YY" name="datum"></input>
		<input type="text" class="tidTxt" placeholder="Skriv in klockslag på formen HH:MM, t.ex 00:00" name="tid">
		<button type="submit" class="add_btn" name="submit">Lägg till</button>
	</form>
	
	<table class="listTree">
		<thead>
			<tr>
				<th>Nr</th>
				<th>Datum</th>
				<th>Tid</th>
				<th>Att göra</th>
				<th>Radera</th>
			</tr>
		</thead>
		
		<tbody>
		<?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td class="task"><?php echo $row['task']; ?> </td>
				<td class="delete">
					<a href="todolist.php?del_task=<?php echo $row['id']; ?>">x</a>
			</tr>
		
		<?php $i++; } ?>
		
			
		</tbody>
	
	</table>
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="logreg.js"></script>
 </body>
</html>
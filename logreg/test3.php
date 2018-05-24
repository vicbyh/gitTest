<?php 
	$errors = "";
	
$db = mysqli_connect('dbtrain.im.uu.se', 'dbtrain_822', 'xbjnma', 'dbtrain_822');

if (isset($_POST['submit'])) {
	$task = $_POST['task'];
	if (empty($task)) {
		$errors = "Du måste skriva något";
	}else {
	mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
	header('location: test3.php');
	}
}

if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];
	mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
	header('location: test3.php');}

$tasks = mysqli_query($db, "SELECT * FROM tasks");
	

?>
<!DOCTYPE html>
<html>
 <head> 
 	<link rel="stylesheet" href="logreg.css">
 	<meta charset="UTF-8">
 </head>
 <body>
 <title>Logga in</title>
 <div class="navbar">
  <a href="#home">Logga ut</a>
  <a href="#news">Kontakta oss</a>
  <a href="#contact">Om oss</a>
  <a href="#img"> <img src="../Bilder/header2.png" alt="logpic" id="logo"></a>
	</div>
	<div class="sidenav">
  <a href="#about">Start</a>
  <a href="#services">Att göra-lista</a>
  <a href="#clients">Schema</a>
  <a href="#contact">Nationsguiden</a>
  <a href="#contact">Mitt konto</a>
</div>
		<h1>Att göra-lista</h1>
			<div class="heading">
		<h2>To-do lista</h2>
	</div>
	<form method="POST" action="test3.php" class="tdListForm">
	<?php if (isset($errors)) { ?>
		<p><?php echo $errors; ?></p>
	<?php } ?>
	
		<input type="text" name="task" class="task_input">
		<button type="submit" class="add_btn" name="submit">Lägg till</button>
	</form>
	
	<table class="listTree">
		<thead>
			<tr>
				<th>Nr</th>
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
					<a href="test3.php?del_task=<?php echo $row['id']; ?>">x</a>
			</tr>
		
		<?php $i++; } ?>
		
			
		</tbody>
	
	</table>
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="logreg.js"></script>
 </body>
</html>
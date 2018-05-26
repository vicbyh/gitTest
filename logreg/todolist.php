<?php 
	$errors = "";
	
$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');

if (isset($_POST['submit'])) {
	$task = $_POST['task'];
	$tid = $_POST['tid'];
	$datum = $_POST['datum'];
	$kategori = $_POST['kategori'];
	
	function isItValidDate($datum) {
  		if(preg_match("/^(\d{2})\/(\d{2})\/(\d{4})$/", $datum, $matches)){
    		if(checkdate($matches[2], $matches[1], $matches[3])){
       			return true; 
      		}
   		}
 	}

	$checked = false;
    if (preg_match('/^\d{2}:\d{2}$/', $tid)) {
        if (preg_match("/(2[0-3]|[0][0-9]|1[0-9]):([0-5][0-9])/", $tid)) {
            $checked = true;
        }
    }

	if (empty($task)) {
		$errors = "Du måste skriva något";
	}

	else if (!empty($tid) && $checked == false){
		$errors = "Fel format på tid";
	}

	else if (!empty($datum) && isItValidDate($datum) == false) {
		$errors = "Fel format på datum";
	}

	else {
	mysqli_query($db, "INSERT INTO Aktivitet (Aktivitets_Namn, Tid, Datum, Kategori) VALUES ('$task', '$tid', '$datum', '$kategori')");
	header('location: todolist.php');
	}
}

if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];
	mysqli_query($db, "DELETE FROM Aktivitet WHERE Aktivitets_ID=$id");
	header('location: todolist.php');}

	

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
		<input type="text" class="datumTxt" placeholder="Skriv in datum på formen DD/MM/YYYY (valfritt)" name="datum"></input>
		<input type="text" class="tidTxt" placeholder="Skriv in klockslag på formen HH:MM, t.ex 00:00 (valfritt)" name="tid">
		<label class="kategorier">Välj kategori</label>
		<p><select name="kategori">
  			<option value="Övrigt">Övrigt</option>
  			<option value="Studier">Studier</option>
  			<option value="Träning">Träning</option>
  			<option value="Nöje">Nöje</option>
		</select><p>
		<button type="submit" class="add_btn" name="submit">Lägg till</button>
	</form>
	<form method="POST" action="todolist.php" class="searchtdListForm">
		<h2>Sök aktivitet</h2>
		<input type="text" name="searchTask" class="searchtask_input" placeholder="Sök efter aktivitetsnamn">
		<input type="text" name="searchDatum" class="searchdatumTxt" placeholder="Sök aktivitet efter datum">
		<input type="text" name="searchTid" class="searchtidTxt" placeholder="Sök aktivitet efter tid">
		<input type="text" name="searchKategori" class="search_Kategori" placeholder="Sök aktivitet efter kategori">
		<button type="submit" class="filter_btn" name="filter">Sök</button>
	</form>

	
	<table class="listTree">
		<thead>
			<tr>
				<th>Nr</th>
				<th>Datum</th>
				<th>Tid</th>
				<th>Att göra</th>
				<th>Färdig</th>
				<th id="kal">Lägg till i kalender</th>
				<th>Kategori</th>
			</tr>
		</thead>
		
		<tbody>
		<?php $i = 1; 
			if(!isset($_POST['filter'])) { 
				$tasks = mysqli_query($db, "SELECT * FROM Aktivitet"); } 
				while ($row = mysqli_fetch_array($tasks)) { ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td class="datumRow"><?php echo $row['Datum']; ?> </td>
					<td class="tidRow"><?php echo $row['Tid']; ?> </td>
					<td class="task"><?php echo $row['Aktivitets_Namn']; ?> </td>
					<td class="delete">
						<a href="todolist.php?del_task=<?php echo $row['Aktivitets_ID']; ?>">√</a> </td>
					<td class="addKalender"><a href="#add">+</a></td>
					<td class="categorys"><?php echo $row['Kategori']; ?> </td>
				</tr>
		
		<?php $i++; } ?>
		
			
		</tbody>
	
	</table>
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="logreg.js"></script>
 </body>
</html>
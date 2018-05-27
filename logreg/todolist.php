<?php 
	$errors = "";
	
$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');

if (isset($_POST['submit'])) {
	$task = mysqli_real_escape_string($db, trim($_POST['task']));
	$tid = mysqli_real_escape_string($db, trim($_POST['tid']));
	$datum = mysqli_real_escape_string($db, trim($_POST['datum']));
	$kategori = mysqli_real_escape_string($db, trim($_POST['kategori']));
	
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
		<h3>(Du kan söka på ett eller flera fält)</h3>
		<input type="text" name="searchTask" class="searchtask_input" placeholder="Sök efter aktivitetsnamn">
		<input type="text" name="searchDatum" class="searchdatumTxt" placeholder="Sök aktivitet efter datum">
		<input type="text" name="searchTid" class="searchtidTxt" placeholder="Sök aktivitet efter tid">
		<input type="text" name="searchKategori" class="search_Kategori" placeholder="Sök aktivitet efter kategori">
		<button type="submit" class="filter_btn" name="filter">Sök</button>
			<form method="POST" action="todolist.php" class="refreshToDoList">
				<button type="submit" class="refresh_btn" name="refresh">Ta bort sökning</button>
			</form>
	</form>

	
	<table class="listTree">
		<thead>
			<tr>
				<th>Nr</th>
				<th>Datum</th>
				<th>Tid</th>
				<th>Att göra</th>
				<th>Kategori</th>
				<th>Färdig</th>
				<th id="kal">Lägg till i kalender</th>
				
			</tr>
		</thead>
		
		<tbody>
		<?php $i = 1; 
			if(!isset($_POST['filter'])) { 
				$tasks = mysqli_query($db, "SELECT * FROM Aktivitet"); }
				else {
					$searchTask = mysqli_real_escape_string($db, trim(strtolower($_POST['searchTask'])));
					$searchDatum = mysqli_real_escape_string($db, trim(strtolower($_POST['searchDatum'])));
					$searchTid = mysqli_real_escape_string($db, trim(strtolower($_POST['searchTid'])));
					$searchKategori = mysqli_real_escape_string($db, trim(strtolower($_POST['searchKategori'])));

						if (!empty($searchTask) && empty($searchDatum) && empty($searchTid) && empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Aktivitets_Namn)='$searchTask'");
						}
						else if (empty($searchTask) && !empty($searchDatum) && empty($searchTid) && empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Datum)='$searchDatum'");
						}
						else if (empty($searchTask) && empty($searchDatum) && !empty($searchTid) && empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Tid)='$searchTid'");
						}
						else if (empty($searchTask) && empty($searchDatum) && empty($searchTid) && !empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Kategori)='$searchKategori'");
						}
						else if (!empty($searchTask) && !empty($searchDatum) && empty($searchTid) && empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Aktivitets_Namn)='$searchTask' AND LOWER(Datum)='$searchDatum'");
						}
						else if (!empty($searchTask) && empty($searchDatum) && !empty($searchTid) && empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Aktivitets_Namn)='$searchTask' AND LOWER(Tid)='$searchTid'");
						}
						else if (!empty($searchTask) && empty($searchDatum) && empty($searchTid) && !empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Aktivitets_Namn)='$searchTask' AND LOWER(Kategori)='$searchKategori'");
						}
						else if (empty($searchTask) && !empty($searchDatum) && !empty($searchTid) && empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Datum)='$searchDatum' AND LOWER(Tid)='$searchTid'");
						}
						else if (empty($searchTask) && !empty($searchDatum) && empty($searchTid) && !empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Datum)='$searchDatum' AND LOWER(Kategori)='$searchKategori'");
						}
						else if (empty($searchTask) && empty($searchDatum) && !empty($searchTid) && !empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Tid)='$searchTid' AND LOWER(Kategori)='$searchKategori'");
						}
						else if (!empty($searchTask) && !empty($searchDatum) && !empty($searchTid) && empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Tid)='$searchTid' AND LOWER(Aktivitets_Namn)='$searchTask' AND LOWER(Datum)='$searchDatum'");
						}
						else if (!empty($searchTask) && !empty($searchDatum) && empty($searchTid) && !empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Kategori)='$searchKategori' AND LOWER(Aktivitets_Namn)='$searchTask' AND LOWER(Datum)='$searchDatum'");
						}
						else if (!empty($searchTask) && empty($searchDatum) && !empty($searchTid) && !empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Kategori)='$searchKategori' AND LOWER(Aktivitets_Namn)='$searchTask' AND LOWER(Tid)='$searchTid'");
						}
						else if (empty($searchTask) && !empty($searchDatum) && !empty($searchTid) && !empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Kategori)='$searchKategori' AND LOWER(Datum)='$searchDatum' AND LOWER(Tid)='$searchTid'");
						}
						else if (!empty($searchTask) && !empty($searchDatum) && !empty($searchTid) && !empty($searchKategori)){
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE LOWER(Kategori)='$searchKategori' AND LOWER(Datum)='$searchDatum' AND LOWER(Tid)='$searchTid' AND LOWER(Aktivitets_Namn)='$searchTask'");
						}
						else if (empty($searchTask) && empty($searchDatum) && empty($searchTid) && empty($searchKategori)){
							echo '<p style="color: red; text-align: center">Du måste fylla i minst ett sökfält!</p>';
							$tasks = mysqli_query($db, "SELECT * FROM Aktivitet");
						}


				} 
				while ($row = mysqli_fetch_array($tasks)) { ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td class="datumRow"><?php echo $row['Datum']; ?> </td>
					<td class="tidRow"><?php echo $row['Tid']; ?> </td>
					<td class="task"><?php echo $row['Aktivitets_Namn']; ?> </td>
					<td class="categorys"><?php echo $row['Kategori']; ?> </td>
					<td class="delete">
						<a href="todolist.php?del_task=<?php echo $row['Aktivitets_ID']; ?>">√</a> </td>
					<td class="addKalender"><a href="#add">+</a></td>
					
				</tr>
		
		<?php $i++; } ?>
		
			
		</tbody>
	
	</table>
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="logreg.js"></script>
 </body>
</html>
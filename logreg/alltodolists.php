<?php
session_start();
if (isset($_SESSION["admin"])) { 
$db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');
}

else {
  session_destroy();
  header ('location: ../index.html');
}
?>
<!DOCTYPE html>
<html>
 <head> 
    <title>Användar Lista</title>
    <link rel="stylesheet" href="logreg.css">
    <meta charset="UTF-8">
 </head>
 <body>
    <title>Schema</title>
           <div class="navbar">
              <a href="logoutprocess.php">Logga ut</a>
              <a> <img src="../Bilder/header2.png" alt="logpic" id="logo"></a>
           </div>
            <div class="sidenav">
              <a href="startAdmin.php">Start</a>
              <a href="userlist.php">Användar- inställningar</a>
              <a href="alltodolists.php">Inspektera Att-göra-listor</a>
            </div>
            
        <div class= "todouserlist">     
        <h1>Lista över allas Att-göra-listor</h1>
        </div>
        <form name="searchToDolistUsers" method="POST" action="alltodolists.php">
          <label for="listinput">Sök användares att göra-lista</label>
            <input type="text" placeholder="Ange ett Användar-id" name="searchtdlist">
            <input type="submit" value="Sök!" id="searchtdlist_Btn" name="submit_Btn">
        </form>

        <table class="listTree">
    <thead>
      <tr>
        <th>Nr</th>
        <th>Datum</th>
        <th>Tid</th>
        <th>Att göra</th>
        <th>Kategori</th>
        
      </tr>
    </thead>
    
    <tbody>
    <?php $i = 1; $tasks=''; 
        /* om man som adming har gjort en sökning på ett användar-id matas dennes todolist ut */
        if (isset($_POST['submit_Btn'])){  
            $search = mysqli_real_escape_string($db, trim($_POST['searchtdlist']));

            $tasks = mysqli_query($db, "SELECT * FROM Aktivitet WHERE Anvandar_ID='$search' ORDER BY Datum"); 
            
           

          while ($row = mysqli_fetch_array($tasks)) { ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td class="datumRow"><?php echo $row['Datum']; ?> </td>
          <td class="tidRow"><?php echo $row['Tid']; ?> </td>
          <td class="task"><?php echo $row['Aktivitets_Namn']; ?> </td>
          <td class="categorys"><?php echo $row['Kategori']; ?> </td>
          
        </tr>
    
    <?php $i++; } }?>
    
      
    </tbody>
  
  </table>
       
    
 </body>

</html>
 
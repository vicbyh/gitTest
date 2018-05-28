
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
              <a href="../index.html">Logga ut</a>
              <a> <img src="../Bilder/header2.png" alt="logpic" id="logo"></a>
           </div>
            <div class="sidenav">
              <a href="startAdmin.php">Start</a>
              <a href="userlist.php">Kund- inställningar</a>
            </div>
            
        <div class= "Textuserlist">     
        <h1>Lista över registrerade användare </h1>
        </div>
       

        <table class= "Userlist">
                <tr class="trlist">
                    <!--skapar kolumner för varje "rad" i databasen -->
                    <th>Användarnamn</th>
                    <th>Epost</th>
                </tr>
   
                <?php
                $db = mysqli_connect('localhost', 'root', 'root', 'Studenthjalpen');
                $query = "SELECT * FROM Anvandare";

                $sql = $db -> query($query);

                while ($row = mysqli_fetch_assoc($sql)) 
                {
                    echo "<tr>";
                        echo "<td>".$row["Anvandar_Namn"]."</td>";
                        echo "<td>".$row["Epost"]."</td>";
                    echo "</tr>";

                }
                
                ?>
        </table>

   <form id="for" name="for" method="post" action="delprocess.php">
         <p class= "delanv">Skriv in epost på den användare du önskar radera</p>
        <p><textarea name="text" id="text" cols="40" rows="3"></textarea></p>
        <p><input type="submit" name="submit" id="submit" value="Ta bort användare" class= "UserlistBtn"></p>
   </form>

    
 </body>

</html>
 
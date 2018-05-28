
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
            

        <img src="../Bilder/header2.png" alt="logpic" id="logo">
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

                /*$email = mysqli_real_escape_string($db, $_POST['Epost']);
                $sql = "DELETE * FROM Anvandare WHERE Epost = '$email'";
               

                if ($db->query($sql) === TRUE)
                {
                    echo "succes ta bort";
                }
                else
                {
                    echo "fel vid borttagning";
                }

                header('location: Userlist.php');
                $db->close(); */

                ?>
        </table>


   <p><input type="reset" name="rensa" id="rensa" value="Ta bort användare" class="UserlistBtn" ></p>
 </body>

</html>
 
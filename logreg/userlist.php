
<!DOCTYPE html>
<html>
 <head> 
    <title>Användar Lista</title>
    <link rel="stylesheet" href="logreg.css">
    <meta charset="UTF-8">
 </head>
 <body>
        <img src="../Bilder/header2.png" alt="logpic" id="logo">
        <h1>Lista över registrerade användare</h1>
        <table width="600" border="1" cellpadding="1" cellspacing="1" class= "Userlist">
                <tr>
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
 </body>
</html>
 
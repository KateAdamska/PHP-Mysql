<?php
include 'connect.php';
?>
<style>
<?php
include 'style.css';
?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anketa</title>
</head>
<body>
    <?php
     if(!($con = $connect)) {
            die("Nelze se připojit k databázovému serveru");
        }
 
    if(isset($_POST['odeslat'])) {
   
        $otazka = addslashes($_POST['otazka']);
        $query = "INSERT INTO otazkyanketa VALUES(default,'$otazka')";
        if(mysqli_query($con, $query)) {
            echo "Úspěšně vloženo";
        } else {
            echo "Nelze provést dotaz";
        }
    }
    $query = "SELECT id_otazka, text_otazka FROM otazkyanketa";       
    if (!($vysledek = mysqli_query($con, $query))) {
            die("Nelze se připojit!");
            }
                echo "<table><thead><tr><th>Otázky</th><th>Info</th></tr></thead><tbody>";
            while($radek = mysqli_fetch_array($vysledek)) {
                    echo "<tr><td>".$radek['text_otazka']."</td><td><a href='details.php?id=".$radek['id_otazka']."' title='Seznam otázek'>Bližsí informace</a></td></tr>";
                }
                echo"</tbody></table>";
            mysqli_free_result($vysledek);
            mysqli_close($con);

    ?>
    <h1>Anketa</h1>
    <div class="form">
    <form action="index.php" method="post">
        <textarea name="otazka" cols="30" rows="5">Zadejte otázku</textarea><br>
        <input type="submit" class="btn" name="odeslat" value="Odeslat">
    </form>
    </div>
    <p><a href="vypis.php">Výpis otázek a odpovědí</a></p>
    
</body>
</html>
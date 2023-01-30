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
    <title>Výpis</title>
</head>
<body>
     <?php
     if(!($con = $connect)) {
            die("Nelze se připojit k databázovému serveru");
        }

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "UPDATE odpovedianketa SET pocet_hlasu = pocet_hlasu + 1 WHERE id_odpoved='$id'";
            header ('location:vypis.php');     
            if (!($vysledek = mysqli_query($con, $query))) {
            die("Nelze se připojit!");
            }
        }
    $query = "SELECT * FROM otazkyanketa";       
    if (!($vysledek = mysqli_query($con, $query))) {
            die("Nelze se připojit!");
            }
        echo "<h2>Otázky a odpovědi</h2>";
            while($radek = mysqli_fetch_array($vysledek)) {
                    echo "<p class='questions'>".$radek['text_otazka']."</p>
                    ";

                    $id2 = $radek['id_otazka'];
                    $query2 = "SELECT * FROM odpovedianketa WHERE id_otazka = $id2";
                    if (!($vysledek2 = mysqli_query($con, $query2))) {
                    die("Nelze se připojit!");
                    }
                    echo "<table class='secTable'>";
                    while ($radek2 = mysqli_fetch_array($vysledek2)) {
                    echo "<tr><td>".$radek2['text_odpoved']."</td>
                    <td><a href='vypis.php?id=".$radek2['id_odpoved']."' title='Seznam otázek'>".$radek2['pocet_hlasu']."</a></td></tr>"
                    ;
                    }
                    echo "</table>";
                }
            mysqli_free_result($vysledek);
            mysqli_close($con);
    ?>  
</body>
</html>
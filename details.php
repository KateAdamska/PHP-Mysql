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
    <title>Detaily</title>
</head>
<body>
     <?php
    if(!($con = $connect)) {
        die("Nelze se připojit k databázovému serveru!");
    }
        if(isset($_POST['odeslat2'])) {
        $odpoved = addslashes($_POST['odpoved']);
        $idodpoved = addslashes($_POST['id_odpoved']);
        $query = "INSERT INTO odpovedianketa(id_otazka, text_odpoved) VALUES('$idodpoved','$odpoved')";
        if(mysqli_query($con, $query)) {
            echo "Úspěšně vloženo";
        } else {
            echo "Nelze provést dotaz";
        }
    }
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT text_otazka FROM otazkyanketa WHERE id_otazka='$id'";
        if(!($vysledek = mysqli_query($con, $query))) {
            die("Nelze provést dotaz!");
        }
       echo "<h2>Otázky</h2>
       <table class='secTable' border='1'>
       <tbody>";
       
        while($row = mysqli_fetch_array($vysledek)) {
            echo"<tr><td>".$row['text_otazka']."</td></tr>";
        }
        echo "</tbody></table>";
        mysqli_free_result($vysledek);

         $query = "SELECT text_odpoved FROM odpovedianketa WHERE id_otazka='$id'";
        if(!($vysledek = mysqli_query($con, $query))) {
            die("Nelze provést dotaz!");
        }
        
       echo "<h2>Odpovědi</h2>
       <table class='secTable' border='1'>
       <tbody>";
       
        while($row = mysqli_fetch_array($vysledek)) {
            echo"<tr><td>".$row['text_odpoved']."</td></tr>";
        }
        echo "</tbody></table>";
        mysqli_free_result($vysledek);
        mysqli_close($con);
    }
    ?>
    <h2>Odpověď</h2>
    <div class="form">
    <form action="details.php?id=<?php echo $id;?>" method="post">
        <textarea name="odpoved" cols="30" rows="5">Zadejte odpověď</textarea><br>
        <input type="submit" class="btn" name="odeslat2" value="Odeslat">
        <input type="hidden" name="id_odpoved" value="<?php echo $id;?>">
    </form>
    </div>
    <?php


    ?>
</body>
</html>
<?php
include_once 'connect.php';
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Přidání produktu</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<header>
    <h1>Přidání produktu</h1>
    <?php
    include_once 'header.php';
    ?>
</header>
<div class="content">
    <h2>Přidání produktu do databáze</h2>
    <form action="" enctype="multipart/form-data" method="post">
    <table>
        <tr>
            <td><label for="nazev">Název produktu</label></td>
            <td><input type="text" name="nazevP" id="nazev"></td>
        </tr>
        <tr>
            <td><label for="cena">Cena</label></td>
            <td><input type="number" step="0.01" name="cenaP" id="cena" min="1" max="100000"></td>
        </tr>
        <tr>
            <td><label for="popis">Popis produktu</label></td>
            <td><textarea id='popis' name='popisP'></textarea></td>
        </tr>
        <tr>
            <td><label for="obr">Vyberte obrazek</label></td>
            <td><input type="file" name="file"></td>
        </tr>
        <tr>
            <td><label for="pocet">Pocet na sklade</label></td>
            <td><input type="number" step="any" name="pocetP" id="pocet" min="0" max="10000"></td>
        </tr>
        <tr>
            <td><input type="submit" name="odeslat" id="odeslat"></td>
        </tr>
    </table>
    </form>
</div>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["odeslat"])){
        if(!(isset($_POST["nazevP"]) && isset($_POST["cenaP"]) && isset($_POST["cestaP"]) && isset($_POST["pocetP"])));
        $file = $_FILES["file"];
        $fileName = $_FILES["file"]["name"];
        $fileTmpName = $_FILES["file"]["tmp_name"];
        $fileSize = $_FILES["file"]["size"];
        $fileError = $_FILES["file"]["error"];
        $fileType = $_FILES["file"]["type"];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');
        if(in_array($fileActualExt, $allowed)){
            if ($fileError === 0){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'imgs/'.$fileNameNew;
                $cesta = './'.$fileDestination;
                move_uploaded_file($fileTmpName, $fileDestination);
                echo "Obrázek byl úspěšně nahrán<br>";
            }else{
                echo "Chyba při nahrávání obrázku";
                return;
            }
        }else{
            echo "Nesprávný formát obrázku";
            return;
        }

        $nazev = $_POST["nazevP"];
        $cena = $_POST["cenaP"];
        $popis = $_POST["popisP"];

        $pocet = $_POST["pocetP"];

        $sql = "INSERT INTO produkty VALUES (default,'$nazev', '$cena', '$popis', '$cesta', '$pocet')";
        if (mysqli_query($conn, $sql)) {
            echo "Produkt byl úspěšně přidán do databáze.";
        } else {
            echo "Error";
        }
    }
}
mysqli_close($conn);
include_once 'footer.php';
?>

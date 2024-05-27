<?php
require_once 'connect.php';
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Seznam dílů</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
<header>
    <h1>Úprava záznamu</h1>
    <?php
    include_once 'header.php';
    ?>
</header>
<div class="content">
    <h2>Úprava infromací o dílu</h2>

    <form action="" enctype="multipart/form-data" method="post">
        <table>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['Edit'])){
                $id = $_POST['id_produktu'];
                $sql = "SELECT * FROM produkty WHERE id_produktu = '$id'";
                $res=mysqli_query($conn,$sql);
                if (mysqli_num_rows($res) > 0) {
                    $row = mysqli_fetch_assoc($res);
                    $id2 = $row['id_produktu'];
                    $nazev = $row['nazev_produktu'];
                    $cena = $row['cena'];
                    $popis = $row['popis'];
                    $pocet = $row['pocet_na_sklade'];
                    echo "<tr>
                <td>
                <input type='hidden' value='$id' name='id'>
                <label for='nazev'>Název produktu</label></td>
               
                <td><input type='text' name='nazevP' id='nazev' value='$nazev'></td>
            </tr>
            <tr>
                <td><label for='cena'>Cena</label></td>
                <td><input type='number' step='0.01' name='cenaP' id='cena' value='$cena' min='1' max='100000'></td>
            </tr>
            <tr>
                <td><label for='popis'>Popis produktu</label></td>
                <td><textarea id='popis' name='popisP'>".$popis."</textarea></td>
            </tr>
            <tr>
                <td><label for='pocet'>Pocet na sklade</label></td>
                <td><input type='number' step='any' name='pocetP' id='pocet' value='$pocet' min='0' max='10000'></td>
            </tr>
            <tr>
                <td><input type='submit' name='odeslat' id='odeslat'></td>
            </tr>";
                }
                }
            }else{
                echo "Žádný záznam nebyl nalezen";
            }

            ?>

        </table>
    </form>

</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST["odeslat"])){
        $id = $_POST['id'];
        $nazev = $_POST["nazevP"];
        $cena = $_POST["cenaP"];
        $popis = $_POST["popisP"];
        $pocet = $_POST["pocetP"];
        $sql = "UPDATE `produkty` SET `nazev_produktu`='$nazev',`cena`='$cena',`popis`='$popis',`pocet_na_sklade`='$pocet' WHERE id_produktu = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "Úprava proběhla úspěšně";
        }
        else{
            echo "Úprava se nezdařila";
        }
    }
}


mysqli_close($conn);
require_once 'footer.php';
?>

<?php
require_once 'connect.php';
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Rozšířené hledání produktů</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<header>
    <h1>Rozšířené hledání produktu</h1>
    <?php include_once 'header.php'; ?>
</header>
<div class="content">
    <h2>Vyhledejte produkt podle ID nebo názvu</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="hledany_produkt" placeholder="Zadejte název produktu">
        <input type="number" name="hledane_id" step="any" placeholder="Zadejte ID produktu">
        <input type="submit" name="hledat" value="Hledat">
    </form>
    <table>
        <?php
        $sql = "SELECT * FROM produkty";
        if ($_POST) {
            $hledane_id = isset($_POST["hledane_id"]) ? intval($_POST["hledane_id"]) : null;
            $hledany_produkt = isset($_POST["hledany_produkt"]) ? $_POST["hledany_produkt"] : null;

            if (isset($_POST["hledat"])) {
                if ($hledane_id && $hledany_produkt) {
                    $sql = "SELECT * FROM produkty WHERE id_produktu = $hledane_id OR nazev_produktu LIKE '%" . mysqli_real_escape_string($conn, $hledany_produkt) . "%'";
                } elseif ($hledane_id) {
                    $sql = "SELECT * FROM produkty WHERE id_produktu = $hledane_id";
                } elseif ($hledany_produkt) {
                    $sql = "SELECT * FROM produkty WHERE nazev_produktu LIKE '%" . mysqli_real_escape_string($conn, $hledany_produkt) . "%'";
                }

                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<tr><th>id</th><th>název</th><th>Cena</th><th>Popis</th><th>Obrazek</th><th>Pocet na skladě</th><th>Odstranit</th><th>Edit</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . $row["id_produktu"] . "</td>
                            <td>" . $row["nazev_produktu"] . "</td>
                            <td>" . $row["cena"] . "</td>
                            <td>" . $row["popis"] . "</td>
                            <td><img src='" . $row["cesta_k_obrazku"] . "' alt='Obrazek' class='seznam_img'></td>
                            <td>" . $row["pocet_na_sklade"] . "</td>
                            <td><form action='' method='post' enctype='multipart/form-data'>
                                <input type='hidden' name='id_produktu' value='" . $row["id_produktu"] . "'>
                                <input type='submit' name='odstranit' value='Odstranit' class='delete_seznam'>
                            </form></td>
                            <td><form action='edit.php' method='post' enctype='multipart/form-data'>
                                <input type='hidden' name='id_produktu' value='" . $row["id_produktu"] . "'>
                                <input type='submit' name='Edit' value='Edit' class='delete_seznam'>
                            </form></td>
                        </tr>";
                    }
                } else {
                    echo "0 výsledků";
                }
            }
        }
        ?>
    </table>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['odstranit'])) {
        $id_produktu = $_POST['id_produktu'];
        $sql = "DELETE FROM produkty WHERE id_produktu = $id_produktu";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            echo "Produkt byl úspěšně odstraněn.";
        } else {
            echo "Chyba při odstraňování záznamu";
        }
    }
}
mysqli_close($conn);
require_once 'footer.php';
?>
</body>
</html>

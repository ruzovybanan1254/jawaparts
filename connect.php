<?php
$servername = "localhost";
$username = "uz1";
$password = "Lisztwante128.";
$dbname = "lisztwan";

// Vytvoření připojení

$conn = new mysqli($servername, $username, $password, $dbname) or die("Error pripojeni");

$sql = "CREATE TABLE IF NOT EXISTS produkty (
    id_produktu INT PRIMARY KEY AUTO_INCREMENT,
    nazev_produktu VARCHAR(255) NOT NULL,
    cena DECIMAL(10, 2) NOT NULL,
    popis TEXT,
    cesta_k_obrazku VARCHAR(255),
    pocet_na_sklade INT NOT NULL
);";

$result = mysqli_query($conn,$sql);

?>
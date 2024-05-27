<?php
include_once 'connect.php';
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Domovská stránka</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<header>
    <h1>Domovská stránka</h1>
<?php
include_once 'header.php';
?>
</header>
<div class="content">
    <h2>Evidence produktu JAWA Kývačka</h2>
    <p>Toto je závěrečná práce z předmětu Databáze, tyto stránky byly vytvořeny pro studijní účely na SPŠE Havířov</p>
</div>

<?php
mysqli_close($conn);
include_once 'footer.php';
?>

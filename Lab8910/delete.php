<?php
$id = $_GET["id"] ?? null;

if ($id != null) {
    include_once("db_config.php");

    $cn = new mysqli($servername, $username, $password, $dbname);

    if ($cn->connect_error) {
        die($cn->connect_error);
    }

    $sql = "DELETE FROM pages WHERE id = {$id}";
    $cn->query($sql);

    $cn->close();
}

header("location:index.php");
?>

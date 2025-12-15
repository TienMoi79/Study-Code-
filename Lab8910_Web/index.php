<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Web</title>

    <style>
        ul.menu {
            margin: 0px;
            padding: 0px;
        }

        li.menu {
            display: inline;
            font-size: 20px;
        }

        a.menu {
            color: blue;
            margin-right: 5px;
            padding: 5px;
            text-decoration: none;
            border-style: solid;
            border-width: 1px;
            border-radius: 10px;
        }

        a.menu:hover {
            background-color: blue;
            color: white;
        }

        a.active {
            background-color: red;
            color: yellow;
        }

        #content {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php
$id = null;
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

include_once("db_config.php");
$cn = new mysqli($servername, $username, $password, $dbname);
if ($cn->connect_error) {
    die("Lỗi kết nối: " . $cn->connect_error);
}

$sql = "SELECT id, title FROM pages ORDER BY id";
$result = $cn->query($sql);

echo "<ul class='menu'>";
while ($row = $result->fetch_assoc()) {
    if ($id == null) {
        $id = $row["id"];
    }

    $active = "";
    if ($row["id"] == $id) {
        $active = "active";
    }

    echo "<a class='menu {$active}' href='?id={$row['id']}'><li class='menu'>{$row['title']}</li></a>";
}
echo "</ul>";

if ($id != null) {
    $sql = "SELECT content FROM pages WHERE id={$id}";
    $result = $cn->query($sql);
    $row = $result->fetch_assoc();

    echo "<div id='content'>{$row['content']}</div>";
}

$cn->close();
?>

</body>
</html>

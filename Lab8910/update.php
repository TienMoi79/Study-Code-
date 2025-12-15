<?php
include_once("db_config.php");
$id = $_POST["id"];
$action = $_POST["action"];
$cn = new mysqli($servername, $username, $password, $dbname);
if ($cn->connect_error) {
    die("Lỗi kết nối: " . $cn->connect_error);
}
if ($action == "edit") {

    $sql = "select * from pages where id = {$id}";
    $result = $cn->query($sql);
    $row = $result->fetch_assoc();

    $title = $row["title"];
    $content = $row["content"];

    $cn->close();
?>
<form method="post">
<h1>Update Page</h1>

<p>
    <label for="title">Title</label><br>
    <input type="text" id="title" name="title" required 
           value="<?= $title ?>">
</p>

<p>
    <label for="content">Content</label><br>
    <textarea id="content" name="content" required><?= $content ?></textarea>
</p>

<input type="hidden" name="action" value="update">
<input type="hidden" name="id" value="<?= $id ?>">

<p class="button">
    <input type="submit" name="save" value="Save">
    <a href="index.php"><input type="button" value="Cancel"></a>
</p>
</form>

<?php
} else if ($action == "update") {

    $title = $_POST["title"];
    $content = $_POST["content"];
    $cn = new mysqli($servername, $username, $password, $dbname);
    if ($cn->connect_error) {
        die("Lỗi kết nối: " . $cn->connect_error);
    }
    $cmd = $cn->prepare("update pages set title = ?, content = ? where id = {$id}");
    $cmd->bind_param("ss", $title, $content);

    $cmd->execute();
    $cmd->close();
    $cn->close();
    header("location:index.php?id=" . $id);
}
?>

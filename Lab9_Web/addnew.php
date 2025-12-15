<?php
if (isset($_POST["add"])) {
    include_once("db_config.php");

    $cn = new mysqli($servername, $username, $password, $dbname);

    if ($cn->connect_error) {
        die($cn->connect_error);
    }

    $title = $_POST["title"];
    $content = $_POST["content"];

    $cmd = $cn->prepare("INSERT INTO pages(title, content) VALUES (?, ?)");
    $cmd->bind_param("ss", $title, $content);

    if ($cmd->execute() === true) {
        $cn->close();
        header("location:index.php");
    } else {
        $cn->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add New</title>

    <style>
        * {
            font-family: Verdana, Tahoma, sans-serif;
            font-size: 16px;
            margin: 5px;
            box-sizing: border-box;
        }

        label {
            font-weight: bold;
        }

        .button {
            text-align: right;
            padding-right: 0px;
        }

        #title, #content {
            width: 100%;
            padding: 5px;
        }

        #content {
            height: 350px;
        }
    </style>
</head>
<body>

<form method="post" id="form">
    <h1>Add New Page</h1>

    <p>
        <label for="title">Title</label><br>
        <input type="text" id="title" name="title" required placeholder="title here">
    </p>

    <p>
        <label for="content">Content</label><br>
        <textarea id="content" name="content" required placeholder="content here"></textarea>
    </p>

    <p class="button">
        <input type="submit" name="add" value="Add">
        <a href="index.php"><input type="button" value="Cancel"></a>
    </p>

</form>

</body>
</html>

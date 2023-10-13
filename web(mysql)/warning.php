<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    $connect = mysqli_connect("localhost", "root", "1234", "bic_code");

    if (mysqli_connect_error()) {
        echo "mysql 접속중 오류가 발생했습니다.";
        echo mysqli_connect_error();
    }

    $query = "SELECT * FROM bic";
    $result = mysqli_query($connect, $query);


?>
<table border=1>

</body>
</html>
<?php
    include 'dbh.inc.php';

    $orderType = mysqli_real_escape_string($conn, $_POST["orderType"]);
    $item = mysqli_real_escape_string($conn, $_POST["item"]);
    $size = mysqli_real_escape_string($conn, $_POST["size"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);

     
?>
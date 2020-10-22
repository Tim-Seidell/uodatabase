<?php
    include_once 'dbh.inc.php';

    session_start();

    $orderType = mysqli_real_escape_string($conn, $_SESSION["editType"]);
    $item      = mysqli_real_escape_string($conn, $_SESSION["item"    ]);
    $size      = mysqli_real_escape_string($conn, $_POST["size"    ]);
    $quantity  = mysqli_real_escape_string($conn, $_POST["quantity"]);

    $sql = "INSERT INTO `current_edit`(`type`, `item`, `size`, `quantity`) VALUES ('$orderType', '$item', '$size', '$quantity')";
    mysqli_query($conn, $sql);

    /* Redirect */
    header("Location: ../editInventory.php");
?>
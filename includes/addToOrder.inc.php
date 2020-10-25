<?php
    include_once 'dbh.inc.php';

    session_start();

    $orderType = $_SESSION["orderType"];
    $item      = $_SESSION["item"];
    $size      = mysqli_real_escape_string($conn, $_POST["size"     ]);
    $quantity  = mysqli_real_escape_string($conn, $_POST["quantity" ]);

    $sql = "INSERT INTO `current_order`(`type`, `item`, `size`, `quantity`) VALUES ('$orderType', '$item', '$size', '$quantity')";
    mysqli_query($conn, $sql);

    /* unset Session Variables */
    unset($_SESSION["orderType"]);
    unset($_SESSION["uniform"]);
    unset($_SESSION["item"]);
    unset($_SESSION["size"]);

    /* Redirect */
    header("Location: ../newOrder.php");
?>
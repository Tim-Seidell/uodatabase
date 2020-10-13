<?php
    include_once 'dbh.inc.php';

    session_start();

    $orderType = $_SESSION["orderType"];
    $item      = $_SESSION["uniformItem"];
    $size      = mysqli_real_escape_string($conn, $_POST["size"     ]);
    $quantity  = mysqli_real_escape_string($conn, $_POST["quantity" ]);

    $sql = "INSERT INTO `current_order`(`type`, `item`, `size`, `quantity`) VALUES ('$orderType', '$item', '$size', '$quantity')";
    mysqli_query($conn, $sql);

    /* Redirect */
    header("Location: ../newOrder.php");
?>
<?php
    include_once 'dbh.inc.php';

    /* Drop order table */
    $sql = "DROP TABLE current_order";
    mysqli_query($conn, $sql);

    /* Recreate order table */
    $sql = "CREATE TABLE current_order (type varchar(6) not null, item varchar(20) not null, size varchar(10) not null, quantity int(3) not null);";
    mysqli_query($conn, $sql);

    // Redirect
    header("Location: ../newOrder.php");
?>
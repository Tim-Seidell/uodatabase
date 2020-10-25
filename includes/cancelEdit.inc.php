<?php
    include_once 'dbh.inc.php';

    /* Drop order table */
    $sql = "DROP TABLE current_edit";
    mysqli_query($conn, $sql);

    /* Recreate order table */
    $sql = "CREATE TABLE current_edit (type varchar(6) not null, item varchar(20) not null, size varchar(15) not null, quantity int(3) not null);";
    mysqli_query($conn, $sql);

    // Redirect
    header("Location: ../editInventory.php");



?>
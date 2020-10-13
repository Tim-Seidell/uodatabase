<?php
    include_once 'dbh.inc.php';

    $Table_Name = mysqli_real_escape_string($conn, $_POST['table_name']);
    $Column_Name = mysqli_real_escape_string($conn, $_POST['column_name']);
    $Attributes = mysqli_real_escape_string($conn, $_POST['attributes']);

    $sql = "ALTER TABLE $Table_Name ADD $Column_Name $Attributes";
    mysqli_query($conn, $sql);

    header("Location: ../manageTables.php");
?>
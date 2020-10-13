<?php
    include_once 'dbh.inc.php';

    $Table_Name = mysqli_real_escape_string($conn, $_POST['table_name']);
    $Column_Name = mysqli_real_escape_string($conn, $_POST['column_name']);

    $sql = "ALTER TABLE $Table_Name DROP $Column_Name";
    mysqli_query($conn, $sql);

    header("Location: ../manageTables.php");
?>
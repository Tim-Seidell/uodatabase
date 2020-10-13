<?php
    include_once 'dbh.inc.php';

    $Table_Name = mysqli_real_escape_string($conn, $_POST['table_name']);

    $sql_drop = "DROP TABLE $Table_Name";
    $sql_remove = "DELETE FROM list_of_uniform_items WHERE item_table_name='$Table_Name'";
    mysqli_query($conn, $sql_drop);
    mysqli_query($conn, $sql_remove);

    header("Location: ../index.php");
?>
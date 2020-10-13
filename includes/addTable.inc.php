<?php
    include_once 'dbh.inc.php';

    /* Post variables */
    $Table_Display_Name = mysqli_real_escape_string($conn, $_POST['table_display_name']);
    $Table_Name         = mysqli_real_escape_string($conn, $_POST['table_name']);
    $Table_Type         = mysqli_real_escape_string($conn, $_POST['table_type']);

    if($Table_Type == "list_of_uniform_items") {
        /* Add to list of uniform items */
        $add_to_list_sql = "INSERT INTO list_of_uniform_items VALUES ('$Table_Display_Name', '$Table_Name')";
        mysqli_query($conn, $add_to_list_sql);

        /* Add new table */
        $create_uniform_table = "CREATE TABLE $Table_Name (size varchar(5) not null, in_stock int(5) not null, issued int(5) not null, total int(5) not null);";
        mysqli_query($conn, $create_uniform_table);
    } else {
        $sql_create = "CREATE TABLE $Table_Name (id int(4) not null PRIMARY KEY AUTO_INCREMENT);";
        mysqli_query($conn, $sql_create);
    }

    /* Redirect */
    header("Location: ../index.php");
?>
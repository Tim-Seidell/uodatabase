<?php
    include_once 'dbh.inc.php';

    if(isset($_POST['newItem'])) {
        $uniform = mysqli_real_escape_string($conn, $_POST["uniform"]);
        $item_display_name = mysqli_real_escape_string($conn, $_POST["item_display_name"]);
        $item_name = mysqli_real_escape_string($conn, $_POST["item_name"]);

        /* Add to tables */
        $sql = "INSERT INTO $uniform VALUES (?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../manageTables.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $item_display_name, $item_name);
            mysqli_stmt_execute($stmt);
        }

        /* Create own table */
        $sql = "CREATE TABLE $item_name (size varchar(5) not null, in_stock int(5) not null, issued int(5) not null, total int(5) not null);";
        mysqli_query($conn, $sql);
    } else if(isset($_POST["newUniform"])) {
        $Table_Display_Name = mysqli_real_escape_string($conn, $_POST["table_display_name"]);
        $Table_Name = $Table_Display_Name . "_items";

        /* Add to appropriate tables */
        $sql = "INSERT INTO uniforms VALUES (?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../manageTables.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $Table_Display_Name, $Table_Name);
            mysqli_stmt_execute($stmt);
        }

        /* Create own table */
        $sql = "CREATE TABLE $Table_Name (item_name varchar(30) not null, item_table varchar(30) not null);";
        mysqli_query($conn, $sql);
    } else {
        header("Location: ../index.php");
        exit();
    }



/*  Old */

    /* Post variables */
    // $Table_Display_Name = mysqli_real_escape_string($conn, $_POST['table_display_name']);
    // $Table_Name         = mysqli_real_escape_string($conn, $_POST['table_name']);
    // $Table_Type         = mysqli_real_escape_string($conn, $_POST['table_type']);

    // if($Table_Type == "list_of_uniform_items") {
    //     /* Add to list of uniform items */
    //     $add_to_list_sql = "INSERT INTO list_of_uniform_items VALUES ('$Table_Display_Name', '$Table_Name')";
    //     mysqli_query($conn, $add_to_list_sql);

    //     /* Add new table */
    //     $create_uniform_table = "CREATE TABLE $Table_Name (size varchar(5) not null, in_stock int(5) not null, issued int(5) not null, total int(5) not null);";
    //     mysqli_query($conn, $create_uniform_table);
    // } else {
    //     $sql_create = "CREATE TABLE $Table_Name (id int(4) not null PRIMARY KEY AUTO_INCREMENT);";
    //     mysqli_query($conn, $sql_create);
    // }

    /* Redirect */
    header("Location: ../index.php");
?>
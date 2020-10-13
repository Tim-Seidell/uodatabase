<?php
    include_once 'dbh.inc.php';

    // Variables
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $contracted = mysqli_real_escape_string($conn, $_POST['contracted']);

    $name = $last . "_" . $first;

    // SQL Statements
    $sql_cadets = "INSERT INTO cadets (id, Firstname, Lastname, cadet_table_name, ASYear, Contracted) VALUES ('$id','$first','$last', '$name', '$year','$contracted');";
    $sql_individual = "CREATE TABLE $name (item varchar(20) not null, size varchar(10) not null, quantity int(3));";

    // Query
    mysqli_query($conn, $sql_cadets);
    mysqli_query($conn, $sql_individual);

    // Redirect
    header("Location: ../cadets.php?addcadet=success");
?>
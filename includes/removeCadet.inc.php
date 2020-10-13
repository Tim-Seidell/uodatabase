<?php
    include_once 'dbh.inc.php';

    // Variables
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $first_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Firstname From cadets WHERE id='$id';"))['Firstname'];
    $last_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Lastname From cadets WHERE id='$id';"))['Lastname'];
    $name = "$last_name" . "_" . "$first_name";

    // SQL statements
    $sql_cadet = "DELETE FROM cadets WHERE id='$id';";
    $sql_individual = "DROP TABLE $name;";
    
    // Queries
    mysqli_query($conn, $sql_cadet);
    mysqli_query($conn, $sql_individual);

    // Redirect
    header("Location: ../cadets.php?addcadet=success");
?>
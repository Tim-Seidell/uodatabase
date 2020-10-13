<?php
    require 'dbh.inc.php';

    if(isset($_POST['setting_name'])) {
        $setting_name = $_POST['setting_name'];
        $sql = "UPDATE settings SET setting=setting*(-1) WHERE setting_name = '$setting_name'";
        echo $sql;
        mysqli_query($conn, $sql);
    } else {
        echo "didn't work";
    }

    header("Location: ../settings.php");
?>
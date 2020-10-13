<?php
    session_start();
    echo $_SESSION['orderType'];
    echo $_SESSION['uniformItem'];

    $_SESSION['uniform_item'] = $_POST['item'];
    $_SESSION['order_type'] = $_POST['type'];
    if(isset($_SESSION['uniform_item'])) {
        echo $_SESSION['uniform_item'];
    } else {
        echo "not set";
    }

    //header("Location: ../test.php");
?>
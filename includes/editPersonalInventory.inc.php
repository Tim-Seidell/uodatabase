<?php
    session_start();

    include 'dbh.inc.php';

    $orderType = mysqli_real_escape_string($conn, $_SESSION["orderType"]);
    $item = mysqli_real_escape_string($conn, $_SESSION["item"]);
    $size = mysqli_real_escape_string($conn, $_POST["size"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);

    $name = mysqli_real_escape_string($conn, $_SESSION['userUid']);

    $sql = "SELECT * FROM $name WHERE item = '$item' AND size = '$size';";
    $sql_result = mysqli_query($conn, $sql);
    if($sql_result) {
        $item_exists = mysqli_num_rows($sql_result);
    } else {
        $item_exists = 0; 
    }

    if(empty($orderType) || empty($item) || empty($size) || empty($quantity) || empty($name)) {
        header("Location: ../cadetView.php?error=emptyfields");
        exit();
    }
    
    /* Add to cadet and total */
    if($orderType == "add") {

        /* Check if item already exists in cadet's inventory */
        if($item_exists == 0) {
        
            /* Item does not exist, so insert new row */
            $sql = "INSERT INTO $name (item, size, quantity) VALUES (?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../cadetView.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ssi", $item, $size, $quantity);
                mysqli_stmt_execute($stmt);
            }
        } else {

            /* Item does exist, so increment existing quantity */
            $sql = "UPDATE $name SET quantity = quantity + ? WHERE item = ? AND size = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../cadetView.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "iss", $quantity, $item, $size);
                mysqli_stmt_execute($stmt);
            }     
        }

        /* Increment master issued */
        $sql = "UPDATE $item SET issued = issued + ?, total = total + ? WHERE size = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../cadetView.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "iis", $quantity, $quantity, $size);
            mysqli_stmt_execute($stmt);
        }
    }
    
    /* Remove from cadet, add to total, decrement issued */
    else {
        
        /* Check if item already exists in cadet's inventory */
        if($item_exists == 0) {

            /* Item does not exist in cadet's inventory, send back to page with error */
            header("Location: ../cadetView.php?error=noitem");
            exit();
        } else {

            /* Item does exist in cadet's inventory, determine how many they are returning */
            $row = mysqli_fetch_assoc($sql_result);
            if($quantity > $row['quantity']) {

                /* Tried to return more than they have */
                header("Location: ../cadetView.php?error=notenough");
                exit();
            } else if($quantity == $row['quantity']) {

                /* Returning all of this item, so delete row */
                $sql = "DELETE FROM $name WHERE item = ? AND size = ?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../cadetView.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ss", $item, $size);
                    mysqli_stmt_execute($stmt);
                }    
            } else {

                /* Returning some of this item, so update quantity */
                $sql = "UPDATE $name SET quantity = quantity - ? WHERE item = ? AND size = ?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../cadetView.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "iss", $quantity, $item, $size);
                    mysqli_stmt_execute($stmt);
                }    
            }

            /* Increment master in_stock and decrement master issued */
            $sql = "UPDATE $item SET issued = issued - ?, total = total - ? WHERE size = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../cadetView.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "iis", $quantity, $quantity, $size);
                mysqli_stmt_execute($stmt);
            }    
        }
         
    }

    header("Location: ../cadetView.php?sql=success");
?>
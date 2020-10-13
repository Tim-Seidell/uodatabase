<?php
    /* Database connection */
    include_once 'dbh.inc.php';

    /* Select all in current order */
    $sql = "SELECT * FROM current_edit";
    $order_result = mysqli_query($conn, $sql);

    /* Process each row of order */
    while($order = mysqli_fetch_assoc($order_result)) {
        /* Order variables */
        $type     = $order['type'];
        $item     = $order['item'];
        $size     = $order['size'];
        $quantity = $order['quantity'];

        $master_item_exists_sql = "SELECT * FROM $item WHERE size = '$size'";
        $master_item_exists_result = mysqli_query($conn, $master_item_exists_sql);        
        if($master_item_exists_result) {
            $master_item_exists = mysqli_num_rows($master_item_exists_result);
        } else {
            $master_item_exists = 0;
        }

        $master_item_quantity_sql = "SELECT in_stock FROM $item WHERE size = '$size'";
        $master_item_quantity_result = mysqli_query($conn, $master_item_quantity_sql);
        if($master_item_quantity_result) {
            $master_item_quantity = mysqli_fetch_assoc($master_item_quantity_result)["in_stock"];
        } else {
            $master_item_quantity = 0;
        }

        if($type == "remove") { /* Remove from master */
            /* Check if quantity to be removed is in stock, if so remove, else error */
            if($master_item_exists != 0) {
                if($master_item_quantity >= $quantity) {
                    $master_update_sql = "UPDATE $item SET in_stock = in_stock - $quantity, total = total - $quantity WHERE size = '$size'";
                } else {
                    /* Error: Not enough in stock to remove */
                }
            } else {
                /* Item does not exist */
            }
        } else { /* Add to master */
            if($master_item_exists >= 1) {
                $master_update_sql = "UPDATE $item SET in_stock = in_stock + $quantity, total = total + $quantity WHERE size = '$size'";
                
            } else {
                $master_update_sql = "INSERT INTO $item (size, in_stock, issued, total) VALUES ('$size', '$quantity', 0, '$quantity')";
                /* Item does not exist to edit */
            }
        }

        mysqli_query($conn, $master_update_sql);

        /* Drop order table and recreate*/
        $sql = "DROP TABLE current_edit";
        mysqli_query($conn, $sql);

        $sql = "CREATE TABLE current_edit (type varchar(6) not null, item varchar(20) not null, size varchar(10) not null, quantity int(3) not null);";
        mysqli_query($conn, $sql);

        /* Redirect */
        header("Location: ../inventory.php");
    }
?>
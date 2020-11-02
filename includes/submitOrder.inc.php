<?php
    session_start();
    /* Database connection */
    include_once 'dbh.inc.php';

    /* Check for empty fields */
    if(empty($_POST['id']) && empty($_POST['name'])) {
        header("Location: ../signup.php?error=emptyfields");
        exit();
    }

    /* Post variables: ID or name of order recipient */
    $id   = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    /* Determine if ID or name given */
    if($name == "") {
        if($id != "") {
            $sql = "SELECT cadet_table_name FROM cadets WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            $name = mysqli_fetch_assoc($result)['cadet_table_name'];
        } else {
            header("Location: ../signup.php?error=emptyfields");
            exit();
        }
    }
    
    /* Set session variable */
    $_SESSION['selectedTable'] = $name;

    /* Select all in current order */
    $sql = "SELECT * FROM current_order";
    $order_result = mysqli_query($conn, $sql);

    /* Process each row of order */
    while($order = mysqli_fetch_assoc($order_result)) {
        /* Order variables */
        $type     = $order['type'];
        $item     = $order['item'];
        $size     = $order['size'];
        $quantity = $order['quantity'];

        /* Check cadet inventory if entry already exists */
        $cadet_item_exists_sql = "SELECT * FROM $name WHERE item = '$item' AND size = '$size'";
        $cadet_item_exists_result = mysqli_query($conn, $cadet_item_exists_sql);
        if($cadet_item_exists_result) {
            $cadet_item_exists = mysqli_num_rows($cadet_item_exists_result);
        } else {
            $cadet_item_exists = 0;
        }

        /* Check if item exists in master inventory */
        $master_item_exists_sql = "SELECT * FROM $item WHERE size = '$size'";
        $master_item_exists_result = mysqli_query($conn, $master_item_exists_sql);
        if($master_item_exists_result) {
            $master_item_exists = mysqli_num_rows($master_item_exists_result);
        } else {
            $master_item_exists = 0;
        }


        if($type == "issue") { /* Issue: Remove from master and add to cadet */
            /* Check master inventory if in stock */                
            $master_quantity_sql = "SELECT in_stock FROM $item WHERE size = '$size'";
            $master_quantity_result = mysqli_query($conn, $master_quantity_sql);
            $master_quantity = mysqli_fetch_assoc($master_quantity_result)["in_stock"];

            /* Error if there is less than 1 in stock */
            if($master_quantity >= 1) {
                /* Decrement master quantity */
                $master_decrement_sql = "UPDATE $item SET in_stock = in_stock - $quantity, issued = issued + $quantity WHERE size = '$size'";
                mysqli_query($conn, $master_decrement_sql);

                /* Update row if item already exists, create new row if not */
                if($cadet_item_exists >= 1) {
                    $cadet_update_sql = "UPDATE $name SET quantity = quantity + $quantity WHERE item = '$item' AND size = '$size'";
                    mysqli_query($conn, $cadet_update_sql);
                } else {
                    $cadet_increment_sql = "INSERT INTO $name (item, size, quantity) VALUES ('$item', '$size', '$quantity')";
                    mysqli_query($conn, $cadet_increment_sql);
                }
            } else {
                /* Error: Item not in stock*/
                header("Location: ../newOrder.php?error=nostock&item=". $item ."&size=" . $size);
                exit();
            }
        } else { /* Return: Remove from cadet and add to master */
            /* Check cadet inventory if exists */
            $cadet_quantity_sql = "SELECT quantity FROM $name WHERE size = '$size'";
            $cadet_quantity_result = mysqli_query($conn, $cadet_quantity_sql);
            $cadet_quantity = mysqli_fetch_assoc($cadet_quantity_result)["quantity"];

            /* Error if cadet has less than 1 */
            if($cadet_quantity >= 1) {
                /* Decrement cadet quantity */
                $cadet_decrement_sql = "UPDATE $name SET quantity = quantity - $quantity WHERE size = '$size'";
                mysqli_query($conn, $cadet_decrement_sql);

                /* Delete row if all of item was removed */
                if($cadet_quantity == $quantity) {
                    $delete_row_sql = "DELETE FROM $name WHERE item = '$item' AND size = '$size'";
                    mysqli_query($conn, $delete_row_sql);
                }

                /* Update row if item exists in master inventory, create new row if not*/
                if($master_item_exists >= 1) {
                    /* Update */
                    $master_update_sql = "UPDATE $item SET in_stock = in_stock + $quantity, issued = issued - $quantity WHERE size = '$size'";
                    mysqli_query($conn, $master_update_sql);
                } else {
                    /* Create */
                    $master_increment_sql = "INSERT INTO $item (size, in_stock, issued, total) VALUES ('$size', '$quantity', 0, '$quantity')";
                    mysqli_query($conn, $master_increment_sql);
                }

            } else {
                /* Error: cadet does not have enough of item */
                header("Location: ../newOrder.php?error=noitem&item=". $item ."&size=". $size);
                exit();
            }
        }

        /* Drop and recreate order table*/
        $sql = "DROP TABLE current_order";
        mysqli_query($conn, $sql);

        $sql = "CREATE TABLE current_order (type varchar(6) not null, item varchar(20) not null, size varchar(10) not null, quantity int(3) not null);";
        mysqli_query($conn, $sql);

        /* Redirect */
        header("Location: ../individualCadet.php");
    }
?>
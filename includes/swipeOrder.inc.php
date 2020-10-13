<?php
    include_once 'dbh.inc.php';

    $id        = mysqli_real_escape_string($conn, $_POST["id"       ]);
    $item      = mysqli_real_escape_string($conn, $_POST["item"     ]);
    $orderType = mysqli_real_escape_string($conn, $_POST["orderType"]);
    $size      = mysqli_real_escape_string($conn, $_POST["size"     ]);
    $quantity  = mysqli_real_escape_string($conn, $_POST["quantity" ]);

    /* Get firstname */
    $sql       = "SELECT Firstname FROM cadets WHERE id=$id";
    $result    = mysqli_query($conn, $sql);
    $firstname = mysqli_fetch_assoc($result)['Firstname'];

    /* Get lastname */
    $sql       = "SELECT Lastname  FROM cadets WHERE id=$id";
    $result    = mysqli_query($conn, $sql);
    $lastname  = mysqli_fetch_assoc($result)['Lastname'];

    $name      = $lastname . "_" . $firstname;

    /* Determine if new */
    $sql = "SELECT item FROM $name";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO $name (item, size, quantity) VALUES ('$item', '$size', '$quantity')";
        mysqli_query($conn, $sql);
    } else {
        $current_items = mysqli_fetch_assoc($result);

        $count = 0;
        foreach($current_items as $uniform_item) {
            if($uniform_item == "$item") {
                $count = $count + 1; 
                break;
            }
        }

        if($count == 0) {
            $sql = "INSERT INTO $name (item, size, quantity) VALUES ('$item', '$size', '$quantity')";
            mysqli_query($conn, $sql);
        } else {
            /* Get data */
            $sql = "SELECT * FROM $name WHERE item = '$item'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $item_name = $row["item"];
            $item_size = $row["size"];

            if($orderType == "issue") {
                $item_quantity = $row["quantity"] + $quantity;
            } else {
                $item_quantity = $row["quantity"] - $quantity;
            }

            /* Delete original entry */
            $sql = "DELETE FROM $name WHERE item = '$item'";
            mysqli_query($conn, $sql);
            
            /* Create new entry */
            $sql = "INSERT INTO $name (item, size, quantity) VALUES ('$item_name', '$item_size', '$item_quantity')";
            mysqli_query($conn, $sql);   
        }
    }

    // Redirect
    header("Location: ../index.php");
?>
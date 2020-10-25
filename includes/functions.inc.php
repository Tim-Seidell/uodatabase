<?php
    //Prints a table from table name
    function printTable($table) {
        include 'dbh.inc.php';
        //Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        //Get column names
        $sql_columns = "SELECT column_name FROM information_schema.columns WHERE table_name='$table'";
        $result_columns = mysqli_query($conn, $sql_columns);
        $resultCheck_columns = mysqli_num_rows($result_columns);
        
        //Get table data
        $sql_data = "SELECT * FROM $table";
        $result_data = mysqli_query($conn, $sql_data);
        $resultCheck_data = mysqli_num_rows($result_data);
        
        
        //Print Column names with table data
        if ($resultCheck_columns > 0 && $resultCheck_data > 0) {
            $columns = array();
            echo "<table class = \"d-flex justify-content-center\">";
            echo "<tr>";
            
            while($column_names = mysqli_fetch_assoc($result_columns)) {
                array_push($columns, $column_names["column_name"]);
                echo "<th>" . $column_names["column_name"] . "</th>";
            }
            echo "</tr>";
            
            while($row = mysqli_fetch_assoc($result_data)) {
                echo "<tr>";
                foreach ($columns as $column) {
                    echo "<td>" . $row["$column"] . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";            
        } 
        else { 
            echo "<p class = \"text-center\"> no results </p>"; 
        }

        $conn->close();
    }

    //Dropdown from table column (Table to select from, post value, display value)
    function dropdownOptions($table, $item, $table_name, $order) {
        include 'dbh.inc.php';

        if($order == "none") {
            $sql = "SELECT DISTINCT * FROM $table";
        }  else {
            $sql = "SELECT * FROM $table ORDER BY $order";
        }

        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
    
        if ($resultCheck > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value=\"" . $row["$table_name"] . "\" style=\"font-size:20px\">" . $row["$item"] . "</option>";
            }
        }
    }

    // Distinct dropdown
    function dropdownDistinct($table) {
        include 'dbh.inc.php';

        $sql = "SELECT * FROM $table ORDER BY uniform";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        

        if ($resultCheck > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value=\"" . $row["uniform_table"] . "\">" . $row["uniform"] . "</option>";
            }
        }
    }

    //Dropdown from column names
    function dropdownColumns($table) {
        include_once 'dbh.inc.php';
    
        $sql_columns = "SELECT column_name FROM information_schema.columns WHERE table_name='$table'";
        $result_columns = mysqli_query($conn, $sql_columns);
        $resultCheck_columns = mysqli_num_rows($result_columns);

        if ($resultCheck_columns > 0) {            
            while($column_names = mysqli_fetch_assoc($result_columns)) {
                echo $column_names["column_name"];
                echo "<option value=\"" . $column_names["column_name"] . "\">" . $column_names["column_name"] . "</option>";
            }
        }
    }

    // Open Page
    function openPage($page) {
        header("Location: $page");
    }

    // settings

    function setting($name) {
        require 'dbh.inc.php';
        $sql = "SELECT * FROM settings WHERE setting_name = '$name'";
        $setting = mysqli_fetch_assoc(mysqli_query($conn, $sql))['setting'];
    
        if($setting == -1) {
            echo "hidden";
        }
    }

    function settingButton($setting_name) {
        require 'dbh.inc.php';
        $sql = "SELECT * FROM settings WHERE setting_name = '$setting_name'";

        if(mysqli_fetch_assoc(mysqli_query($conn, $sql))['setting'] == 1) {
            echo '
                <form action="includes/changeSetting.inc.php" method = "post">
                    <button class = "button button_blue" style = "background-color: green" type = "submit" name = "setting_name" value = "' . strtolower($setting_name) . '">'. $setting_name . ' on</button>
                </form>    
            ';
        } else {
            echo '
                <form action="includes/changeSetting.inc.php" method = "post">
                    <button class = "button button_blue" style = "background-color: red" type = "submit" name = "setting_name" value = "' . strtolower($setting_name) . '">'. $setting_name . ' off</button>
                </form>    
            ';
        }
    }

    function dynamicOption($name, $placeholder) {
        if($name != "orderType" && $name != "editType" && $name != "size") {
            require 'dbh.inc.php';
            if($name == "uniform") {
                $uniform_table = $_SESSION[$name];
                $sql = "SELECT * FROM uniforms WHERE uniform_table = '$uniform_table';";
                $display = mysqli_fetch_assoc(mysqli_query($conn, $sql))["uniform"];
            } else if($name = "item") {
                $uniform_table = $_SESSION["uniform"];
                $sql = "SELECT * FROM uniforms WHERE uniform_table = '$uniform_table';";
                $table = mysqli_fetch_assoc(mysqli_query($conn, $sql))["uniform"];
                $item_table = $_SESSION["item"];
                echo "Name: " . $name;
                echo "\nUniform table: " .  $uniform_table;
                echo "\nItem table: " . $item_table;
                $sql = "SELECT * FROM $uniform_table WHERE item_table = '$item_table';";
                $display = mysqli_fetch_assoc(mysqli_query($conn, $sql))["item_name"];
                echo "\nsql: " . $sql;
                echo "\ndisplay: " . $display;
            }

            if(isset($_SESSION[$name])) {
                echo '<option value="">'. $display .'</option>';
            } else {
                echo '<option value="">'. $placeholder .'</option>';
            }

        } else {
            if(isset($_SESSION[$name])) {
                echo '<option value="">'. $_SESSION[$name] .'</option>';
            } else {
                echo '<option value="">'. $placeholder .'</option>';
            }
        }
    }
?>
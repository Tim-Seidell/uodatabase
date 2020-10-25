<?php require 'header.php' ?>
<div style="padding-top: 100px;"></div>
<div class="container">
    <div class = "div_card">
        <h1 class = "text text_title">New Order</h1>
        <hr>

        <div class="row">
            <div class = "col text-center">
                <h1>Add to Order</h1>
                <hr>

                <?php
                    if(isset($_GET['error'])) {                            
                        /* Empty Fields */
                        if($_GET['error'] == "emptyfields") {
                            echo "<p class = \"text error\"><i class=\"fas fa-times\" style = \"float: left; margin-left: 4px;\"></i>Please fill out all fields</p>";
                        }

                        /* Don't have item */
                        if($_GET['error'] == "noitem") {
                            echo "<p class = \"text error\"><i class=\"fas fa-times\" style = \"float: left; margin-left: 4px;\"></i>You cannot return items that you don't have</p>";
                        }

                        /* sql error */
                        if($_GET['error'] == "sqlerror") {
                            echo "<p class = \"text error\"><i class=\"fas fa-times\" style = \"float: left; margin-left: 4px;\"></i>There seems to be a problem, try again later and/or contact uo@330afrotccwg.org about the issue</p>";
                        }
                    }

                    if(isset($_GET['sql'])) {                            
                        /* Success */
                        if($_GET['sql'] == "success") {
                            echo "<p class = \"text success\"><i class=\"fas fa-check\" style = \"float: left; margin-left: 4px; padding-right: 2px;\"></i>Your edit has been processed</p>";
                        }
                    }

                    if(isset($_POST["uniform"])) {
                        $_SESSION["orderType"] = $_POST["orderType"];
                        $_SESSION["uniform"] = $_POST["uniform"];
                    }

                    if(isset($_POST["item"])) {
                        $_SESSION["item"] = $_POST["item"];
                    }

                    if(isset($_POST["size"])) {
                        $_SESSION["size"] = $_POST["size"];
                    }

                ?>
                <form action="" method = "post">
                    <select name="orderType" class = "dropdown" style = "width: 287px; height: 43px;">
                        <?php dynamicOption("orderType", "- Type -") ?>
                        <!-- <option value="">- Type -</option> -->
                        <option value="issue">Issue</option>
                        <option value="return">Return</option>
                    </select>
                    <br>
                    <select name = "uniform" style = "width: 287px; height: 43px;" class = "dropdown" onchange="this.form.submit()">
                        <?php dynamicOption("uniform", "- Uniform -") ?>
                        <!-- <option value="">- Uniform -</option> -->
                        <?php dropdownDistinct("uniforms"); ?>
                    </select>
                </form>

                <?php
                    if(isset($_POST["uniform"])) {
                        $_SESSION["orderType"] = $_POST["orderType"];
                        $_SESSION["uniform"] = $_POST["uniform"];
                    }
                ?>

                <form action="" method="post">
                    <select name="item" class = "dropdown" style = "width: 287px; height: 43px;" onchange="this.form.submit()">
                        <?php dynamicOption("item", "- Item -") ?>
                        <!-- <option value="">- Item -</option> -->
                        <?php dropdownOptions($_SESSION["uniform"], "item_name", "item_table", "item_name"); ?>
                    </select>
                </form>
                
                <?php
                    if(isset($_POST["item"])) {
                        $_SESSION["item"] = $_POST["item"];
                    }
                ?>

                <form action="includes/addToOrder.inc.php" method = "post">
                    <select name = "size" style = "width: 287px; height: 43px;" class = "dropdown">
                        <?php dynamicOption("size", "- Size -") ?>
                        <!-- <option value="">- Size -</option> -->
                        <?php dropdownOptions($_SESSION["item"], "size", "size", "size"); ?>
                    </select>
                    <br>
                    <input type="number" placeholder = "Quantity" name = "quantity" class = "input" style = "width: 287px; height: 43px;">
                    <br>
                    <input type="submit" class = "button button_blue" value = "submit" style = "width: 287px;">
                </form>

                <?php
                    if(isset($_POST["size"])) {
                        $_SESSION["size"] = $_POST["size"];
                    }
                ?>

                <h1>Submit Order</h1>
                <hr>

                <form action = "includes/submitOrder.inc.php" method = "POST">
                    <input type="text" name="id" style="width: 230px; height: 43px;" class="input" placeholder="Swipe">

                    <br>

                    <h3>Or</h3>

                    <br>

                    <select name="name" style="width: 230px" class="dropdown">
                        <option value="">- Name -</option>
                        <?php dropdownOptions("cadets", "Lastname", "cadet_table_name", "Lastname"); ?>
                    </select>
                    
                    <br>

                    <input type = "submit" style="width: 230px" class = "button button_blue" value = "Submit Order">
                </form>
            </div>

            <div class = "col-md text-center">
                <!-- Current Order -->
                <h1>Current Order</h1>
                <hr>

                <?php printTable("current_order"); ?>
                <br>
            
                <form action="includes/cancelOrder.inc.php" style = "display: block">
                    <input class = "button button_blue" style="width: 230px;" type="submit" value = "Cancel Order">
                </form>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
<?php require 'header.php'; authenticate("cadet"); ?>
<div style="padding-top: 100px;"></div>
<div class = "container-fluid">
    <div class = "div_card">
        <h1>My Personal Inventory</h1>
        <hr>

        
        <div class = "row">
            
            <!-- Edit Inventory -->
            <div class = "col-md text-center" style = "height: 600px" <?php setting("editing") ?>>
                <h1>Edit my Inventory</h1>
                <hr>
                <?php
                    if(isset($_GET['error'])) {                            
                        /* Empty Fields */
                        if($_GET['error'] == "emptyfields") {
                            echo "<p class = \"text error\"><i class=\"fas fa-times\" style = \"float: left; margin-left: 4px;\"></i>Please fill out all fields</p>";
                        }

                        /* Don't have item */
                        if($_GET['error'] == "noitem") {
                            echo "<p class = \"text error\"><i class=\"fas fa-times\" style = \"float: left; margin-left: 4px;\"></i>You do not have " . $_GET['item'] . ": " . $_GET['size'] . "</p>";
                        }

                        /* Don't have enough of item */
                        if($_GET['error'] == "notenough") {
                            echo "<p class = \"text error\"><i class=\"fas fa-times\" style = \"float: left; margin-left: 4px;\"></i>You only have " . $_GET['quantity'] . " of " . $_GET['item'] . ": " . $_GET['size'] . "</p>";
                        }

                        /* sql error */
                        if($_GET['error'] == "sqlerror") {
                            echo "<p class = \"text error\"><i class=\"fas fa-times\" style = \"float: left; margin-left: 4px;\"></i>There seems to be a problem, try again later and/or contact uo@330afrotccwg.org about the issue</p>";
                        }
                    }

                    if(isset($_GET['sql'])) {                            
                        /* Success */
                        if($_GET['sql'] == "success") {
                            echo "<p class = \"text success\"><i class=\"fas fa-check\" style = \"float: left; margin-left: 4px; padding-right: 2px;\"></i>Edit successful!</p>";
                        }
                    }

                    if(isset($_POST["uniform"])) {
                        $_SESSION["orderType"] = $_POST["orderType"];
                        $_SESSION["uniform"] = $_POST["uniform"];
                    }

                    if(isset($_POST["item"])) {
                        $_SESSION["item"] = $_POST["item"];
                    }

                    if(isset($_POST["uniform"])) {
                        $_SESSION["uniform"] = $_POST["uniform"];
                    }

                    if(isset($_POST["size"])) {
                        $_SESSION["size"] = $_POST["size"];
                    }
                ?>
                <form action="" method = "post">
                    <select name="orderType" class = "dropdown" style = "width: 230px; height: 43px">
                        <?php dynamicOption("orderType", "- Type -");?>  
                        <option value="add">Add</option>
                        <option value="remove">Remove</option>
                    </select>
                    <br>
                    <select name = "uniform" class = "dropdown" style = "width: 230px; height: 43px" onchange="this.form.submit()">
                        <?php dynamicOption("uniform", "- Uniform -");?>                        
                        <?php dropdownDistinct("uniforms"); ?>
                    </select>
                </form>

                <form action="" method="post">
                    <select name="item" class = "dropdown" style = "width: 230px; height: 43px" onchange="this.form.submit()">
                        <?php dynamicOption("item", "- Item -");?>                        
                        <?php dropdownOptions($_SESSION["uniform"],"item_name","item_table", "item_name"); ?>
                    </select>
                </form>

                <form action="includes/editPersonalInventory.inc.php" method = "post">
                    <select name = "size" class = "dropdown" style = "width: 230px; height: 43px">
                        <?php dynamicOption("size", "- Size -");?>
                        <!-- <option value="">- Size -</option> -->
                        <?php dropdownOptions($_SESSION["item"],"size","size", "size"); ?>
                    </select>
                    <br>
                    <input type="number" placeholder = "Quantity" name = "quantity" class = "input" style = "width: 230px; height: 43px">
                    <br>
                    <input type="submit" class = "button button_blue" value = "Submit" style = "width: 230px;">
                </form>
            </div>

            <div class = "col-md text-center" style = "height: 600px">
                <h1>My Inventory</h1>
                <hr>
                <div class = "container">
                    <?php 
                        include_once "includes/functions.inc.php"; 
                        ini_set("display_errors", 0);

                        printTable($_SESSION["userUid"], "item");
                    ?>
                </div>
            </div>

            <div class = "col-md text-center" style = "height: 600px">
                <h1>UO Inventory</h1>
                <hr>

                <div class = "container">
                    <div class = "row">
                        <div class = "col-md text-center">
                            <form action="" method = "post">
                                <select name = "uniform" class = "dropdown" style = "width: 230px; height: 43px" onchange="this.form.submit()">
                                    <?php dynamicOption("uniform", "- Uniform -");?>
                                    <?php dropdownDistinct("uniforms"); ?>
                                </select>
                            </form>

                            
                            <form action="" method="post">
                                <select name="item" class = "dropdown" style = "width: 230px; height: 43px" onchange="this.form.submit()">
                                    <?php dynamicOption("item", "- Item -");?>
                                    <?php dropdownOptions($_SESSION["uniform"], "item_name", "item_table", "item_name"); ?>
                                </select>
                            </form>

                            <?php echo "<h2 style = \"display: block;\">" . $_POST['item'] . "</h2>"; ?>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "col-md text-center">
                            <!-- Prints table -->
                            <?php
                                ini_set("display_errors", 0);
                                if(isset($_SESSION['item'])) {
                                    printTable($_SESSION['item'], "size");
                                } else {
                                    printTable($_POST['item'], "size");                                    
                                }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class = "row">
        <div style="padding-top: 100px;"></div>
        </div>

        <div class = "row" <?php setting("ordering") ?>>
            <div class = "col-md text-center" style = "height: 600px">
                <!-- Place an order -->
                <h1>Place an order</h1>
                <hr>

                <form action="includes/placeOrder.inc.php" method = "POST" style = "width: 100%; margin: auto;">
                    <select name = "orderType" class="dropdown" style = "width: 230px; height: 43px">
                        <option value="">- Type -</option>
                        <option value="order">Order</option>
                        <option value="return">Return</option>
                    </select>
                    <br>
                    <select name = "item" class = "dropdown" style = "width: 230px; height: 43px">
                        <option value="">- Select Item -</option>
                        <?php dropdownOptions("list_of_uniform_items","item_name","item_table_name", "item_name"); ?>
                    </select>
                    <br>
                    <input type="text" class = "input" name = "size" placeholder = "Size"  style = "width: 230px; height: 43px">
                    <br>
                    <input type="text" class = "input" name = "quantity" placeholder = "Quantity"  style = "width: 230px; height: 43px">     
                    <br>
                    <input type="submit" class = "button button_blue" name = "" value = "Submit"  style = "width: 230px;">
                </form>
            </div>
            <div class = "col-md text-center" style = "height: 600px">
                <h1>Current order</h1>
                <hr>
                
                <?php include_once 'includes/functions.inc.php'; printTable("fuentes_david", "item"); ?>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php'; ?>
<?php require 'header.php' ?>
<div style="padding-top: 100px;">
<div class = "container">
    <div class = "div_card">
        <h1 class = "text text_title">Edit Inventory</h1>
        <hr>

        <div class = "row">
            <div class = "col-md text-center">
                <!-- Add to Current Edit -->
                <h1>Add to Edit</h1>
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
                ?>
                <form action="" method = "post">
                    <select name="editType" class = "dropdown" style = "width: 230px; height: 43px;">
                        <option value="">- Add/Remove -</option>
                        <option value="add">Add</option>
                        <option value="remove">Remove</option>
                    </select>
                    <br>
                    <select name = "uniform" style = "width: 230px; height: 43px;" class = "dropdown" onchange="this.form.submit()">
                        <option value="">- Uniform -</option>
                        <?php dropdownDistinct("uniforms"); ?>
                    </select>
                </form>

                <?php
                    if(isset($_POST["uniform"])) {
                        $_SESSION["editType"] = $_POST["editType"];
                        $_SESSION["uniform"] = $_POST["uniform"];
                    }
                ?>

                <form action="" method="post">
                    <select name="item" class = "dropdown" style = "width: 230px; height: 43px;" onchange="this.form.submit()">
                        <option value="">- Item -</option>
                        <?php dropdownOptions($_SESSION["uniform"],"uniform","uniform_name", "uniform"); ?>
                    </select>
                </form>
                
                <?php
                    if(isset($_POST["item"])) {
                        $_SESSION["item"] = $_POST["item"];
                    }
                ?>

                <form action="includes/addToEdit.inc.php" method = "post">
                    <input type="text" class="input" style="width: 230px; height: 43px" name="size" placeholder="Size">
                    <br>
                    <input type="text" class="input" style="width: 230px; height: 43px" name="quantity" placeholder="Quantity">
                    
                    <br>
                    
                    <input type="submit" style="width: 230px;" class="button button_blue" value = "Add to Edit">
                </form>

                <!-- Submit Edit -->
                <h1>Submit Edit</h1>
                <hr>

                <form action = "includes/editInventory.inc.php" method = "post">
                    <div class = "container"><div class = "center_btn">
                        <input type = "submit" class = "button button_blue" value = "Submit Edit">
                    </div></div>
                </form>
            </div>

            <div class = "col-md text-center">
                <h1>Current Edit</h1>
                <hr>       
                <?php printTable("current_edit"); ?>

                <br>

                <form action="includes/cancelEdit.inc.php">
                    <input class = "button button_blue" type="submit" value = "Cancel Edit">
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php require 'footer.php' ?>
<?php require 'header.php' ?>
<div style = "padding-top: 100px"></div>
<div class = "container">
    <div class = "div_card">
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
            <select name="editType" class = "dropdown" style = "width: 287px; height: 43px;">
                <option value="">- Type -</option>
                <option value="add">Add</option>
                <option value="return">Return</option>
            </select>
            <br>
            <select name = "uniform" style = "width: 287px; height: 43px;" class = "dropdown" onchange="this.form.submit()">
                <option value="">- Uniform -</option>
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
                <option value="">- Item -</option>
                <?php dropdownOptions($_SESSION["uniform"],"uniform","uniform_name"); ?>
            </select>
        </form>
        
        <?php
            if(isset($_POST["item"])) {
                $_SESSION["item"] = $_POST["item"];
            }
        ?>

        <form action="includes/editPersonalInventory.inc.php" method = "post">
            <select name = "size" style = "width: 287px; height: 43px;" class = "dropdown">
                <option value="">- Size -</option>
                <?php dropdownOptions($_SESSION["item"],"size","size"); ?>
            </select>
            <br>
            <input type="number" placeholder = "Quantity" name = "quantity" class = "input" style = "width: 287px; height: 43px;">
            <br>
            <input type="submit" class = "button button_blue" value = "submit" style = "width: 287px;">
        </form>
    </div>
</div>
<?php $conn ?>
<?php require 'footer.php' ?>
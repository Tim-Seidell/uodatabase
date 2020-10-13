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

                <form action="" method = "post">
                    <select name="orderType" class = "dropdown" style = "width: 287px; height: 43px;">
                        <option value="">- Type -</option>
                        <option value="issue">Issue</option>
                        <option value="return">Return</option>
                    </select>
                    <select name = "item" style = "width: 287px; height: 43px;" class = "dropdown" onchange="this.form.submit()">
                        <option value="">- Select Item -</option>
                        <?php dropdownOptions("list_of_uniform_items","item_name","item_table_name"); ?>
                    </select>
                </form>

                <?php
                    if(isset($_POST['item'])) {
                        $_SESSION['orderType'] = $_POST['orderType'];
                        $_SESSION['uniformItem'] = $_POST['item'];
                    }
                ?>

                <form action="includes/addToOrder.inc.php" method = "post">
                    <select name = "size" style = "width: 287px; height: 43px;" class = "dropdown">
                        <option value="">- Size -</option>
                        <?php dropdownOptions($_SESSION['uniformItem'],"size","size"); ?>
                    </select>

                    <input type="number" placeholder = "Quantity" name = "quantity" class = "input" style = "width: 287px; height: 43px;">

                    <input type="submit" class = "button button_blue" value = "submit" style = "width: 287px;">
                </form>

                <h1>Submit Order</h1>
                <hr>

                <form action = "includes/submitOrder.inc.php" method = "POST">
                    <input type="text" name="id" style="width: 230px; height: 43px;" class="input" placeholder="Swipe">

                    <br>

                    <h3>Or</h3>

                    <br>

                    <select name="name" style="width: 230px" class="dropdown">
                        <option value="">- Name -</option>
                        <?php dropdownOptions("cadets", "Lastname", "cadet_table_name"); ?>
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
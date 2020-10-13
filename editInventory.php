<?php require 'header.php' ?>
<div style="padding-top: 100px;">
<div class = "container">
    <div class = "div_card">
        <h1 class = "text text_title">Edit Inventory</h1>
        <hr>

        <div class = "row">
            <div class = "col-md text-center">
                <!-- Add to Current Edit -->
                <h1>Add to Current Edit</h1>
                <hr>

                <form action="includes/addToEdit.inc.php" method="POST">
                    <select name = "editType" style="width: 230px; height: 43px" class="dropdown">
                        <option value = "">- Type -</option>
                        <option value = "add">Add</option>
                        <option value = "remove">Remove</option>
                    </select>
                    
                    <select name = "item" class="dropdown" style="width: 230px; height: 43px">
                        <option value="">- Select Item -</option>
                        <?php dropdownOptions("list_of_uniform_items","item_name","item_table_name"); ?>
                    </select>
                    
                    <br>

                    <input type="text" class="input" style="width: 230px; height: 43px" name="size" placeholder="Size">
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
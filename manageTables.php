<?php require 'header.php' ?>
<div style="padding-top: 100px;"></div>
<div class = "container">
    <div class = "div_card">
        <h1 class="text text_heading">Table Manager</h1>
        <hr>

        <div class = "row">
            <div class = "col-md text-center">
                <!-- Create New Item -->
                <h1 class="text">New Item</h1>
                <hr>
                <form action="includes/addTable.inc.php" method="POST">
                    <select name="uniform" class = "dropdown" style = "width: 230px; height: 43px;">
                        <option value="">- Select Uniform -</option>
                        <?php dropdownOptions("uniforms", "uniform", "uniform_table", "uniform");?>
                    </select>
                    <input type="text" class="input" name="item_display_name" placeholder="Item Name" style="width: 230px; height: 43px;">
                    <input type="text" class="input" name="item_name" placeholder="item_name" style="width: 230px; height: 43px;">
                    <button type="submit" class="button button_blue" style="width: 230px;" name = "newItem" value = "newItem">Create New Item</button>
                </form>
            </div>

            <div class = "col-md text-center">
                <!-- Create New Uniform -->
                <h1 class="text">New Uniform</h1>
                <hr>
                <form action="includes/addTable.inc.php" method="POST">
                    <input type="text" class="input" name="table_display_name" placeholder="Uniform Name" style="width: 230px; height: 43px;">
                    <input type="text" class="input" name="table_name" placeholder="uniform_name" style="width: 230px; height: 43px;">
                    <button type="submit" class="button button_blue" style="width: 230px;" name = "newUniform" value = "newUniform">Create New Uniform</button>
                </form>
            </div>

            <div class = "col-md text-center">
                <!-- Remove Table -->
                <h1 class="text">Remove Table</h1>
                <hr>
                <form action="includes/removeTable.inc.php" method="POST">
                    <input type="text" class="input" name="table_name" placeholder="table_name" style="width: 230px; height: 43px;">
                    <button type="submit" class="button button_blue" style="width: 230px;">Remove Table</button>
                </form>
            </div>
        </div>

        <div style="padding-top: 50px;"></div>

        <div class = "row">
            <div class = "col-md text-center">
                <!-- Add Column -->
                <h1 class="text">Add Column</h1>
                <hr>
                <form action="includes/addColumn.inc.php" method="POST">
                    <input type="text" class="input" name="table_name" placeholder="table_name" style="width: 230px; height: 43px;">
                    <input type="text" class="input" name="column_name" placeholder="column_name" style="width: 230px; height: 43px;">
                    <input type="text" class="input" name="attributes" placeholder="attributes" style="width: 230px; height: 43px;">
                    <button type="submit" class="button button_blue" style="width: 230px;">Add Column</button>
                </form>
            </div>

            <div class = "col-md text-center">
                <!-- Remove Column -->
                <h1 class="text">Remove Column</h1>
                <hr>
                <form action="includes/removeColumn.inc.php" method="POST">
                    <input type="text" class="input" name="table_name" placeholder="table_name" style="width: 230px; height: 43px;">
                    <input type="text" class="input" name="column_name" placeholder="column_name" style="width: 230px; height: 43px;">
                    <button type="submit" class="button button_blue" style="width: 230px;">Remove Column</button>
                </form>
            </div>

            <div class = "col-md text-center">
                <h1 class="text">Test</h1>
                <hr>
                <form action="includes/removeColumn.inc.php" method="POST">
                    <select class="dropdown" name="" style="width: 230px; height: 43px;">
                        <option value="Select Column">- Column -</option>
                        <?php
                            dropdownColumns("cadets");
                        ?>
                    </select>
                    <input type="text" class="input" name="table_name" placeholder="table_name" style="width: 230px; height: 43px;">
                    <input type="text" class="input" name="column_name" placeholder="column_name" style="width: 230px; height: 43px;">
                    <button type="submit" class="button button_blue" style="width: 230px;">Remove Column</button>
                </form>
            </div>

            <div class = "col-md text-center"></div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
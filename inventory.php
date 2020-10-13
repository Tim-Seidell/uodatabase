<?php require 'header.php' ?>
<div style = "padding-top: 100px;">
<div class = "container">
    <div class = "div_card">
        <div class = "row">
            <div class = "col-md text-center">
                <h1 class="text center">Inventory</h1></li>
                <hr>

                <form method="POST">
                    <select class="dropdown" name="selectedTable" onchange="this.form.submit()">
                        <option value="">-Select Item-</option>
                        <?php
                            ini_set("display_errors", 0);
                            dropdownOptions("list_of_uniform_items","item_name","item_table_name");
                        ?>
                    </select>
                </form>

                <?php echo "<h2 style = \"display: block;\">" . $_POST['selectedTable'] . "</h2>"; ?>
            </div>
        </div>
        
        <!-- Prints table -->
        <?php
            ini_set("display_errors", 0);
            printTable($_POST['selectedTable']);
        ?>
    </div>
</div>
</div>


<?php require 'footer.php' ?>
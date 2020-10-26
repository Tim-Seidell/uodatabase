<?php require 'header.php'; authenticate("tech");  ?>
<div style="padding-top: 100px;"></div>
<div class = "container-fluid">
    <div class = "div_card">
        <div class = "row">
            <div class = "col-md text-center">
                <h1 class="text center">Cadet Inventory</h1></li>
                <hr>
                
                <form method="POST">
                    <select class="dropdown" name="selectedTable" style = "width: 230px; height: 43px" onchange="this.form.submit()">
                        <?php dynamicOption("selectedTable", "- Select Cadet -");?>
                        <!-- <option value="">- Select Cadet -</option> -->
                        <?php dropdownOptions("cadets","Lastname","cadet_table_name", "Lastname"); ?>
                    </select>
                </form>

                <!-- Prints table -->
                <?php
                    ini_set("display_errors", 0);

                    echo "<center><h2 class=\"text\">" . $_POST['selectedTable'] . "</h2></center>";
                    if(isset($_POST['selectedTable'])) {
                        printTable($_POST['selectedTable']);
                        $_SESSION['selectedTable'] = $_POST['selectedTable'];
                    } else {
                        printTable($_SESSION['selectedTable']);                                    
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
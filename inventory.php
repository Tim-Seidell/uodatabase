<?php require 'header.php' ?>
<div style = "padding-top: 100px;">
<div class = "container">
    <div class = "div_card">
        <div class = "row">
            <div class = "col-md text-center">
                <h1 class="text center">Inventory</h1></li>
                <hr>

                <?php
                    if(isset($_POST["uniform"])) {
                        $_SESSION["uniform"] = $_POST["uniform"];
                    }
                
                    if(isset($_POST["item"])) {
                        $_SESSION["item"] = $_POST["item"];
                    }
                ?>

                <form action="" method = "post">
                    <select name = "uniform" style = "width: 287px; height: 43px;" class = "dropdown" onchange="this.form.submit()">
                        <?php dynamicOption("uniform","- Uniform -") ?>
                        <!-- <option value="">- Uniform -</option> -->
                        <?php dropdownDistinct("uniforms"); ?>
                    </select>
                </form>

                <form action="" method="post">
                    <select name="item" class = "dropdown" style = "width: 287px; height: 43px;" onchange="this.form.submit()">
                        <?php dynamicOption("item","- Item -") ?>
                        <!-- <option value="">- Item -</option> -->
                        <?php dropdownOptions($_SESSION["uniform"], "item_name", "item_table", "item_name"); ?>
                    </select>
                </form>

                <?php  ini_set("display_errors", 0); echo "<h2 style = \"display: block;\">" . $_POST['item'] . "</h2>"; ?>
            </div>
        </div>
        
        <!-- Prints table -->
        <?php
            ini_set("display_errors", 0);
            printTable($_POST['item']);
        ?>
    </div>
</div>
</div>


<?php require 'footer.php' ?>
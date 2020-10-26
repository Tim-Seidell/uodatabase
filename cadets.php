<?php require 'header.php'; authenticate("tech"); ?>
<div style="padding-top: 100px;"></div>
<div class = "container-fluid">
    <div class = "div_card">
        <div class = "row">
            <div class = "col text-center">
                <h1 class="text text_heading">Cadet Directory</h1>
                <hr>

                <a href="addCadet.php"><button class="button button_blue">Add Cadet</button></a>
                <a href="removeCadet.php"><button class="button button_blue">Remove Cadet</button></a>
                <a href="#"><button class="button button_blue">Edit Cadet</button></a>
                
                <!-- Printing table of cadets -->
                <?php
                    include_once 'includes/functions.inc.php';

                    printTable("cadets");
                ?>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
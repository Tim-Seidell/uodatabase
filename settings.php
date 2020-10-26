<?php require 'header.php'; authenticate("UO"); ?>
<div style = "padding-top: 100px;">
<div class = "container-fluid">
<div class = "div_card">
<div class = "row">
    <div class = "col-md text-center">
        <?php
            settingButton("Editing");
            settingButton("Ordering");
        ?>  
    </div>
</div>
</div>
</div>
</div>
<?php require 'footer.php' ?>
<?php require 'header.php' ?>
<div style="padding-top: 100px;"></div>
<div class = "container-fluid">
    <div class = "div_card">
        <div class = "row">
            <div class = "col text-center">
                <h1>Remove Cadet</h1>
                <hr>
                
                <form action="includes/removeCadet.inc.php" method="POST" class="center">
                    <input type="number" name="id" placeholder="Swipe" class="input center" style = "width: 230px; height: 43px" autofocus>
                    <br>

                    <a href="cadets.php"><button class="autoButton button_blue" style = "width: 230px;">Back</button></a>
                    <button type="submit" name="submit" class="autoButton button_blue" style = "width: 230px;">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
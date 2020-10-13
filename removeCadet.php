<?php require 'header.php' ?>
<div style="padding-top: 100px;"></div>
<div class = "container">
    <div class = "div_card">
        <div class = "row">
            <div class = "col text-center">
                <h1>Remove Cadet</h1>
                <hr>
                
                <form action="includes/removeCadet.inc.php" method="POST" class="center">
                    <input type="number" name="id" placeholder="Swipe" class="input center" autofocus>
                    <br>

                    <a href="cadets.php"><button class="autoButton button_blue">Back</button></a>
                    <button type="submit" name="submit" class="autoButton button_blue">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
<?php require 'header.php' ?>
<div style="padding-top: 100px;"></div>
<div class = "container">
    <div class="div_card">
        <div class = "row">
            <div class = "col text-center">
                <h1>Add Cadet</h1>
                <hr>
                
                <form action="includes/addCadet.inc.php" method="POST">
                    <input type="number" style="width: 230px" name="id" placeholder="Swipe" class="input" autofocus>
                    <br>
                    <input type="text" style="width: 230px" name="first" placeholder="First name" class="input">
                    <br>
                    <input type="text" style="width: 230px" name="last" placeholder="Last name" class="input">
                    <br>
                    <input type="number" style="width: 230px" name="year" placeholder="AS Year" class="input">
                    <br>
                    <input type="text" style="width: 230px" name="contracted" placeholder="Contracted? (Y/N)" class="input">
                    <br>
                    <button type="submit" style="width: 230px" name="submit" class="button button_blue">Submit</button>
                </form>
                <a href="cadets.php"><button class="button button_blue" style="width: 230px">Back</button></a>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
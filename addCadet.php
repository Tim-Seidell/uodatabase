<?php require 'header.php' ?>
<div style="padding-top: 100px;"></div>
<div class = "container">
    <div class="div_card">
        <div class = "row">
            <div class = "col text-center">
                <h1>Add Cadet</h1>
                <hr>
                
                <form action="includes/addCadet.inc.php" method="POST">
                    <input type="number" name="id" placeholder="Swipe" class="input" autofocus>
                    <br>
                    <input type="text" name="first" placeholder="First name" class="input">
                    <br>
                    <input type="text" name="last" placeholder="Last name" class="input">
                    <br>
                    <input type="number" name="year" placeholder="AS Year" class="input">
                    <br>
                    <input type="text" name="contracted" placeholder="Contracted? (Y/N)" class="input">
                    <br>
                    <button type="submit" name="submit" class="button button_blue">Submit</button>
                </form>
                <a href="cadets.php"><button class="button button_blue" style="width: 230px">Back</button></a>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
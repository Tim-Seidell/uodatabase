<?php require 'header.php';
if(isset($_SESSION['userId'])) {
    if($_SESSION['userUid'] != "administrator" && $_SESSION['userUid'] != "technician"){
        header("Location: index.php");        
    }
} else {
    header("Location: index.php");
}
?>
<div style="padding-top: 100px;"></div>
<div class = "container-fluid">
    <div class="div_card">
        <div class = "row">
            <div class = "col text-center">
                <h1>Add Cadet</h1>
                <hr>
                
                <form action="includes/addCadet.inc.php" method="POST">
                    <input type="number" name="id" placeholder="Swipe" class="input" style = "width: 230px; height: 43px" autofocus>
                    <br>
                    <input type="text" name="first" placeholder="First name" style = "width: 230px; height: 43px" class="input">
                    <br>
                    <input type="text" name="last" placeholder="Last name" style = "width: 230px; height: 43px" class="input">
                    <br>
                    <input type="number" name="year" placeholder="AS Year" style = "width: 230px; height: 43px" class="input">
                    <br>
                    <input type="text" name="contracted" placeholder="Contracted? (Y/N)" style = "width: 230px; height: 43px" class="input">
                    <br>
                    <button type="submit" name="submit" class="button button_blue" style = "width: 230px; height: 43px">Submit</button>
                </form>
                <a href="cadets.php"><button class="button button_blue" style="width: 230px">Back</button></a>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
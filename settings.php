<?php require 'header.php' ?>
<div style = "padding-top: 100px;">
<div class = "container">
    <div class = "div_card">
        <div class = "row">
            <div class = "col-md text-center">
                <?php
                require 'includes/dbh.inc.php';
                    $sql = "SELECT * FROM settings WHERE setting_name = 'editing'";

                    if(mysqli_fetch_assoc(mysqli_query($conn, $sql))['setting'] == 1) {
                        echo '
                            <form action="includes/changeSetting.inc.php" method = "post">

                                <button class = "button button_blue" style = "background-color: green" type = "submit" name = "setting_name" value = "editing">Editing on</button>
                            </form>    
                        ';
                    } else {
                        echo '
                            <form action="includes/changeSetting.inc.php" method = "post">

                                <button class = "button button_blue" style = "background-color: red" type = "submit" name = "setting_name" value = "editing">Editing off</button>
                            </form>    
                        ';
                    }

                    $sql = "SELECT * FROM settings WHERE setting_name = 'ordering'";

                    if(mysqli_fetch_assoc(mysqli_query($conn, $sql))['setting'] == 1) {
                        echo '
                            <form action="includes/changeSetting.inc.php" method = "post">

                                <button class = "button button_blue" style = "background-color: green" type = "submit" name = "setting_name" value = "ordering">Ordering on</button>
                            </form>    
                        ';
                    } else {
                        echo '
                            <form action="includes/changeSetting.inc.php" method = "post">

                                <button class = "button button_blue" style = "background-color: red" type = "submit" name = "setting_name" value = "ordering">Ordering off</button>
                            </form>    
                        ';
                    }

                    //setting_button("Test");
                ?>  

            </div>
        </div>
    </div>
</div>
</div>


<?php require 'footer.php' ?>
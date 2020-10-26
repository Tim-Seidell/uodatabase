<?php require 'header.php';?>
    <main>
        <div style="padding-top: 100px;"></div>
        <!-- <div class = "center" class="container col-xl-6" style = "background-color: white; padding: 50px 25px; border-radius: 10px; box-shadow: 2px 2px 5px grey;"> -->
            
            <?php
                /* Login view */
                if(isset($_SESSION['userId'])) {
                    
                    /* Cadet view */
                    if($_SESSION['userUid'] != "administrator" && $_SESSION['userUid'] != "uniform_officer" && $_SESSION['userUid'] != "technician" && $_SESSION['userUid'] != "cadre_member") {
                        header("Location: cadetView.php");
                    }
                    
                    /* Administrator */
                    else if($_SESSION['userUid'] == "administrator"){
                        echo '
                        <div class = "container-fluid d-flex justify-content-center"">
                            <div class = "div_card">
            
                                <h1 class="text text_heading center">Uniform Office Database</h1>
                                <hr>
                                
                                <ul class="button_list">
                                    <li><a href="newOrder.php"        target="_self"><button class="button button_blue">Start New Order</button></a></li>
                                    <li><a href="inventory.php"       target="_self"><button class="button button_blue">View Inventory</button> </a></li>
                                    <li><a href="cadets.php"          target="_self"><button class="button button_blue">Roster</button>         </a></li>
                                    <li><a href="editInventory.php"   target="_self"><button class="button button_blue">Edit Inventory</button> </a></li>
                                    <li><a href="manageTables.php"    target="_self"><button class="button button_blue">Manage Tables</button>  </a></li>
                                    <li><a href="report.php"          target="_self"><button class="button button_blue">Get Report</button>     </a></li> 
                                    <li><a href="individualCadet.php" target="_self"><button class="button button_blue">View Cadet</button>     </a></li>
                                    <li><a href="cadetView.php"       target="_self"><button class="button button_blue">Cadet View</button>     </a></li>
                                    <li><a href="settings.php"       target="_self"><button class="button button_blue">settings</button>     </a></li>
                                </ul>   
                            </div>
                        </div>
                        ';
                    }
                    
                    /* Uniform Officer */
                    else if($_SESSION['userUid'] == "uniform_officer"){
                        echo '
                        <div class = "container-fluid d-flex justify-content-center"">
                            <div class = "div_card">
            
                                <h1 class="text text_heading center">Uniform Office Database</h1>
                                <hr>
                                
                                <ul class="button_list">
                                    <li><a href="newOrder.php"        target="_self"><button class="button button_blue">Start New Order</button></a></li>
                                    <li><a href="inventory.php"       target="_self"><button class="button button_blue">View Inventory</button> </a></li>
                                    <li><a href="cadets.php"          target="_self"><button class="button button_blue">Roster</button>         </a></li>
                                    <li><a href="editInventory.php"   target="_self"><button class="button button_blue">Edit Inventory</button> </a></li>
                                    <li><a href="report.php"          target="_self"><button class="button button_blue">Get Report</button>     </a></li>
                                    <li><a href="individualCadet.php" target="_self"><button class="button button_blue">View Cadet</button>     </a></li>
                                </ul>
                            </div>
                        </div>
                        ';
                    }
                    
                    /* Technician */
                    else if($_SESSION['userUid'] == "technician"){
                        echo '
                        <div class = "container-fluid d-flex justify-content-center"">
                            <div class = "div_card">
            
                                <h1 class="text text_heading center">Uniform Office Database</h1>
                                <hr>
                                
                                <ul class="button_list">
                                    <li><a href="newOrder.php"        target="_self"><button class="button button_blue">Start New Order</button></a></li>
                                    <li><a href="inventory.php"       target="_self"><button class="button button_blue">View Inventory</button> </a></li>
                                    <li><a href="cadets.php"          target="_self"><button class="button button_blue">Roster</button>         </a></li>
                                    <li><a href="individualCadet.php" target="_self"><button class="button button_blue">View Cadet</button>     </a></li>
                                </ul>
                            </div>
                        </div>
                        ';
                    }
                    
                    /* Cadre */
                    else if($_SESSION['userUid'] == "cadre_member"){
                        echo '
                        <div class = "container-fluid d-flex justify-content-center"">
                            <div class = "div_card">
            
                                <h1 class="text text_heading center">Uniform Office Database</h1>
                                <hr>
                                
                                <ul class="button_list">
                                    <li><a href="inventory.php"       target="_self"><button class="button button_blue">View Inventory</button></a></li>
                                    <li><a href="cadets.php"          target="_self"><button class="button button_blue">Roster</button>        </a></li>
                                    <li><a href="individualCadet.php" target="_self"><button class="button button_blue">View Cadet</button>    </a></li>
                                </ul>
                            </div>
                        </div>
                        ';
                    } 
                } else {
                    echo '
                    <div class = "container-fluid d-flex justify-content-center"">
                        <div class = "div_card text-center">
                                        
                            <h1 class = "text text_heading">Log in</h1>
                            <hr style = "width: 50%">
                    ';

                    /* Login Error Messages */
                    if(isset($_GET['error'])) {
                        
                        /* No user */
                        if($_GET['error'] == "nouser") {
                            echo "<p class = \"text error\"><i class=\"fas fa-times\" style = \"float: left; margin-left: 4px;\"></i>User does not exist</p>";
                        }
                        
                        /* Empty Fields */
                        else if($_GET['error'] == "emptyfields") {
                            echo "<p class = \"text error\"><i class=\"fas fa-times\" style = \"float: left; margin-left: 4px;\"></i>Please enter your password</p>";
                        }
                        
                        /* Wrong Password */
                        else if ($_GET['error'] == "wrongpassword") {
                            echo "<p class = \"text error\"><i class=\"fas fa-times\" style = \"float: left; margin-left: 4px;\"></i>Incorrect password, try again</p>";
                        }
                        
                        /* SQL Error */
                        else if ($_GET['error'] == "sqlerror") {
                            echo "<p class = \"text error\"><i class=\"fas fa-times\" style = \"float: left; margin-left: 4px;\"></i>Somethings wrong, try again later</p>";
                        }
                    }

                    /* Login form */
                    echo '
                            <form action="includes/loginSystem.inc.php" method="post">
                                <input type="text"     class = "input"              name = "mailuid"  placeholder = "Username or E-mail" style = "width: 230px; height: 43px"><br>
                                <input type="password" class = "input"              name = "password" placeholder = "password" style = "width: 230px; height: 43px"><br>
                                <input type="submit"   class = "button button_blue" name = "login-submit" value = "Login" style = "width: 230px;">
                            </form>
                            
                            <h1 class = "text">or</h1>

                            <form action="includes/signup.inc.php" method  = "post">
                                <input type="submit" class = "button button_blue" value = "Sign up" style = "width: 230px;">
                            </form>
                        </div>
                    </div>
                    ';
                }
            ?>  
        </div>
    </main>
<?php require 'footer.php' ?>
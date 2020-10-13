<?php session_start(); include_once 'includes/functions.inc.php';?>

<!DOCTYPE html>
<html>
    <head>
        <title>UO Database</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link rel="stylesheet" href="custom.css">
    
        <!-- Latest compiled and minified Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Latest compiled and minified Bootstrap JavaScript -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <style>
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
                background-color: white;
                border-collapse: collapse;
                width: 100%;
                color: black;
                font-family: monospace;
                font-size: 25px;
                text-align: center;
                margin: auto;
                height: 100%;
            }

            td {
                padding-left: 10px;
                padding-right: 10px;
            }

            th {
                padding-left: 10px;
                padding-right: 10px;
                background-color: #3B7BED;
                color: white;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
        </style>
    </head>

    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php"><i style = "color: white; padding: 0px;" class="fas fa-home fa-lg icon"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="https://sites.google.com/330afrotccwg.org/det330cadetresources/home?authuser=0">Cadet Website <span class="sr-only">(current)</span></a>
                </li>
                
                </ul>
                <?php
                    if(isset($_SESSION['userId'])) {
                        echo '
                        <span style = "color: rgba(255,255,255,.5)">Logged in as: '.$_SESSION['userUid'].' </span>

                        <form  id = "logout-form" class="form-inline my-2 my-lg-0" action="includes/loginSystem.inc.php" method = "post">
                            <input class = "navbtn" type = "submit" name = "logout-submit" value = "Log out">
                        </form>
                        ';
                    }
                ?>
            </div>
        </nav>
    </header>

    <body>
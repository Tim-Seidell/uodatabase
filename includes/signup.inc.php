<?php
    if(isset($_POST['signup-submit'])) {

        require 'dbh.inc.php';

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['lastname']."_".$_POST['firstname'];
        $year = $_POST['asyear'];
        $contracted = $_POST['contracted'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];


        /* Check for empty fields */
        if(empty($username) || empty($email) || empty($password1) || empty($password2)) {
            header("Location: ../signup.php?error=emptyfields&username=".$username."&email=".$email);
            exit();
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9-_.]*$/", $username)) {
            header("Location: ../signup.php?error=invalidemail+username");
            exit();
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?error=invalidemail&username=".$username);
            exit();
        } else if(!preg_match("/^[a-zA-Z0-9-_.]*$/", $username)) {
            header("Location: ../signup.php?error=invalidusername&email=".$email);
            echo $username;
            exit();
        } else if($password1 !== $password2) {
            header("Location: ../signup.php?error=passwordcheck&username=".$username."&email=".$email);
            exit();
        } else {
            $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if($resultCheck > 0) {
                    header("Location: ../signup.php?error=usertaken&email=".$email);
                    exit();
                } else {
                    /* Add to users */
                    $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    } else {
                        $hashedPwd = password_hash($password1, PASSWORD_DEFAULT);                        
                        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                        mysqli_stmt_execute($stmt);
                    }

                    /* Add to cadets */
                    $sql = "INSERT INTO cadets (id, Firstname, Lastname, cadet_table_name, ASYear, Contracted) VALUES (NULL, ?, ?, ?, ?, ?);";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "sssis", $firstname, $lastname, $username, $year, $contracted);
                        mysqli_stmt_execute($stmt);
                    }

                    /* Add individual table */
                    $sql = "CREATE TABLE $username (item varchar(20) not null, size varchar(10) not null, quantity int(3));";
                    mysqli_query($conn, $sql);
                    header("Location: ../index.php?signup=success");
                    exit();
                }
            }
        }
        //mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        header("Location: ../signup.php");
        exit();
    }
?>
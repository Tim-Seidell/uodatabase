<?php
    /* Log in */
    if(isset($_POST['login-submit'])) {
        require 'dbh.inc.php';

        $mailuid = $_POST['mailuid'];
        $password = $_POST['password'];

        echo $mailuid;
        echo $password;

        if(empty($mailuid) || empty($password)) {
            header("Location: ../index.php?error=emptyfields&mailuid=".$mailuid);
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)) {
                    $pwdCheck = password_verify($password, $row['pwdUsers']);
                    echo "<h1>Password check >".$pwdCheck."<";
                    if($pwdCheck == false) {
                        header("Location: ../index.php?error=wrongpassword");
                        exit();
                    } else if($pwdCheck == true) {
                        session_start();
                        $_SESSION['userId'] = $row['idUsers'];
                        $_SESSION['userUid'] = $row['uidUsers'];

                        header("Location: ../index.php?login=success");
                        exit();
                    } else {
                        header("Location: ../index.php?error=wrongpassword");
                        exit();
                    }
                } else {
                    header("Location: ../index.php?error=nouser");
                    exit();
                }
            }
        }
    } 
    
    /* Log out */
    else if(isset($_POST['logout-submit'])) {
        echo "test"; 
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../index.php"); 
    } 

    else {
        header("Location: ../index.php?error=nice_try");
        exit();
    }
?>
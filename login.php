<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="login.css">
        <title>Login</title>
    </head>
    <body>
        <?php session_start();?>
            <div class="container">
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                    <p>
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username">
                    </p>
                    <p>
                        <input type="submit" value="Login">
                    </p>
                </form>
            </div>
        <?php
            // Check that user input something
            if (isset($_POST['username'])) {
                $username = (string) $_POST['username'];

                $h = fopen("/srv/module2/users.txt", "r");

                while(!feof($h)){
                    if(trim(fgets($h)) == $username){
                        // Update session variables
                        @$_SESSION['status'] = true;
                        @$_SESSION['username'] = $username;

                        // Send to filesharing.php site
                        fclose($h);
                        header("Location: filesharing.php");
                        exit;
                    }
                }
            }
        ?>
    </body>
</html>
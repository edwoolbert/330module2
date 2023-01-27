<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<body>
    <?php session_start(); ?>
    <div class="login_container">
        <h1 class="loginText">Super Cool File Sharing Website</h1>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="input_container">
                <p>
                    <label for="username">Username:</label>
                    <input class="inputs" type="text" name="username" id="username" placeholder="Please Enter Your Username">
                </p>
            </div>
            <div>
                <input class="login_button" type="submit" value="Login">
            </div>
        </form>
    </div>
    <?php
    // Check that user input something
    if (isset($_POST['username'])) {
        $username = (string) $_POST['username'];

        $h = fopen("/srv/module2/users.txt", "r");

        while (!feof($h)) {
            $temp = trim(fgets($h));
            if ($temp == $username && $temp != "") {
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
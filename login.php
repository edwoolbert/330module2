<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<body>
    <?php session_start(); ?>
    <div class="login-container">
        <h1 class="loginText">Login</h1>
        <div class="input-container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                <p>
                    <label for="username">Username:</label>
                    <input class="inputs" type="text" name="username" id="username">
                </p>
        </div>
        <div class="button-container">
            <input class="login-button" type="submit" value="Login">
        </div>
        </form>
    </div>
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
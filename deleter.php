<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="intermediate.css">
        <title>File Deleter</title>
    </head>
    <body>
        <div class="intermediate_container">
            <div class="header">
                <div class="header-element">
                    <h1 class="header-text">Status</h1>
                </div>
                <div class="header-element">
                    <form action="filesharing.php" method="POST">
                        <p>
                            <input class="return_button" type="submit" name="Return" value="return">
                        </p>
                    </form>
                </div>
            <div>

            <div class = "status-container">
            <?php
                session_start();

                // Get the filename and make sure it is valid
                $filename = (string) $_POST['deletefile'];

                if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
                    echo "Invalid filename";
                    exit;
                }
                
                // Get the username
                $username = $_SESSION['username'];
                
                $full_path = sprintf("/srv/module2/%s/%s", $username, $filename);
                
                if( unlink($full_path) ){
                    printf("<h3>Successfully deleted %s!<h3>", $filename);
                    exit;
                } else {
                    printf("<h3>Failed to delete %s!<h3>", $filename);
                    exit;
                }
            ?>
            </div>
        </div>
    </body>
</html>
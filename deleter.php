<!DOCTYPE html>
<html lang="en">
    <head>
        <title>File Deleter</title>
    </head>
    <body>
        <form action="filesharing.php" method="POST">
            <p>
                <input type="submit" name="Return" value="return">
            </p>
        </form>

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
    </body>
</html>
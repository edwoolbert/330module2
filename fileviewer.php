<!DOCTYPE html>
<html lang="en">
    <head>
        <title>File Sharing</title>
    </head>
    <body>
        <form action="filesharing.php" method="POST">
            <p>
                <input type="submit" name="Return" value="return">
            </p>
        </form>

        <?php
            session_start();

            $filename = (string) $_POST['viewfile'];

            // We need to make sure that the filename is in a valid format; if it's not, display an error and leave the script.
            // To perform the check, we will use a regular expression.
            if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
                echo "Invalid filename";
                exit;
            }

            // Get the username
            $username = $_SESSION['username'];

            $full_path = sprintf("/srv/module2/%s/%s", $username, $filename);

            // Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($full_path);

            // Finally, set the Content-Type header to the MIME type of the file, and display the file.
            header("Content-Type: ".$mime);
            header('content-disposition: inline; filename="'.$filename.'";');
            readfile($full_path);
        ?>
    </body>
</html>
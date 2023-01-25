<!DOCTYPE html>
<html lang="en">
    <head>
        <title>File Uploader</title>
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
            $filename = basename($_FILES['uploadedfile']['name']);

            if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
                echo "Invalid filename";
                exit;
            }
            
            // Get the username
            $username = $_SESSION['username'];
            
            $full_path = sprintf("/srv/module2/%s/%s", $username, $filename);
            
            if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
                printf("<h3>Successfully uploaded file!<h3>");
                exit;
            } else {
                printf("<h3>Failed to upload file!<h3>");
                exit;
            }
        ?>
    </body>
</html>
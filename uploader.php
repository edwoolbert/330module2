<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="intermediate.css">
        <title>File Uploader</title>
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
            </div>

            <div class = "status-container">
                <?php
                    session_start();

                // Get the filename and make sure it is valid
                $filename = basename($_FILES['uploadedfile']['name']);

                if (!preg_match('/^[\w_\.\-]+$/', $filename)) {
                    printf("<p>Invalid filename</p>");
                } else {

                    // Get the username
                    $username = $_SESSION['username'];

                    $full_path = sprintf("/srv/module2/%s/%s", $username, $filename);

                    if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path)) {
                        printf("<h3>Successfully uploaded file!</h3>");
                    } else {
                        printf("<h3>Failed to upload file!</h3>");
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>
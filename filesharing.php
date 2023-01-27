<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="filesharing.css">
    <title>File Sharing</title>
</head>

<body>
    <div class="header">
        <div class="header_element">
            <?php
            session_start();
            if(@$_SESSION['username'] == ""){
                header("Location: login.php");
                exit;
            }
            printf("<h1>Hello %s</h1>", @$_SESSION['username']);

            if (isset($_POST['Logout'])) {
                session_destroy();
                header("Location: login.php");
                exit;
            }
            ?>
        </div>

        <div class="header_element">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                <p>
                    <input class="filesharing_button logout_button" type="submit" name="Logout" value="Logout">
                </p>
            </form>
        </div>
    </div>
    

    <div class="options_container">
        <div class="options">
        <form enctype="multipart/form-data" action="uploader.php" method="POST">
            <div class="inner_div">
                <p>
                    <input class="filesharing_button" type="hidden" name="MAX_FILE_SIZE" value="20000000">
                    <label class="filesharing_label">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadedfile">
                </p>
            </div>
            <div class="submit_button">
                <p>
                    <input class="filesharing_button" type="submit" value="Upload File">
                </p>
            </div>
        </form>
        
        </div>
        <div class="options">
            <form enctype="multipart/form-data" action="deleter.php" method="POST">
                <div class="inner_div">
                    <p>
                        <label class="filesharing_label">Type name of a file to delete:</label> <input name="deletefile" type="text" id="deletefile" placeholder="Input file name here">
                    </p>
                </div>
                <div class="submit_button">
                    <p>
                        <input class="filesharing_button" type="submit" value="Delete File">
                    </p>
                </div>
            </form>
        </div>
        <div class="options">
            <form enctype="multipart/form-data" action="fileviewer.php" method="POST">
                <div class="inner_div">
                    <p>
                        <label class="filesharing_label">Type name of a file to view:</label> <input name="viewfile" type="text" id="viewfile" placeholder="Input file name here">
                    </p>
                </div>
                <div class="submit_button">
                    <p>
                        <input class="filesharing_button" type="submit" value="View File">
                    </p>
                </div>
            </form>
        </div>
    </div>

    <div class="files_list_container">
        <h1>List of Current Files</h1>
        <ul>
            <?php
                session_start();
                $userdir = "/srv/module2/".(@$_SESSION['username']);

                $filenames = scandir($userdir);

                // https://stackoverflow.com/questions/12164029/select-all-elements-in-an-array-that-fall-between-2-specific-elements
                $filenames = array_slice($filenames, array_search('START', $filenames, true) + 2);
                // End of citation

                foreach ($filenames as $file) {
                    printf("<li>%s</li>", $file);
                }
            ?>
        </ul>
    </div>
    
</body>

</html>
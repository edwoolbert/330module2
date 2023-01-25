<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="filesharing.css">
    <title>File Sharing</title>
</head>

<body>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
        <p>
            <input class="logout_button" type="submit" name="Loggout" value="Logout">
        </p>
    </form>

    <?php
    session_start();
    printf("<h1>Hello %s<h1>", @$_SESSION['username']);

    if (isset($_POST['Loggout'])) {
        session_destroy();
        header("Location: login.php");
        exit;
    }
    ?>
    <div class="options_container">
        <div class="options">
            <form enctype="multipart/form-data" action="uploader.php" method="POST">
                <p>
                    <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
                    <label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadedfile" />
                </p>
                <p>
                    <input type="submit" value="Upload File" />
                </p>
            </form>
        </div>
        <div class="options">
            <form enctype="multipart/form-data" action="deleter.php" method="POST">
                <p>
                    <label for="">Type name of a file to delete:</label> <input name="deletefile" type="text" id="deletefile" />
                </p>
                <p>
                    <input type="submit" value="Delete File" />
                </p>
            </form>
        </div>
        <div class="options">
            <form enctype="multipart/form-data" action="fileviewer.php" method="POST">
                <p>
                    <label for="">Type name of a file to view:</label> <input name="viewfile" type="text" id="viewfile" />
                </p>
                <p>
                    <input type="submit" value="View File" />
                </p>
            </form>
        </div>
    </div>
    <?php
    session_start();
    $userdir = "/srv/module2/" . (@$_SESSION['username']);

    $filenames = scandir($userdir);

    // https://stackoverflow.com/questions/12164029/select-all-elements-in-an-array-that-fall-between-2-specific-elements
    $filenames = array_slice($filenames, array_search('START', $filenames, true) + 2);
    // End of citation

    foreach ($filenames as $file) {
        printf("<p>%s</p>", $file);
    }
    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 4 - Upload Page</title>

    <link rel="stylesheet" href="coolLookingCSS.css">

<?php
$message = "";
$maxSize = 30 * 1024 *1024;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_FILES["file"]) ||
        $_FILES["file"]["error"] !== UPLOAD_ERR_OK) {

            // File upload failed
        $message = "File upload failed.";
        }
        elseif ($_FILES["file"]["size"] > $maxSize) {

            // Fule size is to big
        $message = "The file size is bigger than the 30 MB limit.";
        }
        else {
            $filename = $_FILES["file"]["name"];
            $fileSize = $_FILES["file"]["size"];
            $fileType = mime_content_type(
                $_FILES["file"]["tmp_name"]
            );

            // File upload worked
            $message = "File recieved successfully: " . $filename;

            // Then the database storage will be added.
        }
}

?>
</head>
<body>
    <header>
        <h1>File Management System</h1>

        <nav>
            <a href="upload.php">Upload Files</a>
            <a href="files.php">View Files</a>
        </nav>          
    </header>

    <main>
        <h2>Upload your File Here</h2>

        <p>Maximum file size: 30 MB</p>

        <form method="POST"
            enctype="multipart/form-data">

            <input  type="file"
                    name="file"
                    id="file"
                    required>
            
            <button type="submit">Upload File</button>

        </form>

        <p>
            <?php echo htmlspecialchars($message); ?>
        </p>
    </main>
</body>
</html>
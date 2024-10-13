<?php
// create_uploads_directory.php

$targetDirectory = "uploads/";

// Ensure the directory exists, create it if not
if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

echo "Uploads directory created successfully!";
?>

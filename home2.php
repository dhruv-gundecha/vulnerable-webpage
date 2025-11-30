<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_FILES['file']['name'])) {

        $uploadDir = __DIR__ . "/uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = $_FILES['file']['name'];

        // Extract extension safely
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Block ONLY .php but allow .php5
        if ($ext === "php") {
            $msg = "'.php' files are not allowed.";
        } else {

            $target = $uploadDir . $filename;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                $msg = "Uploaded: " . htmlspecialchars($filename);
            } else {
                $msg = "Upload failed.";
            }
        }

    } else {
        $msg = "No file selected.";
    }
}
?>

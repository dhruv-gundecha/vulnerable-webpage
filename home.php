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
        $mime = $_FILES['file']['type']; // content type sent by browser

        // Weak filter: block only "application/x-php"
        if ($mime === "application/x-php") {
            $msg = "PHP content is not allowed.";
        } else {
            $target = $uploadDir . $filename;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                $msg = "Uploaded: " . htmlspecialchars($filename) . " (MIME: $mime)";
            } else {
                $msg = "Upload failed.";
            }
        }

    } else {
        $msg = "No file selected.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome Trainer</title>
</head>
<body>

<h2>Home</h2>

<?php if (!empty($msg)): ?>
    <p><?php echo $msg; ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <label>Select File:</label><br>
    <input type="file" name="file"><br><br>
    <button type="submit">Upload</button>
</form>

</body>
</html>

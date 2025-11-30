<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_FILES['file']['name'])) {

        $uploadDir = __DIR__ . "/uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = $_FILES['file']['name'];

        // Extract extension safely
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Blacklist ONLY .php, allow everything else including .php5
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

<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>

<h2>Upload File</h2>

<?php if (!empty($msg)): ?>
    <p><?php echo htmlspecialchars($msg); ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <label>Select File:</label><br>
    <input type="file" name="file"><br><br>
    <button type="submit">Upload</button>
</form>

</body>
</html>

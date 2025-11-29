<?php
// --- DEBUG SETTINGS ---
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php-error.log');

// --- DB CONNECTION ---
// Assumes MariaDB/MySQL is running on Debian locally
$mysqli = new mysqli("localhost", "root", "mypass", "ccdc");

if ($mysqli->connect_errno) {
    die("Database connection failed: " . $mysqli->connect_error);
}

// --- FORM SUBMISSION ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Deliberately UNSAFE for SQLi testing
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';

    // Vulnerable SQL query
    $sql = "SELECT * FROM users WHERE username='$u' AND password='$p'";

    // Log the SQL to file for debugging
    error_log("LOGIN SQL = $sql");

    $result = $mysqli->query($sql);

    if ($result && $result->num_rows > 0) {
        header("Location: home.php");
        exit;
    } else {
        $error = "Login failed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
	body {
            background: url("images/Pokémon_Charizard_art.png") no-repeat center center fixed;
            background-size: 50%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
	form {
            background: rgba(255, 255, 255, 0.85);
            padding: 20px;
            border-radius: 8px;
            width: 260px;
            margin: 120px auto;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }
     </style>
</head>
<body>

<h2>Login Trainer</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form method="POST" action="index.php">
    <label>Username:</label><br>
    <input type="text" name="username"><br><br>

    <label>Password:</label><br>
    <input type="text" name="password"><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>

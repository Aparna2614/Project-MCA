<?php
session_start();

// Load the configuration file
$config = include('config.php');


// Check if user is already logged in, redirect if true
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: vd_upd.php"); // Redirect to upload page
    exit;
}

// Check if login form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    $inputUsername = $_POST["username"];
    $inputPassword = $_POST["password"];

    // Validate credentials
    if ($inputUsername === $config['username'] && $inputPassword === $config['password']) {
        // Authentication successful
        $_SESSION['admin_logged_in'] = true;
        header("Location: vd_upd.php"); // Redirect to upload form
        exit;
    } else {
        // Authentication failed
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <input type="submit" value="Login" name="submit">
    </form>
</body>
</html>

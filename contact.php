<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $to = "your-email@example.com";  // Replace with your email address
    $subject = "Contact Form Submission";
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        $success = "Message sent successfully!";
    } else {
        $error = "Failed to send message. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
      body {
            font-family: Arial, sans-serif;
            background: rgb(4,45,97);
            background: linear-gradient(0deg, rgba(4,45,97,1) 19%, rgba(114,137,231,1) 48%, rgba(190,234,133,1) 89%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .navbar {
            width: 100%;
            background: rgb(17,62,244);
            background: linear-gradient(0deg, rgba(17,62,244,1) 11%, rgba(114,137,231,1) 48%, rgba(187,238,121,1) 89%);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.2rem 0;
        }
        .bar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0 1rem;
        }
        .navbar #heading {
            font-size: 2rem;
            color: rgb(50, 2, 57);
            font-family: 'Times New Roman', Times, serif;
            margin-left: 1vw;
        }
        .navbar ul {
            list-style: none;
            display: flex;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }
        .navbar ul li {
            list-style: none;
            display: block;
            background-color: transparent;
            font-size: 20px;
            color: rgb(105, 60, 11);
        }
        .navbar ul li a {
            text-decoration: none;
            font-family: 'Times New Roman', Times, serif;
            color: rgb(48, 32, 1);
            font-weight: 600;
            padding: 1.5rem 1rem;
            display: block;
        }
       
        .container {
            width: 80%;
            max-width: 800px;
            background: #bbee79;
            padding: 60px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            box-sizing: border-box;
            margin-top: 10vh;
        }
        h2 {
            color: #333;
            text-align: center;
            font-size: 4rem;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #f0984d;
            font-size: 2rem;
        }
        input, textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button {
            background-color: #f0984d;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }
        .success, .error {
            margin-bottom: 20px;
            color: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }
        .success {
            background-color: #4CAF50;
        }
        .error {
            background-color: #f44336;
        }   
    </style>
</head>
<body>
<header class="navbar">
        <div class="bar" style="height: 6.5vh; border-spacing: 10rem;">
            <p id="heading">тнє ѕтσяу тєℓℓιηg мυѕєυм</p>
            <ul>
                <li><a href="home.php">🄷🄾🄼🄴</a></li>
                <li><a href="vdo.php">🅅🄸🄳🄴🄾🅂</a></li>
                <li><a href="storyteller.php">🅂🅃🄾🅁🅈 🅃🄴🄻🄻🄴🅁</a></li>
                <li><a href="contact.php">🄲🄾🄽🅃🄰🄲🅃 🅄🅂</a></li>
            </ul>
      
          </div>
    </header>
    <div class="container">
        <h2>ℂ𝕆ℕ𝕋𝔸ℂ𝕋 𝕌𝕊</h2>
        <?php if (!empty($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php elseif (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>
    </div>
</body>
</html>

<?php
session_start();
require 'loadenv.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

// Database connection credentials
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME');
$blog_dbname = getenv('BLOG_DB_NAME');

// Create connection to video database
$conn_video = new mysqli($servername, $username, $password, $dbname);
if ($conn_video->connect_error) {
    die("Connection to video database failed: " . $conn_video->connect_error);
}

// Create connection to blog database
$conn_blog = new mysqli($servername, $username, $password, $blog_dbname);
if ($conn_blog->connect_error) {
    die("Connection to blog database failed: " . $conn_blog->connect_error);
}

// Process announcement form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_announcement'])) {
    $announcementTitle = $conn_blog->real_escape_string($_POST['announcementTitle']);
    $announcementContent = $conn_blog->real_escape_string($_POST['announcementContent']);

    $sql = "INSERT INTO blog (title, content) VALUES ('$announcementTitle', '$announcementContent')";
    if ($conn_blog->query($sql) === TRUE) {
        echo '<div class="success-message">Announcement added successfully.</div>';
    } else {
        echo '<div class="error-message">Error adding announcement: ' . $conn_blog->error . '</div>';
    }
}

// Handle delete request for announcements
if (isset($_POST['delete_announcement'])) {
    $id = intval($_POST['id']);
    $deleteSql = "DELETE FROM blog WHERE id = $id";
    if ($conn_blog->query($deleteSql) === TRUE) {
        echo '<div class="success-message">Announcement deleted successfully.</div>';
    } else {
        echo '<div class="error-message">Error deleting announcement: ' . $conn_blog->error . '</div>';
    }
}

// Fetch announcements for display
$announcement_sql = "SELECT id, title, content FROM blog";
$announcement_result = $conn_blog->query($announcement_sql);

// Delete video
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $deleteSql = "DELETE FROM video WHERE id = $id";
    if ($conn_video->query($deleteSql) === TRUE) {
        echo "Video deleted successfully.";
    } else {
        echo "Error deleting video: " . $conn_video->error;
    }
}

// Replace video
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['replace'])) {
    $id = intval($_POST['video_id']);
    $videoTitle = $_POST['videoTitle'];
    $videoDescription = $_POST['videoDescription'];
    $videoName = $_FILES['video']['name'];
    $videoType = $_FILES['video']['type'];
    $videoSize = $_FILES['video']['size'];
    $videoTmpName = $_FILES['video']['tmp_name'];
    $videoError = $_FILES['video']['error'];

    if ($videoError === UPLOAD_ERR_OK) {
        $videoData = file_get_contents($videoTmpName);
        $videoData = $conn_video->real_escape_string($videoData); // Use $conn_video here, not $conn

        $updateSql = "UPDATE video SET name = '$videoName', type = '$videoType', size = $videoSize, data = '$videoData', title = '$videoTitle', description = '$videoDescription' WHERE id = $id";
        if ($conn_video->query($updateSql) === TRUE) {
            echo "Video replaced successfully.";
        } else {
            echo "Error replacing video: " . $conn_video->error;
        }
    } else {
        echo "Upload failed with error code " . $videoError;
    }
}


// Process uploaded file
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload'])) {
    $videoTitle = $_POST['videoTitle'];
    $videoDescription = $_POST['videoDescription'];
    $videoName = $_FILES['video']['name'];
    $videoType = $_FILES['video']['type'];
    $videoSize = $_FILES['video']['size'];
    $videoTmpName = $_FILES['video']['tmp_name'];
    $videoError = $_FILES['video']['error'];

    if ($videoError === UPLOAD_ERR_OK) {
        $videoData = file_get_contents($videoTmpName);
        $videoData = $conn_video->real_escape_string($videoData);

        $sql = "INSERT INTO video (name, type, size, data, title, description) VALUES ('$videoName', '$videoType', $videoSize, '$videoData', '$videoTitle', '$videoDescription')";
        if ($conn_video->query($sql) === TRUE) {
            echo "Video uploaded successfully.";
        } else {
            echo "Error uploading video: " . $conn->error;
        }
    } else {
        echo "Upload failed with error code " . $videoError;
    }
}

// Fetch videos for display
$sql = "SELECT id, name, title, description, type, data FROM video";
$result = $conn_video->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<h2>𝙰𝚍𝚍 𝙰𝚗𝚗𝚘𝚞𝚗𝚌𝚎𝚖𝚎𝚗𝚝</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="announcementTitle">Title:</label>
        <input type="text" id="announcementTitle" name="announcementTitle" required>
        <br><br>
        <label for="announcementContent">Content:</label>
        <textarea id="announcementContent" name="announcementContent" required></textarea>
        <br><br>
        <input type="submit" value="Add Announcement" name="add_announcement">
    </form>
    <!-- Uploaded Announcements -->
    <h2>𝚄𝚙𝚕𝚘𝚊𝚍𝚎𝚍 𝙰𝚗𝚗𝚘𝚞𝚗𝚌𝚎𝚖𝚎𝚗𝚝𝚜</h2>
    <div class="announcement-list">
        <?php if ($announcement_result && $announcement_result->num_rows > 0): ?>
            <?php while ($row = $announcement_result->fetch_assoc()): ?>
                <div class="announcement-item">
                    <h3><?php echo isset($row['title']) ? htmlspecialchars($row['title']) : "No Title"; ?></h3>
                    <p><?php echo isset($row['content']) ? htmlspecialchars($row['content']) : "No Content"; ?></p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="delete_announcement" value="Delete">
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No announcements found.</p>
        <?php endif; ?>
    </div>



    <br>
    <h2>𝚄𝙿𝙻𝙾𝙰𝙳 𝚅𝙸𝙳𝙴𝙾 </h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="videoTitle">Title:</label>
        <input type="text" id="videoTitle" name="videoTitle" required>
        <br><br>
        <label for="videoDescription">Description:</label>
        <textarea id="videoDescription" name="videoDescription" required></textarea>
        <br><br>
        <label for="videoFile">Choose video file:</label>
        <input type="file" id="videoFile" name="video" required>
        <br><br>
        <input type="submit" value="Upload" name="upload">
    </form>
    <h2>𝚄𝙿𝙻𝙾𝙰𝙳𝙴𝙳  𝚅𝙸𝙳𝙴𝙾𝚂</h2>
    <div class="video-container">
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="video-item">
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <video width="300" height="240" controls>
                    <source src="data:<?php echo $row['type']; ?>;base64,<?php echo base64_encode($row['data']); ?>" type="<?php echo $row['type']; ?>">
                    Your browser does not support the video tag.
                </video>
                <br>
                <a href="?delete=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
                <br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="video_id" value="<?php echo $row['id']; ?>">
                    <label for="videoTitle">New Title:</label>
                    <input type="text" id="videoTitle" name="videoTitle" required>
                    <br><br>
                    <label for="videoDescription">New Description:</label>
                    <textarea id="videoDescription" name="videoDescription" required></textarea>
                    <br><br>
                    <label for="videoFile">Choose new video file:</label>
                    <input type="file" id="videoFile" name="video" required>
                    <br><br>
                    <input type="submit" value="Replace" name="replace">
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No videos found.</p>
    <?php endif; ?>

    </div>

    
    <br>
    <div class="logout">
        <a href="?logout=true" class="logout-btn">Logout</a>
    </div>
</body>
</html>
<?php
// Close connection
$conn_video->close();
$conn_blog->close();

?>


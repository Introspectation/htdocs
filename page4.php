<?php
session_start();

// Database connection setup
$mysqli = new mysqli("localhost", "root", "", "mediamanagedb");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the video ID is present
$videoId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$video = null;

if ($videoId) {
    $stmt = $mysqli->prepare("SELECT * FROM Video_Table WHERE id = ?");
    $stmt->bind_param("i", $videoId);
    $stmt->execute();
    $result = $stmt->get_result();
    $video = $result->fetch_assoc();
    $stmt->close();
}

// Handling form submission to update the video
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if (!empty($_POST['youtube_link']) && !empty($_POST['description'])) {
        $link = $mysqli->real_escape_string($_POST['youtube_link']);
        $description = $mysqli->real_escape_string($_POST['description']);

        $stmt = $mysqli->prepare("UPDATE Video_Table SET link = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $link, $description, $videoId);
        $stmt->execute();
        $stmt->close();
        
        header("Location: page2.php");
        exit();
    } else {
        echo "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Güncelleme</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <div class="header">Video Admin</div>
    <div class="form-container">
        <div class="close-container">
            <button class="close-button" onclick="window.location='page2.php';">X</button>
            <div class="close-label">Vazgeç</div>
        </div>
        <h2>Video Güncelleme</h2>
        <form action="page4.php?id=<?php echo $videoId; ?>" method="post">
            <label for="youtube_link">Youtube Link:</label>
            <input type="url" id="youtube_link" name="youtube_link" value="<?php echo htmlspecialchars($video['link']); ?>" required>
            <label for="description">Video Tanımı:</label>
            <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($video['description']); ?>" required>
            <button type="submit" name="submit">Kaydet</button>
        </form>
    </div>
</body>
</html>

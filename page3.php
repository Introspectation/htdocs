<?php
session_start();

// Database connection setup
$mysqli = new mysqli("localhost", "root", "", "mediamanagedb");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Check if fields are not empty
    if (!empty($_POST['youtube_link']) && !empty($_POST['description'])) {
        $link = $mysqli->real_escape_string($_POST['youtube_link']);
        $description = $mysqli->real_escape_string($_POST['description']);
        $date_added = date('Y-m-d'); // Current date

        // SQL to insert new video
        $query = "INSERT INTO Video_Table (link, description, date_added, is_deleted) VALUES (?, ?, ?, 0)";
        $stmt = $mysqli->prepare($query);
        if ($stmt) {
            $stmt->bind_param("sss", $link, $description, $date_added);
            $stmt->execute();
            $stmt->close();
            header("Location: page2.php"); // Redirect to page2 after insertion
            exit();
        } else {
            echo "Error preparing statement: " . $mysqli->error;
        }
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
    <title>Video Admin</title>
    <link rel="stylesheet" href="style3.css">
    <script>
        function confirmCancel() {
            window.location='page2.php';
        }
    </script>
</head>
<body>
    <div class="header">Video Admin</div>
    <div class="form-container">
        <div class="close-container">
            <button class="close-button" onclick="confirmCancel();">X</button>
            <div class="close-label">Vazgeç</div>
        </div>
        <h2>Video Ekleme</h2>
        <form action="page3.php" method="post">
            <label for="youtube_link">Youtube Link:</label>
            <input type="url" id="youtube_link" name="youtube_link" required>
            <label for="description">Video Tanımı:</label>
            <input type="text" id="description" name="description" required>
            <button type="submit" name="submit">Kaydet</button>
        </form>
    </div>
</body>
</html>

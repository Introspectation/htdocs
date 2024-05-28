<?php
session_start();


// Logout logic
if (isset($_GET['logout']) && $_GET['logout'] == '1') {
    session_destroy();
    header('Location: page1.php');
    exit();
}

if (isset($_GET['delete'])) {
    $videoId = intval($_GET['delete']);
    $mysqli->query("UPDATE Video_Table SET is_deleted = 1 WHERE id = $videoId");
    // Redirect to prevent resubmission
    header("Location: page2.php");
    exit();
}


// Database connection
$mysqli = new mysqli("localhost", "root", "", "mediamanagedb");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch videos
$query = "SELECT * FROM Video_Table WHERE is_deleted = 0 ORDER BY date_added DESC";
$result = $mysqli->query($query);

function getYoutubeVideoID($url) {
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu\.be\/)[^&\n]+#", $url, $matches);
    return $matches[0];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style2.css">
    <script>
        function confirmDelete(videoId) {
            if (confirm("Are you sure you want to remove this video?")) {
                window.location.href = "page2.php?delete=" + videoId;
            }
        }
    </script>
</head>

<script>
function confirmDelete(videoId) {
    if (confirm("Are you sure you want to remove this video?")) {
        window.location.href = "page2.php?delete=" + videoId;
    }
}
</script>

<body>
    <div class="header">Video Admin</div>
    <div class="add-btn">
        <a href="page3.php" class="btn btn-green">Yeni Video Ekle</a>
    </div>
    <div class="video-list">
        <table>
            <tr>
                <th>Thumbnail</th>
                <th>Video Title</th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank"><img src="https://img.youtube.com/vi/<?php echo getYoutubeVideoID($row['link']); ?>/default.jpg" alt="Thumbnail"></a></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo htmlspecialchars($row['date_added']); ?></td>
                <td>
                <a href="page4.php?id=<?php echo $row['id']; ?>" class="btn">Güncelle</a>
                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['id']; ?>);" class="btn btn-red">X</a>

                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <div class="logout-btn" style="text-align: center; margin-top: 20px;">
        <a href="?logout=1" class="btn btn-red">Logout</a>
    </div>
    
</body>
</html>

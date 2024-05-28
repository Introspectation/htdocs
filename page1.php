<?php
// Start the session
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "mediamanagedb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // SQL query to check if the username and password exist in the database
    $query = "SELECT * FROM admin_table WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Redirect to page2.php if credentials are correct
        header("Location: page2.php");
        exit();
    } else {
        // Show an alert message if credentials are incorrect
        echo "<script>alert('Invalid username or password!'); window.location='page1.php';</script>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
        Video Admin
    </div>
    <div class="login-container">
        <h2>Giriş</h2>
        <form action="page1.php" method="post">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username">
            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password">
            <input type="submit" value="Giriş Yap">
        </form>
    </div>
</body>
</html>

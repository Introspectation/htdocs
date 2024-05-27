<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container" id="Header">
        <h1 class="main-title">VIDEO ADMIN</h1>
        <div class="container" id="log-in">
            <h1 class="form-title">Giriş</h1>
            <form method="post" action="">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" id="username" placeholder="username" required>
                    <label for="fname">Kullanıcı Adı</label>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="text" name="password" id="password" placeholder="password" required>
                    <label for="password">Şifre</label>
                </div>
                <p class="recover">
                    <a href="#">Recover Password</a>
                </p>
                <input type="submit" class="btn" value="Log-in" name="Login">

            </form>
        </div>
    </div>
</body>

</html>
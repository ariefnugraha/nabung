<?php
    $koneksi = mysqli_connect("localhost","id6644157_root","arieftkj2","id6644157_nabung");
    if (!$koneksi) {echo "Gagal Terhubung Ke Server. Silahkan Coba Lagi";}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login | Comoin An App To Monitor Your Money</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="container-fluid">
            <main>
                <h3>Comoin</h3>
                <p class="subtitle">An app to monitor your money</p>
                <form method="post" action="login-proses.php">
                    <label>Username :</label>
                    <input type="text" class="form-control" placeholder="Username..." name="username" required>
                    <label>Password :</label>
                    <input type="password" class="form-control" placeholder="Password..." name="password" required>
                    <button type="submit" name="submit" class="btn">Login</button>
                </form>
            </main>
        </div>
        <script src="jquery.js"></script>
		<script src="fontawesome-free/svg-with-js/js/fontawesome-all.min.js"></script>
        <script src="bootstrap/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
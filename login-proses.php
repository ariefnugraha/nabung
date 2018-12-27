<?php
    $koneksi = mysqli_connect("localhost","id6644157_root","arieftkj2","id6644157_nabung");
    if (!$koneksi) {echo "Gagal Terhubung Ke Server. Silahkan Coba Lagi";}

    $username = $_POST['username'];
    $password = $_POST['password'];

    //LOGIN
    $cek = "SELECT username,password FROM user WHERE username = '$username' AND password = '$password'";
    $cek_query = mysqli_query($koneksi,$cek);

    if (mysqli_num_rows($cek_query) == 1) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("location:main.php");
    } else {
        echo '
            <script>
                alert("Username atau Password Salah");
                window.location = "index.php";
            </script>
        ';
    }
?>
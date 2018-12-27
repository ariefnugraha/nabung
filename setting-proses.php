<?php
    $koneksi = mysqli_connect("localhost","id6644157_root","arieftkj2","id6644157_nabung");
    if (!$koneksi) {echo "Gagal Terhubung Ke Server. Silahkan Coba Lagi";}


    $nama = "SELECT username FROM user";
    $nama_query = mysqli_query($koneksi,$nama);
    $nama_row = mysqli_fetch_assoc($nama_query);

    $hasil_nama = $nama_row['username'];

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $update = "UPDATE user set username = '$username' WHERE username = '$hasil_nama'";
        $update_query = mysqli_query($koneksi,$update);

        if ($update_query) {
            echo '
                <script>
                    alert("Username Berhasil Diubah");
                    window.location = "main.php";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Username Gagal Diubah");
                    window.location = "main.php";
                </script>
            ';
        }
    } else if (isset($_POST['password'])) {
        $password = $_POST['password'];
        $update = "UPDATE user set password = '$password' WHERE username = '$hasil_nama";
        $update_query = mysqli_query($koneksi,$update);

        if ($update_query) {
            echo '
                <script>
                    alert("Password Berhasil Diubah");
                    window.location = "main.php";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Password Gagal Diubah");
                    window.location = "main.php";
                </script>
            ';
        }
    } else if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $update = "UPDATE user set username = '$username', password = '$password' WHERE username = '$hasil_nama'";
        $update_query = mysqli_query($koneksi,$update);

        if ($update_query) {
            echo '
                <script>
                    alert("Username dan Password Berhasil Diubah");
                    window.location = "main.php";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Username dan Password Gagal Diubah");
                    window.location = "main.php";
                </script>
            ';
        }
    }
?>
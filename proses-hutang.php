<?php
    $koneksi = mysqli_connect("localhost","id6644157_root","arieftkj2","id6644157_nabung");
    if (!$koneksi) {echo "Gagal Terhubung Ke Server. Silahkan Coba Lagi";}

    $uang = $_POST['uang'];
    $nama = ucfirst($_POST['nama']);
    $pilihan = $_POST['pilihan'];

    if ($_POST['tanggal'] == "") {
        $insert = "INSERT INTO hutang (id,nominal,nama,jenis) VALUES (NULL,$uang,'$nama','$pilihan')";
        $insert_query = mysqli_query($koneksi,$insert);

        if ($insert_query) {
            echo '
                <script>
                    window.alert("Data Berhasil Ditambah");
                    window.location = "main.php";
                </script>
            ';
        } else {
            echo '
                <script>
                    window.alert("Data adhahdjahfka Ditambah");
                    window.location = "main.php";
                </script>
            ';   
        }

    } else {
        $tanggal = $_POST['tanggal'];
        $insert = "INSERT INTO hutang VALUES (NULL,$uang,'$nama','$tanggal','$pilihan')";
        $insert_query = mysqli_query($koneksi,$insert);

        if ($insert_query) {
            echo '
                <script>
                    window.alert("Data Berhasil Ditambah");
                    window.location = "main.php";
                </script>
            ';
        } else {
            echo '
                <script>
                    window.alert("Data Gagal Ditambah");
                    window.location = "main.php";
                </script>
            ';   
        }
    }
?>
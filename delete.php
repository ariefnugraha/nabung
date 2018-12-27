<?php
    $koneksi = mysqli_connect("localhost","id6644157_root","arieftkj2","id6644157_nabung");
    
    if(!$koneksi) {
		echo "Tidak Bisa Terhubung Ke Server. Silahkan Coba Lagi Nanti";
	}

	session_start();
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	
	if (!isset($_SESSION['username'])) {
		echo '
			<script>
				alert("Anda Harus Login Dahulu");
				window.location = "index.php";
			</script>
		';
	} 

    $id = $_GET['id'];

    $pengeluaran = "SELECT * FROM pengeluaran WHERE id = $id";
    $pengeluaranquery = mysqli_query($koneksi,$pengeluaran);

    $pendapatan = "SELECT * FROM pendapatan WHERE id = $id";
    $pendapatanquery = mysqli_query($koneksi,$pendapatan);

    if (mysqli_num_rows($pengeluaranquery) == 1) {
        $delete = "DELETE FROM pengeluaran WHERE id = $id";
        $deletequery = mysqli_query($koneksi,$delete);
        
        if ($deletequery) {
            echo '
                <script>
                    alert("Sukses hapus data");
                    window.location = "main.php";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Gagal Hapus Data");
                    window.location = "main.php";
                </script>
            ';
        }
    } elseif (mysqli_num_rows($pendapatanquery) == 1) {
        $delete = "DELETE FROM pendapatan WHERE id = $id";
        $deletequery = mysqli_query($koneksi,$delete);
        
        if ($deletequery) {
           echo '
                <script>
                    alert("Sukses hapus data");
                    window.location = "main.php";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Gagal Hapus Data");
                    window.location = "main.php";
                </script>
            ';
        }
    }
?>
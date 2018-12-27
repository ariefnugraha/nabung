<?php
$koneksi = mysqli_connect("localhost","id6644157_root","arieftkj2","id6644157_nabung");
    if (!$koneksi) {echo "Gagal Terhubung Ke Server. Silahkan Coba Lagi";}

	$uang = $_POST['uang'];
	$insert = "INSERT INTO tabungan VALUES (NULL,CURDATE(),$uang)";
	$insert_query = mysqli_query($koneksi,$insert);

	if ($insert_query) {
		$pengeluaran = "INSERT INTO pengeluaran VALUES(NULL,CURDATE(),'Tabungan',1,$uang,$uang)";
		$pengeluaran_query = mysqli_query($koneksi,$pengeluaran);
		
		if ($pengeluaran_query) {
			echo '
				<script>
					window.alert("Data Berhasil Diinput");
					window.location = "wishlist.php";
				</script>
			';
		} else {
			echo '
				<script>
					window.alert("Data Gagal Dimasukkan");
					window.location = "wishlist.php";
				</script>
			';
		}
	} else {
		echo '
			<script>
				window.alert("Gagal Input Data");
				window.location = "wishlist.php";
			</script>
		';
	}
?>
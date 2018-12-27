<!--PROSES SUBMIT PHP-->
<?php
    $koneksi = mysqli_connect("localhost","id6644157_root","arieftkj2","id6644157_nabung");
    if (!$koneksi) {echo "Gagal Terhubung Ke Server. Silahkan Coba Lagi";}

	$pilihan = $_POST['kategori'];
	$harga	   = $_POST['harga'];

	if ($harga < 100) {
		echo '
			<script>
				window.alert("Kolom Harga Tidak Boleh Diisi Kurang dari 100");
				window.location = "main.php";
			</script>
		';
	} else {
		$nama = ucfirst($_POST['deskripsi']);
		$jumlah_barang = $_POST['banyak'];
		$total = $jumlah_barang * $harga;

		if ($pilihan == "pendapatan") {
			$insert = "INSERT INTO pendapatan VALUES (NULL,CURDATE(),'$nama',$jumlah_barang,$harga,$total)";
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
		} else if($pilihan == 'pengeluaran') {
			$insert = "INSERT INTO pengeluaran VALUES(NULL,CURDATE(),'$nama',$jumlah_barang,$harga,$total)";
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
	}
?>
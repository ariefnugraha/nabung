<?php
	$koneksi = mysqli_connect("localhost","id6644157_root","arieftkj2","id6644157_nabung");
    if (!$koneksi) {echo "Gagal Terhubung Ke Server. Silahkan Coba Lagi";}

	$nama = ucfirst($_POST['nama']);
	$banyak = $_POST['banyak'];
	$harga = $_POST['harga'];
	$total = $banyak * $harga;
	
	if ($_POST['tanggal'] == "") {
		$link = $_POST['link'];

		$insert = "INSERT INTO wishlist (id,nama,link_barang,banyak_barang,harga,total_harga) VALUES (NULL,'$nama','$link',$banyak,$harga,$total)";
		$insert_query = mysqli_query($koneksi,$insert);

		if ($insert_query) {
			echo '
				<script>
					window.alert("Sukses Menambah Wishlist");
					window.location = "wishlist.php";
				</script>
			';
		} else {
			echo '
				<script>
					window.alert("Gagal Menambah Wishlist");
					window.location = "wishlist.php";
				</script>
			';
		}
	} else if ($_POST['link'] == "") {
		$tanggal = $_POST['tanggal'];
		
		$insert = "INSERT INTO wishlist (id,nama,target_tanggal,banyak_barang,harga,total_harga) VALUES (NULL,'$nama','$tanggal',$banyak,$harga,$total)";
		$insert_query = mysqli_query($koneksi,$insert);

		if ($insert_query) {
			echo '
				<script>
					window.alert("Sukses Menambah Wishlist");
					window.location = "wishlist.php";
				</script>
			';
		} else {
			echo '
				<script>
					window.alert("Gagal Menambah Wishlist");
					window.location = "wishlist.php";
				</script>
			';
		}
	} else if($_POST['tanggal'] == "" && $_POST['link']) {
		$insert = "INSERT INTO wishlist (id,nama,banyak_barang,harga,total_harga) VALUES (NULL,'$nama',$banyak,$harga,$total)";
		$insert_query = mysqli_query($koneksi,$insert);

		if ($insert_query) {
			echo '
				<script>
					window.alert("Sukses Menambah Wishlist tanpa dua2");
					window.location = "wishlist.php";
				</script>
			';
		} else {
			echo '
				<script>
					window.alert("Gagal Menambah Wishlist tanpa dua2");
					window.location = "wishlist.php";
				</script>
			';
		}
	} else {
		$tanggal = $_POST['tanggal'];
		$link = $_POST['link'];

		$insert = "INSERT INTO wishlist (id,nama,link_barang,target_tanggal,banyak_barang,harga,total_harga) VALUES (NULL,'$nama',$link','$tanggal',$banyak,$harga,$total)";
		$insert_query = mysqli_query($koneksi,$insert);

		if ($insert_query) {
			echo '
				<script>
					window.alert("Sukses Menambah Wishlist");
					window.location = "wishlist.php";
				</script>
			';
		} else {
			echo '
				<script>
					window.alert("Gagal Menambah Wishlist");
					window.location = "wishlist.php";
				</script>
			';
		}
	}
?>
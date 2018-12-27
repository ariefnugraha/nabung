<?php
	$koneksi = mysqli_connect("localhost","id6644157_root","arieftkj2","id6644157_nabung");
    if (!$koneksi) {echo "Gagal Terhubung Ke Server. Silahkan Coba Lagi";}
	
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
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Comoin | An app to monitor your money</title>
		<link href="bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="fontawesome/css/all.css" rel="stylesheet">
		<link href="main.css" rel="stylesheet">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<section class="navbar-header">
				<a class="navbar-brand" href="main.php">Nabung</a>
			</section>
			<ul class="nav navbar-nav navbar-right">
				<?php
					//TOTAL PENDAPATAN
					$totalPendapatan = "SELECT SUM(price) AS totaldapat FROM pendapatan WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
					$totalPendapatanQuery = mysqli_query($koneksi,$totalPendapatan);
					$totalPendapatanRow = mysqli_fetch_assoc($totalPendapatanQuery);
					
					//TOTAL PENGELUARAN
					$totalPengeluaran = "SELECT SUM(price) AS totaldapat FROM pengeluaran WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
					$totalPengeluaranQuery = mysqli_query($koneksi,$totalPengeluaran);
					$totalPengeluaranRow = mysqli_fetch_assoc($totalPengeluaranQuery);

					$total_uang = $totalPendapatanRow['totaldapat'] - $totalPengeluaranRow['totaldapat'];

					echo '<li class="uang-desktop" style="color:#ffffff;font-size:19px;margin: 10px 20px;">Total Uang Bulan Ini : Rp.'.$total_uang.'</li>';
				?>
			</ul>
		</nav>

		<div class="container-fluid">
			<div class="uang-smartphone">
				<?php
					echo '<p>Total Uang Bulan Ini : Rp.'.$total_uang.'</p>';
				?>
			</div>
			<div class="row">
				<div class="col-md-4 col-xs-12 col-sm-4 col-lg-4 menu">
					<?php
						$tanggal = date("l, d M Y");
						echo "<p><i class='far fa-calendar-alt fa-lg'></i> $tanggal</p>"
					?>
					<ul class="nav nav-pills nav-stacked">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-plus"></i> Tambah Data</a>
							<ul class="dropdown-menu">
								<li><a href="#tambah" data-toggle="pill">Tambah Pendapatan / Pengeluaran</a></li>
								<li><a href="#tambahhutang" data-toggle="pill" >Tambah Hutang / Piutang</a></li>
							</ul>
						</li>
						<li class="active"><a href="#income" data-toggle="pill"><i class="fas fa-chart-line fa-lg"></i>  Pendapatan</a></li>
						<li><a href="#outcome" data-toggle="pill"><i class="fas fa-chart-line fa-flip-vertical fa-lg"></i> Pengeluaran</a></li>
						<li><a href="wishlist.php"><i class="fas fa-gift fa-lg"></i> Wishlist & Tabungan</a></li>
						<li><a href="#hutang" data-toggle="pill"><i class="fas fa-hand-holding-usd fa-lg"></i> Hutang dan Piutang</a></li>
						<li><a href="#setting" data-toggle="pill"><i class="fas fa-cog fa-lg"></i> Pengaturan</a></li>
						<li><a href="logout.php"><i class="fas fa-sign-out-alt fa-lg"></i> Logout</a></li>
					</ul>
				</div>
				<div class="col-md-8 col-xs-12 col-sm-8 col-lg-8 content">
					<div class="tab-content">
						<section id="tambah" class="tab-pane fade">
							<h3><center>Tambah Pendapatan / Pengeluaran</center></h3>
							<hr>
							<form action="proses.php" method="post">
								<label>Masukkan Nama Item :</label>
								<textarea name="deskripsi" class="form-control" placeholder="Nama Item..." autofocus required></textarea> 
								<label>Masukkan Banyak Item :</label>
								<input type="number" class="form-control" name="banyak" placeholder="Banyak Item..." required>
								<label>Masukkan Harga :</label>
								<input type="number" class="form-control" name="harga" placeholder="Harga..." required>
								<label>Pilih Kategori :</label>
								<select name="kategori" class="form-control" required>
									<option value="pendapatan">Pendapatan</option>
									<option value="pengeluaran">Pengeluaran</option>
								</select>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</section>
						<section id="tambahhutang" class="tab-pane fade">
							<h3><center>Tambah Hutang / Piutang</center></h3>
							<hr>
							<form action="proses-hutang.php" method="post">
								<label>Nominal :</label>
								<input type="number" class="form-control" name="uang" placeholder="Nominal Uang..." required>
								<label>Nama Penghutang / Menghutang</label>
								<input type="text" class="form-control" name="nama" placeholder="Nama..." required>
								<label>Batas Tanggal Pembayaran Hutang / Piutang :</label>
								<input type="date" min="2018-01-01" class="form-control" name="tanggal" placeholder="Batas Bayar...">
								<label>Jenis :</label>
								<select class="form-control" name="pilihan">
									<option value="hutang">Hutang</option>
									<option value="piutang">Piutang</option>
								</select>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</section>
						<section id="income" class="tab-pane fade in active">
							<?php
								$pendapatan = "SELECT * FROM pendapatan WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE()) ORDER BY date DESC";
								$pendapatan_query = mysqli_query($koneksi,$pendapatan);

								
								echo '<div class="row">';
								while ($row = mysqli_fetch_assoc($pendapatan_query)) {
									$tanggal = date('l, d M Y',strtotime($row['date']));
									echo '
										<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 content">
											<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
											    <a href="delete.php?id='.$row['id'].'">Hapus Item</a>
												<p>'.$tanggal.'</p>
											</div>
											<div class="col-md-4 col-xs-4 col-lg-4 col-sm-4">
												<p>Nama Item</p>
												<h4>'.$row['deskripsi'].'</h4>
											</div>
											<div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
												<p>Banyak Item</p>
												<h4>'.$row['banyak_barang'].' X</h4>
											</div>
											<div class="col-md-3 col-xs-3 col-lg-3 col-sm-3">
												<p>Harga</p>
												<h4>Rp. '.$row['harga'].'</h4>
											</div>
											<div class="col-md-3 col-xs-3 col-lg-3 col-sm-3">
												<p>Total Harga</p>
												<h4>Rp. '.$row['price'].'</h4>
											</div>
										</div>
									';
								}
								echo '</div>';
							?>
						</section>
						<section id="outcome" class="tab-pane fade in">
							<?php
								$pengeluaran = "SELECT * FROM pengeluaran WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE()) ORDER BY date DESC";
								$pengeluaran_query = mysqli_query($koneksi,$pengeluaran);

								echo '<div class="row">';
								while ($row = mysqli_fetch_assoc($pengeluaran_query)){
									$tanggal = date('l, d M Y',strtotime($row['date']));
									echo '
										<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 content">
											<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <a href="delete.php?id='.$row['id'].'">Hapus Item</a>
												<p>'.$tanggal.'</p>
											</div>
											<div class="col-md-4 col-xs-4 col-lg-4 col-sm-4">
												<p>Nama Item</p>
												<h4>'.$row['deskripsi'].'</h4>
											</div>
											<div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
												<p>Banyak Item</p>
												<h4>'.$row['banyak_barang'].' X</h4>
											</div>
											<div class="col-md-3 col-xs-3 col-lg-3 col-sm-3">
												<p>Harga</p>
												<h4>Rp. '.$row['harga'].'</h4>
											</div>
											<div class="col-md-3 col-xs-3 col-lg-3 col-sm-3">
												<p>Total Harga</p>
												<h4>Rp. '.$row['price'].'	</h4>
											</div>
										</div>
									';
								}
								echo '</div>';
							?>
						</section>
						<section id="hutang" class="tab-pane fade in">
							<div class="hutang-content">
								<h3>Hutang</h3>
								<div class="table-responsive">
									<table class="table table-striped">
										<tr>
											<th>Nama</th>
											<th>Nominal</th>
											<th>Batas Tanggal</th>
										</tr>
										<?php
											$hutang = "SELECT * FROM hutang WHERE jenis = 'hutang' ORDER BY tanggal DESC";
											$hutang_query = mysqli_query($koneksi,$hutang);

											while ($row = mysqli_fetch_assoc($hutang_query)) {
												echo '
													<tr>
														<td>'.$row['nama'].'</td>
														<td>Rp. '.$row['nominal'].'</td>
														<td>'.$row['tanggal'].'</td>
													</tr>
												';
											}
										?>
									</table>		
								</div>
							</div>
							<div class="piutang-content">
								<h3>Piutang</h3>
								<div class="table-responsive">
									<table class="table table-striped">
										<tr>
											<th>Nama</th>
											<th>Nominal</th>
											<th>Batas Tanggal</th>
										</tr>
										<?php
											$piutang = "SELECT * FROM hutang WHERE jenis = 'piutang' ORDER BY tanggal DESC";
											$piutang_query = mysqli_query($koneksi,$piutang);

											while ($row = mysqli_fetch_assoc($piutang_query)) {
												echo '
													<tr>
														<td>'.$row['nama'].'</td>
														<td>'.$row['nominal'].'</td>
														<td>'.$row['tanggal'].'</td>
													</tr>
												';
											}
										?>
									</table>
								</div>
							</div>
						</section>
						<section id="setting" class="tab-pane fade in">
							<form action="setting-proses.php" method="post">
								<label>Ubah Username :</label>
								<input type="text" class="form-control" name="username" placeholder="Username..." autofocus>
								<label>Ubah Password :</label>
								<input type="password" class="form-control" name="password" placeholder="Password...">
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</section>
					</div>
				</div>
			</div>
		</div>
		<script src="jquery.js"></script>
		<script src="bootstrap/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
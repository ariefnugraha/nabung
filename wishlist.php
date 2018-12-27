<?php
 $koneksi = mysqli_connect("localhost","id6644157_root","arieftkj2","id6644157_nabung");
    if (!$koneksi) {echo "Gagal Terhubung Ke Server. Silahkan Coba Lagi";}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Wishlist | Comoin</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link href="bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="wishlist.css" rel="stylesheet">
		<link href="fontawesome/css/all.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<section class="navbar-header">
				<a class="navbar-brand" href="main.php">Nabung</a>
			</section>
			<ul class="nav navbar-nav navbar-right">
				<?php
 $totalPendapatan="SELECT SUM(price) AS totaldapat FROM pendapatan WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";$totalPendapatanQuery=mysqli_query($koneksi,$totalPendapatan);$totalPendapatanRow=mysqli_fetch_assoc($totalPendapatanQuery);$totalPengeluaran="SELECT SUM(price) AS totaldapat FROM pengeluaran WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";$totalPengeluaranQuery=mysqli_query($koneksi,$totalPengeluaran);$totalPengeluaranRow=mysqli_fetch_assoc($totalPengeluaranQuery);$total_uang=$totalPendapatanRow['totaldapat']-$totalPengeluaranRow['totaldapat'];echo '<li style="color:#ffffff;font-size:19px;margin: 10px 20px;">Total Uang Bulan Ini : Rp.'.$total_uang.'</li>';?>
			</ul>
		</nav>

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 col-xs-12 col-sm-4 col-lg-4 menu">
					<ul class="nav nav-pills nav-stacked">
						<li><a href="main.php"><i class="fas fa-home"></i> Home</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-plus"></i> Tambah Data</a>
							<ul class="dropdown-menu">
								<li><a href="#tambahwish" data-toggle="pill">Tambah Wishlist</a></li>
								<li><a href="#tambahnabung" data-toggle="pill" >Tambah Tabungan</a></li>
							</ul>
						</li>
						<li class="active"><a href="#wishlist" data-toggle="pill"><i class="fas fa-gift"></i> Wishlist</a></li>
						<li><a href="#tabungan" data-toggle="pill"><i class="fas fa-wallet"></i> Tabungan</a></li>
					</ul>
				</div>
				<div class="col-md-8 col-xs-12 col-sm-8 col-lg-8 content">
					<div class="uang-smartphone">
						<?php
 echo '<p>Total Uang Bulan Ini : Rp.'.$total_uang.'</p>';?>
					</div>
					<div class="tab-content">
						<section id="tambahwish" class="tab-pane fade">
							<form action="wishlist-proses.php" method="post">
								<label>Nama :</label>
								<textarea class="form-control" name="nama" placeholder="Nama..." autofocus required></textarea>
								<label>Target Tanggal :</label>
								<input type="date" class="form-control" name="tanggal">
								<label>Banyak Barang :</label>
								<input type="number" class="form-control" name="banyak" placeholder="Banyak Barang..." required>
								<label>Harga :</label>
								<input type="number" class="form-control" name="harga" placeholder="Harga..." required>
								<label>Link Detail Barang (Jika Ada) :</label>
								<input type="link" class="form-control" name="link" placeholder="Link Barang...">
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</section>
						<section id="tambahnabung" class="tab-pane fade">
							<form action="tabungan-proses.php" method="post">
								<div class="row">
									<div class="col-md-6 col-xs-12 col-lg-6 col-sm-6">
										<label>Masukkan Nominal Uang :</label>
										<input type="number" class="form-control" name="uang" placeholder="Nominal Uang..." required>
									</div>
									<div class="col-md-6 col-xs-12 col-lg-6 col-sm-6">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</form>
						</section>
						<section id="wishlist" class="tab-pane fade in active">
							<?php
 $wishlist="SELECT * FROM wishlist ORDER BY id DESC";$wishlistquery=mysqli_query($koneksi,$wishlist);echo '<div class="row">';while($row=mysqli_fetch_assoc($wishlistquery)){$tanggal=date('l, d M Y',strtotime($row['target_tanggal']));$getid=$row['id'];$sisaUang="SELECT SUM(nominal) - SUM(total_harga) AS sisa FROM tabungan JOIN wishlist WHERE wishlist.id = $getid";$sisaUangQuery=mysqli_query($koneksi,$sisaUang);$sisa_row=mysqli_fetch_assoc($sisaUangQuery);echo '<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 content">
										<div class="col-md-4 col-xs-4 col-lg-4 col-sm-4 desktop">
											<p>Nama Item :</p>
											<p><b>'.$row['nama'].'</b></p>
											<p>Banyak Barang :</p>
											<p><b>'.$row['banyak_barang'].' X</b></p>
										</div>
										<div class="col-md-4 col-xs-4 col-lg-4 col-sm-4 desktop">
											<p>Link Item :</p>
											<p><a target="_blank" href="'.$row['link_barang'].'">'.$row['link_barang'].'</a></p>
											<p>Total Harga</p>
											<p><b>Rp. '.$row['total_harga'].'</b></p>
										</div>
										<div class="col-md-4 col-xs-4 col-lg-4 col-sm-4 desktop">
											<p>Target Tanggal :</p>
											<p><b>'.$tanggal.'</b></p>
											<p>Sisa Uang Yang Harus Dikumpulkan</p>
											<p><b>Rp. '.$sisa_row['sisa'].'</b></p>
										</div>
										';echo'
										<div class="phone">
											<div class="col-xs-6">
												
												<p>Nama Item :</p>
												<p><b>'.$row['nama'].'</b></p>
												<p>Banyak Item</p>
												<p><b>'.$row['banyak_barang'].' X</b></p>
											</div>
											<div class="col-xs-6">
												<p>Target Tanggal</p>
												<p><b>'.$row['target_tanggal'].'</b></p>
												<p>Link Item</p>
												<p><a target="_blank" href="'.$row['link_barang'].'">'.$row['link_barang'].'</a></p>
											</div>
										</div>
									</div>';}echo '</div>';?>
							
						</section>
						<section id="tabungan" class="tab-pane fade">
							<div class="tabungan-content table-responsive">
								<table class="table table-striped table-bordered">
										<tr>
											<th>Tanggal</th>
											<th>Nominal</th>
										</tr>
										<?php
 $tabungan="SELECT tanggal,nominal FROM tabungan ORDER BY tanggal DESC";$tabungan_query=mysqli_query($koneksi,$tabungan);while($row=mysqli_fetch_assoc($tabungan_query)){echo '
													<tr>
														<td>'.$row['tanggal'].'</td>
														<td>'.$row['nominal'].'</td>
													</tr>
												';}?>
								</table>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
		<script src="jquery.js"></script>
		<script src="bootstrap/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
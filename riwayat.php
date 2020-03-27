<?php 
session_start();

$koneksi = new mysqli("localhost","root","","trainittoko");


//jika tidak ada session login 
if(!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])){
	echo "<script>alert('silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'menu.php'; ?> 	

<!-- <pre><?php print_r($_SESSION); ?></pre> -->

<section class="riwayat">
	<div class="container">
		<h3 style="text-transform: uppercase;">
		riwayat belanja <strong><?php echo $_SESSION["pelanggan"]["nama_pelanggan"]; ?></strong>	
	</h3>
	
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Status</th>
			<th>Total</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
			<?php 
			//$id pelanggan itu mendapatkan riawayat berdasarkan id pelangganyang berada pada url
					$nomor=1;
					$id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];
					$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");

					while($pecah = $ambil->fetch_assoc()){

			 ?>

		<tr>
			<!-- tabel yang muncul -->
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah["tanggal_pembelian"]; ?></td>
			<td>
				<?php echo $pecah["status_pembelian"]; ?>
				<br>	
				<?php if (!empty($pecah['resi_pengiriman'])): ?>
					Nomor Resi : <?php 	echo $pecah['resi_pengiriman'];	 ?>
				<?php endif ?>
			</td>
			<td><?php echo number_format($pecah["total_pembelian"]); ?></td>
			<td>
				<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">Nota</a>


				<?php if (empty($pecah['resi_pengiriman']) && (empty($pecah['status_pembelian']=="sudah kirim pembayaran"))): ?>
				<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-success">Pembayaran</a>	
				<?php endif ?>
			</td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>
</div>

</section>



	

</body>
</html>
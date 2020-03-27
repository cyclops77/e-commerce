<?php 

session_start();
$koneksi = new mysqli("localhost","root","","trainittoko");


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php 	include 'menu.php'; ?>

	<section class="konten">
		<div class="container">
			
		<h2>Detail Pembelian</h2>
<?php 
 $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
 
$detail = $ambil->fetch_assoc();

 ?>



 <?php 	
$kalak = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$_GET[id]'");
$detailbayar = $kalak->fetch_assoc();
  ?>
 

<!-- Jika Pelanggan yang beli tidak sama dengan sesion orang beli, maka akan di larikan ke riwayat.php -->
<?php 	

		$idpelangganyangbeli = $detail["id_pelanggan"];
		//mendapatkan id pelanggan yang lgin dari session
		$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

		if ($idpelangganyangbeli!==$idpelangganyanglogin) {
			echo "<script>alert('jangan nakal');</script>";
			echo "<script>location='riwayat.php';</script>";
			exit();
		}


 ?>


 <div class="row">
 	<div class="col-md-4">
 		<div class="alert alert-success" style="height: 175px;">
 		<h3 style="text-align: center;">Pembelian</h3>
 		<strong>No. Pembelian : <?php echo $detail['id_pembelian']; ?></strong><br>
 		Tanggal : <?php echo $detail['tanggal_pembelian'] ?><br>
 		Total : Rp. <?php echo number_format($detail['total_pembelian']) ?>
 	</div>
 </div>

 
 	<div class="col-md-4">
 		<div class="alert alert-success" style="height: 175px;">
 		<h3 style="text-align: center;">Pelanggan</h3>
 		 <strong><?php echo $detail['nama_pelanggan']; ?></strong>		 
	 <p>
	 	<?php echo $detail['telepon_pelanggan']; ?><br>
	 	<?php echo $detail['email_pelanggan']; ?>
	 </p>
	</div>
 	</div>
 	<div class="col-md-4">
 		<div class="alert alert-success" style="height: 175px;">
 		<h3 style="text-align: center;">Pengiriman</h3>
 		<strong><?php echo $detail['nama_kota']; ?></strong><br>
 		Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?>
 		<p>	
				Alamat : <?php 	echo $detail["alamat_pengiriman"]; ?>
 		</p>
		</div>
 	</div>
 </div>

 <table class="table table-bordered">
 	<thead>
 		<tr>
 			<th style="text-align: center;">No</th>
 			<th style="text-align: center;">Nama </th>
 			<th style="text-align: center;">Harga </th>
 			<th style="text-align: center;">Berat</th>
 			<th style="text-align: center;">Jumlah</th>
 			<th style="text-align: center;">Subberat</th>
 			<th style="text-align: center;">Subtotal</th>
 			<!-- <th>total harga (termasuk aongkir)</th> -->
 		</tr>
 	</thead>
 	<tbody>
 		<?php $nomor=1; ?>
 		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
 		<?php while($pecah=$ambil->fetch_assoc()){ ?>
 		<tr>
 			<td style="text-align: center;"><?php echo $nomor; ?></td>
 			<td style="text-align: center;"><?php echo $pecah['nama']; ?></td>
 			<td style="text-align: center;">Rp. <?php echo number_format($pecah['harga']); ?></td>
 			<td style="text-align: center;"><?php echo $pecah['berat']; ?> gram</td>
 			<td style="text-align: center;"><?php echo $pecah['jumlah']; ?></td>
 			<td style="text-align: center;"><?php echo $pecah['subberat']; ?> gram</td>
 			<td style="text-align: center;">Rp.<?php echo number_format($pecah['subharga']);?></td>
 			<!-- <td>
 				Rp. <?php echo number_format($detail['total_pembelian']); ?>
 			</td> -->
 		</tr>
 		<?php $nomor++; ?>
 	<?php } ?>
 	</tbody>
 </table>


 					<?php if (empty($detail['resi_pengiriman']) && ($detail ['status_pembelian']=="pending") ): ?>
	 <div class="row">
	 	<div class="col-md-12">
	 		<div class="alert alert-danger" >
	 			<p>
	 				Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
	 				<strong>BANK MANDIRI 137-0001200-2323 AN. Alfian Ferdiansyah</strong>
	 				
	 			</p>
	 		</div>
	 	</div>
	 </div>
	 					<?php endif ?>

	 					<?php if (!empty($detail['resi_pengiriman'])): ?>
	 <div class="row">
	 	<div class="col-md-12">
	 		<div class="alert alert-info" >
	 			<p>
	 				Terimakasih telah melakukan pembayaran atas nama Saudara <strong>	<?php echo $detailbayar['nama'] ?></strong> sebesar <strong>Rp. <?php echo number_format($detailbayar['jumlah']); ?> </strong>
	 				<?php echo "hari ini" . date("Y-m-d"); ?>
	 			</p>
	 		</div>
	 	</div>
	 </div>
	 					<?php endif ?>


	 						<?php if ($detail ['status_pembelian']=="sudah kirim pembayaran"): ?>
	 <div class="row">
	 	<div class="col-md-12">
	 		<div class="alert alert-info" >
	 			<p>
	 				<strong>Terimakasih telah mengirim pembayaran, silahkan menunggu konfirmasi dari Admin
	 			</strong></p>
	 		</div>
	 	</div>
	 </div>
	 					<?php endif ?>
 						

		</div>
	</section>





</body>
</html>
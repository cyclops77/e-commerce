<?php 
session_start();

$koneksi = new mysqli("localhost","root","","trainittoko");


//jika tidak ada session login 
if(!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])){
	echo "<script>alert('silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}

//mendapatkan if pembelian dari URL yang ada date_interval_create_from_date_string()	
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();


//mendapatkan id pelanggan yang melakuka pembelian

$id_pelanggan_beli = $detpem["id_pelanggan"];
//mendapatkan id pelanggan yang login

$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if($id_pelanggan_login!==$id_pelanggan_beli){
	echo "<script>alert('jangan nakal');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
 ?>




<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran</title>
<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php 	include 'menu.php'; ?>

		<div class="container">	
				<h2>Konfirmasi Pembayaran</h2>
				<p>	kirim bukti pemabyaran anda disini</p>

				<div class="alert alert-info">Total tagihan anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>


				<form method="post" enctype="multipart/form-data">
					<div class="form-group">	
						<label>Nama Penyetor</label>
						<input type="text" class="form-control" name="nama" required>
					</div>
					<div class="form-group">	
						<label>Bank</label>
						<input type="text" class="form-control" name="bank" required>
					</div>
					<div class="form-group">	
						<label>Jumlah</label>
						<input type="number" class="form-control" name="jumlah" min="<?php echo $detpem['total_pembelian']; ?>" max="<?php echo $detpem['total_pembelian']; ?>" 	>
					</div>
					<div class="form-group">	
						<label>foto bukti</label>
						<input type="file" class="form-control" name="bukti" required>
						<p class="text-danger">Foto Bukti harus JPG maksimal berukuran 2MB</p>
					</div>
					<button class="btn btn-primary" name="kirim">Kirim</button>
				</form>
		</div>

<?php 
//jika tombol kirim di tekan

if(isset($_POST["kirim"])){
	//upload dlu foto bukti 

	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];	
	$namafiks = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("Y-m-d");

//menyimpan pembayaran

	$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpem', '$nama','$bank','$jumlah','$tanggal','$namafiks') ");


//update data pembayaranyang awalnya pending menjadi sudah kirim
	$koneksi->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran' WHERE  id_pembelian='$idpem'");


		echo "<script>alert('Terimakasih telah mengirim bukti pembayaran');</script>";
	echo "<script>location='riwayat.php';</script>";


}

 ?>


</body>
</html>
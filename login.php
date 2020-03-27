
<?php 

session_start();
$koneksi = new mysqli("localhost","root","","trainittoko");

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>


<?php include 'menu.php'; ?>


<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4" style="margin-top: 5%;">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Login Pelanggan</div>
				</div>
				<div class="panel-body">
					<form method="post">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password">
						</div>
						<button class="btn btn-primary" name="login">Login</button>
					</form>




				</div>
			</div>
		</div>
	</div>
</div>

<?php 
//jika di klik simpan 
if (isset($_POST["login"])) {
	$email = $_POST["email"];
	$password = $_POST["password"];
	# lalu kita cek akun
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

//ambil akun yang diambil
	$akunyangcocok = $ambil->num_rows;

	//jika 1 akun yg ada di db ada yg cocok maka di loginkan 
	if ($akunyangcocok==1) {
		# anda akana diarahkan menuju login(dalam bentuk array ini yg diambil)
		$akun = $ambil->fetch_assoc();
		//simpan di session pelanggan
		$_SESSION["pelanggan"] = $akun;
		echo "<script>alert('anda Sukses login');</script>";

		//jika itu sudah belanja

		if(isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])){

			echo "<script>location='checkout.php';</script>";
		}
		else{
			echo "<script>location='riwayat.php';</script>";
		}


	}
	else{
		echo "<script>alert('anda gagal login, periksa akun anda');</script>";
		echo "<script>location='login.php';</script>";
	}

}



 ?>



</body>
</html>
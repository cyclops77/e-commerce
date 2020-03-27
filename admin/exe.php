<?php 
$koneksi = new mysqli("localhost","root","","trainittoko");
// session_start();

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Tesst daftar</title>
 	 <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>e commerce : Login</title>
  <!-- BOOTSTRAP STYLES-->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLES-->
  <link href="assets/css/custom.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
 </head>
 <body>
 	<form method="post" class="form-horizontal">
 			<div class="form-group">
 				<label class="control-label col-md-3">Username</label>
 				<div class="col-md-7">
 					<input type="text" class="form-control" name="username" required>
 				</div>
 			</div>
 			<div class="form-group">
 				<label class="control-label col-md-3">Password</label>
 				<div class="col-md-7">
 				<input type="text" class="form-control" name="pass" required>
				</div>
 			</div>
 			<div class="form-group">
 				<label class="control-label col-md-3">Nama Lengkap</label>
 					<div class="col-md-7">
 				<input type="text" class="form-control" name="namalengkap" required>
 				</div>
 			</div>
 			<div class="form-group">
 				<label class="control-label col-md-3" >email</label>
 				<div class="col-md-7">
 				<input type="email" class="form-control" name="email" required>
 				</div>
 			</div>
 			<div class="form-group">
 				<label class="control-label col-md-3">nomor hp</label>
 				<div class="col-md-7">
 					<input type="number" class="form-control" name="nohp" required>
 				</div>
 			</div>
 			<div class="form-group">
 				<label class="control-label col-md-3">alamat</label>
 				<div class="col-md-7">
 					<input type="text" class="form-control" name="alamat" required>
 				</div>
 			</div>

 			<div class="form-group">
 				<div class="col-md-7 col-md-offset-3">
 					<button class="btn btn-primary" name="daftar">Daftar</button>
 				</div>
 			</div>
 	</form>

<?php 

if (isset($_POST['daftar'])) {


	$username = $_POST["username"];
	$password = $_POST["pass"];
	$namalengkap = $_POST["namalengkap"];	
	$email = $_POST["email"];
	$nohp = $_POST["nohp"];
	$alamat = $_POST["alamat"];

	$yusernem = $koneksi->query("SELECT * FROM admin WHERE username='$username'");

	$ygcocok = $yusernem->num_rows;

	if($ygcocok == 1){
		echo "<script>alert('username sudah terdaftarkan');</script>";
		echo "<script>location='exe.php';</script>";
	}
	else{
		$koneksi->query("INSERT INTO admin(username, password, nama_lengkap, email, nomor_hp, alamat ) VALUES ('$username','$password', '$namalengkap','$email', '$nohp', '$alamat')");

		echo "<script>alert('Daftar Sukses, Silahkan Login');</script>";
		echo "<script>location='login.php';</script>";
	}

}

 ?>


 </body>
 </html>
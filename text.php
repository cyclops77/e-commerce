<?php 


$koneksi = new mysqli("localhost","root","","trainittoko");


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>nob</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
<table class="table table-bordered">
		<thead>
			<tr>
				<th>Nomor</th>
				<th>Username</th>
				<th>Nama Lengkap</th>
			</tr>
		</thead>
		<tbody>
	<?php 
		$nomor = 1;
		$admin = $koneksi->query("SELECT * FROM admin");
		while($peradmin = $admin->fetch_assoc()){
	 ?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $peradmin['username']; ?></td>
				<td><?php echo $peradmin['nama_lengkap']; ?></td>
			</tr>
<?php $nomor++; ?>
<?php } ?>
		</tbody>


	</table>
</div>
	


</body>
</html>
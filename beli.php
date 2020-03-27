<?php 	
session_start();
//untuk mendapatkan id yang akan dibeli
$id_produk = $_GET['id'];


//jika sdh ada produk tsb dlm keranjang maka produk tsb +1
if(isset($_SESSION['keranjang'][$id_produk])){
	$_SESSION['keranjang'][$id_produk]+=1;
}
//jika blm ada
else{
	$_SESSION['keranjang'][$id_produk] = 1;
}


// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

//lari ke halm keranjang


echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='keranjang.php';</script>";
 ?>
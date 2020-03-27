

<h2>Data pembelian</h2>
<table class="table table-bordered" style="text-align: center;">
	<thead >
		<tr >
			<th style="text-align: center;">No</th>
			<th style="text-align: center;">Nama Pelanggan</th>
			<th style="text-align: center;">Tanggal</th>
			<th style="text-align: center;">Status Pembelian</th>
			<th style="text-align: center;">Total</th>
			<th style="text-align: center;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_pelanggan']; ?></td>
			<td><?php echo $pecah['tanggal_pembelian']; ?></td>
			<td><?php echo $pecah['status_pembelian']; ?></td>
			<td><?php echo $pecah['total_pembelian']; ?></td>
			<td>
				<a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info">detail</a>
				

				<?php if($pecah['status_pembelian'] == "sudah kirim pembayaran"	): ?>
				<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-success">pembayaran</a>
				<?php endif ?>
			</td>

		</tr>
		<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>
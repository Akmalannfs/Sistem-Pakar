<h2>Data Penyakit</h2>

<table class="table table-bordered">
<p><a href="index.php?halaman=tambahpenyakit"class="btn-primary btn">Tambah Penyakit</a></p>
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center" width="120px">Kode Penyakit</th>
            <th class="text-center" width="150px">Nama Penyakit</th>
            <th class="text-center" width="200px">Keterangan</th>
            <th class="text-center" width="200px">Solusi</th>
            <th class="text-center" width="150px">Aksi</th>
            
        </tr>
        </thead>
        <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$conn->query("SELECT * FROM penyakit");?>
        <?php while($pecah = $ambil->fetch_assoc()){?>
         <tr>
            <td class="text-center"><?php echo $nomor; ?></td>
            <td class="text-center"><?php echo $pecah['kode_penyakit']; ?></td>
            <td class="text-center"><?php echo $pecah['nama_penyakit']; ?></td>
            <td><?php echo $pecah['keterangan']; ?></td>
            <td><?php echo $pecah['solusi']; ?></td>
            <td class="text-center">
            <a href="index.php?halaman=ubahpenyakit&id=<?php echo $pecah['id_penyakit'] ?>" class="btn-warning btn">Edit</a>
            <a href="index.php?halaman=hapuspenyakit&id=<?php echo $pecah['id_penyakit'] ?>" onclick="return confirm('Yakin ingin hapus ?')" class="btn-danger btn">Hapus</a>
            </td>
             </tr>
             <?php $nomor++; ?>
             <?php } ?>
            </tbody>
</table>
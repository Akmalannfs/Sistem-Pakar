<h2>Data Gejala</h2>

<table class="table table-bordered">
<p><a href="index.php?halaman=tambahgejala"class="btn-primary btn">Tambah Gejala</a></p>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Gejala</th>
            <th>Nama Gejala</th>
            <th>Nilai CF Pakar</th>
            <th width="150px">Aksi</th>
            
        </tr>
        </thead>
        <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$conn->query("SELECT * FROM gejala");?>
        <?php while($pecah = $ambil->fetch_assoc()){?>
         <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['kode_gejala']; ?></td>
            <td><?php echo $pecah['nama_gejala']; ?></td>
            <td><?php echo $pecah['cf_pakar']; ?></td>
            <td>
            <a href="index.php?halaman=ubahgejala&id=<?php echo $pecah['id_gejala'] ?>"  class="btn-warning btn">Edit</a>
            <a href="index.php?halaman=hapusgejala&id=<?php echo $pecah['id_gejala'] ?>"  onclick="return confirm('Yakin ingin hapus ?')" class="btn-danger btn">Hapus</a>
            </td>
             </tr>
             <?php $nomor++; ?>
            <?php } ?>
            </tbody>
</table>
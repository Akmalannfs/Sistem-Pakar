<h2>Data Aturan</h2>

<table class="table table-bordered">
<p><a href="index.php?halaman=tambahaturan"class="btn-primary btn">Tambah Aturan</a></p>
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Gejala</th>
            <th class="text-center">Penyakit</th>
            <th class="text-center" width="150px">Aksi</th>
            
        </tr>
        </thead>
        <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$conn->query("SELECT * FROM aturan a, gejala g, penyakit p WHERE a.id_gejala=g.id_gejala AND a.id_penyakit=p.id_penyakit ORDER BY a.id_aturan");?>
        <?php while($pecah = $ambil->fetch_assoc()){?>
         <tr>
            <td class="text-center"><?php echo $nomor; ?></td>
            <td class="text-center"><?php echo $pecah['kode_gejala']; ?> - <?php echo $pecah['nama_gejala']; ?></td>
            <td class="text-center"><?php echo $pecah['kode_penyakit']; ?> - <?php echo $pecah['nama_penyakit']; ?></td>
            <td class="text-center">
            <a href="index.php?halaman=ubahaturan&id=<?php echo $pecah['id_aturan'] ?>"  class="btn-warning btn">Edit</a>
            <a href="index.php?halaman=hapusaturan&id=<?php echo $pecah['id_aturan'] ?>" onclick="return confirm('Yakin ingin hapus ?')" class="btn-danger btn">Hapus</a>
            </td>
             </tr>
             <?php $nomor++; ?>
             <?php } ?>
            </tbody>
</table>
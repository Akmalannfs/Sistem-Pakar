<h2>Data Admin</h2>

<table class="table table-bordered">
<p><a href="index.php?halaman=tambahadmin"class="btn-primary btn">Tambah Admin</a></p>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Admin</th>
            <th>Username</th>
            <th>Password</th>
            <th width="150px">Aksi</th>
            
        </tr>
        </thead>
        <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$conn->query("SELECT * FROM admin");?>
        <?php while($pecah = $ambil->fetch_assoc()){?>
         <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_admin']; ?></td>
            <td><?php echo $pecah['username']; ?></td>
            <td><?php echo $pecah['password']; ?></td>
            <td>
            <a href="index.php?halaman=ubahadmin&id=<?php echo $pecah['id_admin'] ?>"  class="btn-warning btn">Edit</a>
            <a href="index.php?halaman=hapusadmin&id=<?php echo $pecah['id_admin'] ?>"  onclick="return confirm('Yakin ingin hapus ?')" class="btn-danger btn">Hapus</a>
            </td>
             </tr>
             <?php $nomor++; ?>
            <?php } ?>
            </tbody>
</table>
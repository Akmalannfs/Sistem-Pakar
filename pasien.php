<h2>Data Pasien</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Umur</th>
            <th>No.Telp</th>
        </tr>
    </thead>
    <tbody>
    <?php $nomor=1; ?>
        <?php $ambil=$conn->query("SELECT * FROM pasien");?>
        <?php while($pecah = $ambil->fetch_assoc()){?>
         <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_pasien']; ?></td>
            <td><?php echo $pecah['email_pasien']; ?></td>
            <td><?php echo $pecah['jenis_kelamin']; ?></td>
            <td><?php echo $pecah['umur_pasien']; ?></td>
            <td><?php echo $pecah['telp_pasien']; ?></td>
          
             </tr>
             <?php $nomor++; ?>
            <?php } ?>
    </tbody>
</table>
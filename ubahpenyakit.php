<h2>Edit Data Penyakit</h2>

<?php
$ambil = $conn->query("SELECT * FROM penyakit WHERE id_penyakit='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Kode Penyakit</label>
        <input type="text" class="form-control" name="kode" value="<?php echo $pecah['kode_penyakit']; ?>">
    </div>
    <div class="form-group">
        <label>Nama Penyakit</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_penyakit']; ?>">
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <textarea type="text" class="form-control" name="keterangan" rows="5"><?php echo $pecah['keterangan']; ?></textarea>
    </div>
    <div class="form-group">
        <label>Solusi</label>
        <textarea type="text" class="form-control" name="solusi" rows="5"><?php echo $pecah['solusi']; ?></textarea>
    </div>


    <button class="btn-primary btn" name="ubah">Edit</button>
</form>
<?php
if (isset($_POST['ubah']))
{
    $conn->query("UPDATE penyakit SET kode_penyakit='$_POST[kode]',
        nama_penyakit='$_POST[nama]',
        keterangan='$_POST[keterangan]',
        solusi='$_POST[solusi]' 
        WHERE id_penyakit='$_GET[id]'");

echo "<script>alert('Data Penyakit Telah Diubah');</script>";
echo "<script>location='index.php?halaman=penyakit';</script>";
}
?>

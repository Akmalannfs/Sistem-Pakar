<h2>Edit Data Gejala</h2>

<?php
$ambil = $conn->query("SELECT * FROM gejala WHERE id_gejala='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Kode Gejala</label>
        <input type="text" class="form-control" name="kode" value="<?php echo $pecah['kode_gejala']; ?>">
    </div>
    <div class="form-group">
        <label>Nama Gejala</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_gejala']; ?>">
    </div>
    <div class="form-group">
        <label>Nilai CF Pakar</label>
        <select class="form-control" name="nilai">
        <option value=""><?php echo $pecah['cf_pakar']; ?></option>
        <option>0</option>
        <option>0.2</option>
        <option>0.4</option>
        <option>0.6</option>
        <option>0.8</option>
        <option>1</option>
        </select>
    </div>
    <button class="btn-primary btn" name="ubah">Edit</button>
</form>
<?php
if (isset($_POST['ubah']))

{
        $conn->query("UPDATE gejala SET kode_gejala='$_POST[kode]',
        nama_gejala='$_POST[nama]',
        cf_pakar='$_POST[nilai]' 
        WHERE id_gejala='$_GET[id]'");

    echo "<script>alert('Data Gejala Telah Diubah');</script>";
    echo "<script>location='index.php?halaman=gejala';</script>";
    }
?>
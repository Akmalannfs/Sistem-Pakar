<h2>Tambah Penyakit</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Kode Penyakit</label>
        <input type="text" class="form-control" name="kode">
    </div>
    <div class="form-group">
        <label>Nama Penyakit</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <textarea type="text" class="form-control" name="keterangan" rows="5"></textarea>
    </div>
    <div class="form-group">
        <label>Solusi</label>
        <textarea type="text" class="form-control" name="solusi" rows="5"></textarea>
    </div>


    <button class="btn-primary btn" name="simpan">Simpan</button>
</form>
<?php
if (isset($_POST['simpan']))
{
    $conn->query("INSERT INTO penyakit 
    (kode_penyakit,nama_penyakit,keterangan,solusi) 
    VALUES('$_POST[kode]','$_POST[nama]','$_POST[keterangan]','$_POST[solusi]' )");

echo "<div class='alert alert-info'>Data Tersimpan</div>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=penyakit'>";
}
?>
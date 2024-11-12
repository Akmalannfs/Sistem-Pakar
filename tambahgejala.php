<h2>Tambah Gejala</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Kode Gejala</label>
        <input type="text" class="form-control" name="kode">
    </div>
    <div class="form-group">
        <label>Nama Gejala</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label>Nilai CF Pakar</label>
        <select class="form-control" name="nilai">
        <option value="">Pilih</option>
        <option>0</option>
        <option>0.2</option>
        <option>0.4</option>
        <option>0.6</option>
        <option>0.8</option>
        <option>1</option>
        </select>
    </div>
    <button class="btn-primary btn" name="save">Simpan</button>
</form>
<?php
if (isset($_POST['save']))
{
    $conn->query("INSERT INTO gejala 
    (kode_gejala,nama_gejala,cf_pakar) 
    VALUES('$_POST[kode]','$_POST[nama]','$_POST[nilai]' )");

echo "<div class='alert alert-info'>Data Tersimpan</div>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=gejala'>";
}
?>
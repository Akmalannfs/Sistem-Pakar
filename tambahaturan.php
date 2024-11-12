<h2>Tambah Aturan</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Gejala</label>
        <select name="id_gejala" class="form-control">
        <?php $ambil=$conn->query("SELECT * FROM gejala ORDER BY id_gejala");?>
        <?php while($pecah = $ambil->fetch_assoc()){
            echo "<option value='".$pecah['id_gejala']."'>".$pecah['kode_gejala']." - ".$pecah['nama_gejala']." - ".$pecah['cf_pakar']."</option>";
            }?>
        </select>
    </div>
    <div class="form-group">
        <label>Penyakit</label>
        <select name="id_penyakit" class="form-control">
        <?php $ambil=$conn->query("SELECT * FROM penyakit ORDER BY id_penyakit");?>
        <?php while($pecah = $ambil->fetch_assoc()){
            echo "<option value='".$pecah['id_penyakit']."'>".$pecah['kode_penyakit']." - ".$pecah['nama_penyakit']."</option>";
            }?>
        </select>
    </div>
    <button class="btn-primary btn" name="save">Simpan</button>
</form>
<?php
if (isset($_POST['save']))
{
    $conn->query("INSERT INTO aturan 
    (id_gejala,id_penyakit) 
    VALUES('$_POST[id_gejala]','$_POST[id_penyakit]')");

echo "<div class='alert alert-info'>Data Tersimpan</div>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=aturan'>";
}
?>
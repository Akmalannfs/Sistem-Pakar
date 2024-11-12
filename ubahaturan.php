<h2>Edit Data Aturan</h2>

<?php
$data = mysqli_query($conn, "SELECT * FROM aturan WHERE id_aturan='" . mysqli_real_escape_string($conn, $_GET['id']) . "'");
$a = mysqli_fetch_array($data);
?>
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_aturan" value="<?= htmlspecialchars($a['id_aturan']) ?>">
    <div class="form-group">
        <label>Gejala</label>
        <select name="id_gejala" class="form-control">
        <?php 
        $gej = mysqli_query($conn, "SELECT * FROM gejala WHERE id_gejala='" . mysqli_real_escape_string($conn, $a['id_gejala']) . "'");
        $dG = mysqli_fetch_array($gej);
        echo "<option selected value='" . htmlspecialchars($dG['id_gejala']) . "'>" . htmlspecialchars($dG['kode_gejala']) . " - " . htmlspecialchars($dG['nama_gejala']) . " - " . htmlspecialchars($dG['cf_pakar']) . "</option>";
    
        $gejala = mysqli_query($conn, "SELECT * FROM gejala ORDER BY id_gejala");
        while($dtG = mysqli_fetch_array($gejala)){
            echo "<option value='" . htmlspecialchars($dtG['id_gejala']) . "'>" . htmlspecialchars($dtG['kode_gejala']) . " - " . htmlspecialchars($dtG['nama_gejala']) . " - " . htmlspecialchars($dtG['cf_pakar']) . "</option>";
        }?>
        </select>
    </div>

    <div class="form-group">
        <label>Penyakit</label>
        <select name="id_penyakit" class="form-control">
        <?php 
        $pen = mysqli_query($conn, "SELECT * FROM penyakit WHERE id_penyakit='" . mysqli_real_escape_string($conn, $a['id_penyakit']) . "'");
        $dP = mysqli_fetch_array($pen);
        echo "<option selected value='" . htmlspecialchars($dP['id_penyakit']) . "'>" . htmlspecialchars($dP['kode_penyakit']) . " - " . htmlspecialchars($dP['nama_penyakit']) . "</option>";
    
        $penyakit = mysqli_query($conn, "SELECT * FROM penyakit ORDER BY id_penyakit");
        while($dtP = mysqli_fetch_array($penyakit)){
            echo "<option value='" . htmlspecialchars($dtP['id_penyakit']) . "'>" . htmlspecialchars($dtP['kode_penyakit']) . " - " . htmlspecialchars($dtP['nama_penyakit']) . "</option>";
        }?>
        </select>
    </div>
    <button class="btn-primary btn" name="ubah">Edit</button>
</form>

<?php
if (isset($_POST['ubah'])) {

    $id_aturan= mysqli_real_escape_string($conn, $_POST['id_aturan']);
    $id_gejala= mysqli_real_escape_string($conn, $_POST['id_gejala']);
    $id_penyakit= mysqli_real_escape_string($conn, $_POST['id_penyakit']);

    mysqli_query($conn, "UPDATE aturan SET id_gejala='$id_gejala', id_penyakit='$id_penyakit' WHERE id_aturan='$id_aturan'");

    echo "<script>alert('Data Aturan Telah Diubah');</script>";
    echo "<script>location='index.php?halaman=aturan';</script>";
}
?>

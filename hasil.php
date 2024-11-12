<?php
session_start();
include 'db.php';

if (!isset($_SESSION["pasien"]) || empty($_SESSION["pasien"])) {
    echo "<script>alert('Silahkan Login Terlebih Dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

$username = $_SESSION['pasien']['username_pasien'];
$pas = mysqli_query($conn, "SELECT * FROM pasien WHERE username_pasien='$username'");
if ($pas) {
    $p = mysqli_fetch_assoc($pas);
    $id_pasien = $p['id_pasien'];
} else {
    echo "Error: " . mysqli_error($conn);
    exit();
}

if (!isset($_GET['no_regdiagnosa'])) {
    echo "<script>alert('Tidak ada nomor registrasi diagnosa yang diberikan.');</script>";
    echo "<script>location='history.php';</script>";
    exit();
}

$no_regdiagnosa = filter_input(INPUT_GET, 'no_regdiagnosa', FILTER_SANITIZE_STRING);

$highestPercentage = 0;
$penyakiTerbesar = "";
$data = mysqli_query($conn, "SELECT * FROM penyakit ORDER BY id_penyakit");
while ($a = mysqli_fetch_assoc($data)) {
    $stmt1 = $conn->prepare("
        SELECT p.nama_penyakit, g.nama_gejala, g.cf_pakar, d.nilai_pasien 
        FROM penyakit p
        JOIN aturan a ON p.id_penyakit = a.id_penyakit
        JOIN gejala g ON g.id_gejala = a.id_gejala
        JOIN diagnosa d ON g.id_gejala = d.id_gejala
        WHERE d.id_pasien = ? AND d.no_regdiagnosa = ?
        AND p.id_penyakit = ?
    ");
    if (!$stmt1) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt1->bind_param("isi", $id_pasien, $no_regdiagnosa, $a['id_penyakit']);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $jml_data = $result1->num_rows;
    $cf_lama = 0;
    while ($r1 = $result1->fetch_assoc()) {
        $cfhe = $r1['cf_pakar'] * $r1['nilai_pasien'];
        if ($jml_data > 0) {
            $cf1 = $cf_lama;
            $cf2 = $cfhe;
            $cfcombine = $cf1 + $cf2 * (1 - $cf1);
            $cf_lama = $cfcombine;
        }
    }
    if ($cf_lama > 0) {
        $percentage = $cf_lama * 100;
        if ($percentage > $highestPercentage) {
            $highestPercentage = $percentage;
            $penyakiTerbesar = $a['nama_penyakit'];
        }
    }
    $stmt1->close();
}

$roundedPercentage = round($highestPercentage, 2);  // Membulatkan hasil ke dua desimal
?>

<!DOCTYPE html>
<html>
<head>
<link href="gambar/remaja.png" rel="icon" type="image/png">
    <title>Hasil Diagnosa</title>
</head>
<body>
<?php include 'navbar.php'; ?>
<section class="hasil">
    <div class="container">
        <h3>Kesimpulan</h3>
        <br>
        <h4>
            <?php
            echo "
            <div>
            Berdasarkan hasil dari perhitungan metode <b>Certainty Factor</b>, dapat disimpulkan bahwa
            anda kemungkinan besar menderita penyakit <span><b>$penyakiTerbesar</b></span> dengan tingkat keyakinan 
            <span><b>" . number_format($roundedPercentage, 2) . "%.</b></span>
            </div>
            ";
            ?>
        </h4>
    </div>
    <br><br>

    <div class="container">
        <h3>Keterangan</h3>
        <br>
        <h4>
            <?php
            $data = mysqli_query($conn, "SELECT * FROM penyakit WHERE nama_penyakit='$penyakiTerbesar'");
            if ($data) {
                $a = mysqli_fetch_assoc($data);
                echo "
                <div class='text-justify'>
                $a[keterangan]
                </div>
                ";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            ?>
        </h4>
    </div>
    <br><br>

    <div class="solusi">
        <h3>Solusi</h3>
        <br>
        <h4>
            <?php
            $data = mysqli_query($conn, "SELECT * FROM penyakit WHERE nama_penyakit='$penyakiTerbesar'");
            if ($data) {
                $a = mysqli_fetch_assoc($data);
                echo "
                <div>
                $a[solusi]
                </div>
                ";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            ?>
        </h4>
        <br>
        <p> Note : Ini hanya perhitungan metode certainty factor, untuk pemeriksaan dan pengobatan lebih lanjut silahkan bertemu psikolog, psikiater, atau konselor yang berpengalaman, untuk dukungan berkelanjutan dan penyesuaian strategi penanganan</p>
    </div>
    <br><br>

    <form action="diagnosa.php?aksi=simpan" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_pasien" value="<?php echo $id_pasien; ?>">
        <input type="hidden" name="no_regdiagnosa" value="<?php echo htmlspecialchars($no_regdiagnosa); ?>">
        <input type="hidden" name="penyakit_cf" value="<?php echo htmlspecialchars($penyakiTerbesar); ?>">
        <input type="hidden" name="nilai_cf" value="<?php echo htmlspecialchars($roundedPercentage); ?>"> <!-- Nilai sudah dibulatkan -->

        <div>
            <a href="diagnosa.php">Diagnosa Ulang</a>
            <input type="submit" value="Simpan Diagnosa" class="btn btn-primary">
        </div>
    </form>
</div>
</section>
</body>
<?php require "footer.php"; ?>
</html>

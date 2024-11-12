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
    $nama_pasien = $p['nama_pasien']; // Ambil nama pasien
} else {
    echo "Error: " . mysqli_error($conn);
    exit();
}

if (isset($_GET['no_regdiagnosa'])) {
    $no_regdiagnosa = filter_input(INPUT_GET, 'no_regdiagnosa', FILTER_SANITIZE_STRING);

    // Ambil data diagnosa
    $hasil = mysqli_query($conn, "SELECT * FROM hasil WHERE no_regdiagnosa='$no_regdiagnosa' AND id_pasien='$id_pasien'");
    $diagnosa = mysqli_fetch_assoc($hasil);

    if (!$diagnosa) {
        echo "<script>alert('Data diagnosa tidak ditemukan');</script>";
        echo "<script>location='history.php';</script>";
        exit();
    }

    $penyakit_cf = $diagnosa['penyakit_cf'];
    $nilai_cf = $diagnosa['nilai_cf'];

    // Ambil data penyakit
    $penyakit = mysqli_query($conn, "SELECT * FROM penyakit WHERE nama_penyakit='$penyakit_cf'");
    $p = mysqli_fetch_assoc($penyakit);
    $keterangan = $p['keterangan'];
    $solusi = $p['solusi'];
} else {
    echo "<script>alert('No Reg Diagnosa tidak diberikan');</script>";
    echo "<script>location='history.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="gambar/remaja.png" rel="icon" type="image/png">
    <title>Cetak Hasil Diagnosa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, h4 {
            color: #343a40;
        }
        .content h3 {
           color: #ffd803
        }
        span{
            color: #ffd803

        }
        p {
            font-size: 1rem;
            color: #ff0000;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 20px;
        }
        .text-justify {
            text-align: justify;
        }
        .no-print {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ffd803;
            color: white;
            text-align: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hasil Diagnosa Sistem Pakar</h2><br>
        <div class="data">
            <h3>Nama Pasien: <?php echo htmlspecialchars($nama_pasien); ?></h3>
            <h3>No Reg Diagnosa: <?php echo htmlspecialchars($no_regdiagnosa); ?></h3>
            <h3>Tanggal Diagnosa: <?php echo htmlspecialchars($diagnosa['tgl_diagnosa']); ?></h3>
        </div>
        <br>
        <div class="content">
            <h3>Kesimpulan</h3>
            <h4>
                <div class='text-justify'>
                Berdasarkan hasil dari perhitungan metode <b>Certainty Factor</b>, dapat disimpulkan bahwa
                anda kemungkinan besar menderita penyakit <span><b><?php echo htmlspecialchars($penyakit_cf); ?></b></span> dengan tingkat keyakinan 
                <span><b><?php echo number_format($nilai_cf, 2); ?>%</b></span>
                </div>
            </h4>
        </div>
        <div class="content">
            <h3>Keterangan</h3>
            <h4>
                <div class='text-justify'>
                <?php echo nl2br(htmlspecialchars($keterangan)); ?>
                </div>
            </h4>
        </div>
        <div class="content">
            <h3>Solusi</h3>
            <h4>
                <div class='text-justify'>
                <?php echo nl2br(htmlspecialchars($solusi)); ?>
                </div>
            </h4>
            <br>
            <p><b>Note: Untuk pengobatan lebih lanjut silahkan bertemu psikolog, psikiater, atau konselor yang berpengalaman, untuk dukungan berkelanjutan dan penyesuaian strategi penanganan.</b></p>
        </div>
        <button class="no-print" onclick="window.print()">Cetak</button>
    </div>
</body>
</html>

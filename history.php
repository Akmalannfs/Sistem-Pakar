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
?>

<!DOCTYPE html>
<html>
<head>
<link href="gambar/remaja.png" rel="icon" type="image/png">
    <title>Riwayat Diagnosa</title>
</head>
<body>
<?php include 'navbar.php'; ?>
<section class="riwayat">
    <div class="container">
        <h2>Riwayat Diagnosa <?php echo htmlspecialchars($nama_pasien); ?></h2> <!-- Sisipkan nama pasien -->
        <table class="table">
            <tr>
                <th>No</th>
                <th>No Reg Diagnosa</th>
                <th>Tanggal Diagnosa</th>
                <th>Penyakit</th>
                <th>Nilai CF</th>
                <th>Aksi</th>
            </tr>
            <?php
            $riwayat = mysqli_query($conn, "SELECT * FROM hasil WHERE id_pasien='$id_pasien' ORDER BY tgl_diagnosa DESC");
            $i = 0;
            while ($r = mysqli_fetch_assoc($riwayat)) {
                $i++;
                echo "
                <tr>
                    <td>$i</td>
                    <td>{$r['no_regdiagnosa']}</td>
                    <td>{$r['tgl_diagnosa']}</td>
                    <td>{$r['penyakit_cf']}</td>
                    <td>{$r['nilai_cf']}%</td>
                    <td>
                        <a href='dethasil.php?no_regdiagnosa={$r['no_regdiagnosa']}' class='btn btn-primary'>Detail</a>
                    </td>
                </tr>
                ";
            }
            ?>
        </table>
    </div>
</section>
</body>
</html>

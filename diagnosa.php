<!DOCTYPE html>
<html>
<head>
<link href="gambar/remaja.png" rel="icon" type="image/png">
    <title>Diagnosa</title>
</head>
<body>
<?php
session_start();
include 'db.php';
date_default_timezone_set('Asia/Jakarta');

// Pastikan session 'username_pasien' ada di dalam array 'pasien'
if (!isset($_SESSION["pasien"]) OR empty($_SESSION["pasien"])) {
    echo "<script>alert('Silahkan Login Terlebih Dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

// Membuat no_regdiagnosa
function generateRandomString($Length) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $Length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$panjangString = 10;

if (isset($_GET['aksi']) && $_GET['aksi'] == 'diagnosa') {
    // Cek apakah setidaknya satu gejala dipilih
    $isGejalaDipilih = false;
    foreach ($_POST['kondisi'] as $value) {
        if ($value != 'Pilih Kondisi') {
            $isGejalaDipilih = true;
            break;
        }
    }

    if (!$isGejalaDipilih) {
        echo "<script>alert('Tidak Ada Gejala Yang Dipilih, Silahkan Mengisi Gejala Terlebih Dahulu! :)'); window.history.back();</script>";
        exit();
    }

    // Lanjutkan dengan proses diagnosa
    $no_regdiagnosa = generateRandomString($panjangString);
    $tgl_diagnosa = date('Y-m-d');
    $id_pasien = $_POST['id_pasien'];

    $query = "INSERT INTO diagnosa(no_regdiagnosa, tgl_diagnosa, id_pasien, id_gejala, nilai_pasien) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $query)) {
        foreach ($_POST['kondisi'] as $key => $value) {
            if ($value != 'Pilih Kondisi') {
                $kondisi = $value;
                $id_gejala = $_POST['id_gejala'][$key];
                mysqli_stmt_bind_param($stmt, "ssiss", $no_regdiagnosa, $tgl_diagnosa, $id_pasien, $id_gejala, $kondisi);
                mysqli_stmt_execute($stmt);
            }
        }
        mysqli_stmt_close($stmt);
        header("Location: hasil.php?no_regdiagnosa=$no_regdiagnosa");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }


} elseif (isset($_GET['aksi']) && $_GET['aksi'] == 'simpan') {
    $id_pasien = $_POST['id_pasien'];
    $no_regdiagnosa = $_POST['no_regdiagnosa'];
    $tgl_diagnosa = date('Y-m-d');
    $penyakit_cf = $_POST['penyakit_cf'];
    $nilai_cf = $_POST['nilai_cf'];

    $query = "INSERT INTO hasil(id_pasien, no_regdiagnosa, tgl_diagnosa, penyakit_cf, nilai_cf) VALUES ('$id_pasien','$no_regdiagnosa','$tgl_diagnosa','$penyakit_cf' ,'$nilai_cf')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Berhasil Menyimpan');</script>";
        echo "<script>location='history.php';</script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

include 'navbar.php';

$username = $_SESSION['pasien']['username_pasien'];
$pas = mysqli_query($conn, "SELECT * FROM pasien WHERE username_pasien='$username'");

if ($pas) {
    $p = mysqli_fetch_assoc($pas); // Menggunakan mysqli_fetch_assoc
    $id_pasien = $p['id_pasien'];
} else {
    echo "Error: " . mysqli_error($conn);
    exit();
}
?>

<section class="diagnosa">
    <div class="container">
        <?php if (empty($_GET['no_regdiagnosa'])) { ?>
         
        <h2>Diagnosa</h2>

        <?php } else {} ?>

        <?php if (empty($_GET['no_regdiagnosa'])) { ?>
        <form action="diagnosa.php?aksi=diagnosa" method="POST" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>Gejala</th>
                    <th>Pilih</th>
                </tr>
                <?php
                $data = mysqli_query($conn, "SELECT * FROM gejala ORDER BY id_gejala");
                $i = 0;
                while ($a = mysqli_fetch_assoc($data)) {
                    $i++;
                    echo "
                    <tr>
                    <td>$i</td>
                    <td>Apakah anda mengalami gejala <b>{$a['nama_gejala']}</b>?</td>
                    <td>
                    <select class='form-control' name='kondisi[]'>
                    <option selected disable>Pilih Kondisi</option>
                    <option value='0'>Tidak Yakin</option>
                    <option value='0.2'>Kurang Yakin</option>
                    <option value='0.4'>Mungkin</option>
                    <option value='0.6'>Kemungkinan Besar</option>
                    <option value='0.8'>Hampir Yakin</option>
                    <option value='1'>Yakin</option>
                    </select>
                    </td>
                    </tr>
                    <input type='hidden' name='id_gejala[]' value='{$a['id_gejala']}'>
                    ";
                }
                ?>
            </table>
            <input type="hidden" name="id_pasien" value="<?= $id_pasien ?>">
            <input type="submit" value="Progres Diagnosa" class="btn btn-primary"></input>
        </form>
    </div>
    <br><br>
    
    <?php } else { ?>
    <div class="container">
        <center><h2>HASIL ANALISA DIAGNOSA</h2></center>
        <hr>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Penyakit</th>
                <th>Gejala</th>
                <th>CF Pakar</th>
                <th>CF User</th>
                <th>Nilai CF</th>
            </tr>
            <?php
            if (isset($_GET['no_regdiagnosa'])) {
                $no_regdiagnosa = filter_input(INPUT_GET, 'no_regdiagnosa', FILTER_SANITIZE_STRING);
                $stmt = $conn->prepare("
                    SELECT p.nama_penyakit, g.nama_gejala, g.cf_pakar, d.nilai_pasien 
                    FROM penyakit p
                    JOIN aturan a ON p.id_penyakit = a.id_penyakit
                    JOIN gejala g ON g.id_gejala = a.id_gejala
                    JOIN diagnosa d ON g.id_gejala = d.id_gejala
                    WHERE d.id_pasien = ? AND d.no_regdiagnosa = ?
                    ORDER BY p.id_penyakit
                ");
                if (!$stmt) {
                    die("Prepare failed: " . $conn->error);
                }
                $stmt->bind_param("is", $id_pasien, $no_regdiagnosa);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $i = 0;
                    while ($r = $result->fetch_assoc()) {
                        $nilai_cf = $r['cf_pakar'] * $r['nilai_pasien'];
                        $i++;
                        echo "
                        <tr>
                            <td>$i</td>
                            <td>{$r['nama_penyakit']}</td>
                            <td>{$r['nama_gejala']}</td>
                            <td>{$r['cf_pakar']}</td>
                            <td>{$r['nilai_pasien']}</td>
                            <td>$nilai_cf</td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found.</td></tr>";
                }
                $stmt->close();
            } else {
                echo "<tr><td colspan='6'>No registration diagnosis number provided.</td></tr>";
            }
            ?>
        </table>
    </div>
    <br><br>

    <div class="container">
        <h2>DETAIL PERHITUNGAN</h2>
        <h6>
            <?php
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
                        echo "<div>CFcombine = " . $cf1 . " + " . $cf2 . " x (1-" . $cf1 . ") = " . $cfcombine . " <br></div>";
                    }
                }
                if ($cf_lama > 0) {
                    $percentage = $cf_lama * 100;
                    echo "<p><b>Persentase combine pada penyakit (" . $a['nama_penyakit'] . ") : " . number_format($percentage, 2) . "%</b></p>";
                    if ($percentage > $highestPercentage) {
                        $highestPercentage = $percentage;
                        $penyakiTerbesar = $a['nama_penyakit'];
                    }
                }
                $stmt1->close();
            }
            echo "<b> Nilai Terbesar " . number_format($highestPercentage, 2) . "%<br></b>";
            echo "<b> Penyakit dengan nilai terbesar : " . $penyakiTerbesar . "<br></b>";
            ?>
        </h6>
        <br>
        <br>
    </div>
    <br>
    <br>
    <div class="container">
        <h3>Kesimpulan</h3>
        <br>
        <h4>
            <?php
            echo "
            <div>
            Berdasarkan hasil dari perhitungan metode <b>Certainty Factor</b>, dapat disimpulkan bahwa
            anda kemungkinan besar menderita penyakit <span><b>$penyakiTerbesar</b></span> dengan tingkat keyakinan 
            <span><b>" . number_format($highestPercentage, 2) . "%.</b></span>
            </div>
            ";
            ?>
        </h4>
    </div>
    <br>
    <br>
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
    <br>
    <br>
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
        <p> Note : Untuk pengobatan lebih lanjut silahkan bertemu psikolog, psikiater, atau konselor yang berpengalaman, untuk dukungan berkelanjutan dan penyesuaian strategi penanganan</p>
    </div>
    <br>

    <form action="diagnosa.php?aksi=simpan" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_pasien" value="<?php echo $id_pasien; ?>">
    <input type="hidden" name="no_regdiagnosa" value="<?php echo htmlspecialchars($no_regdiagnosa); ?>">
    <input type="hidden" name="penyakit_cf" value="<?php echo htmlspecialchars($penyakiTerbesar); ?>">
    <input type="hidden" name="nilai_cf" value="<?php echo htmlspecialchars($highestPercentage); ?>">


    <div>
    <a href="diagnosa.php">Diagnosa Ulang</a>
    <input type="submit" value="Simpan Diagnosa" class="btn btn-primary">
    </div>
    </form>

    <?php }?>
</section>
</body>
<?php require "footer.php"; ?>
</html>

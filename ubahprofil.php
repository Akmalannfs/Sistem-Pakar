<?php
session_start();
include 'db.php';

if (!isset($_SESSION["pasien"]) || empty($_SESSION["pasien"])) {
    echo "<script>alert('Silahkan Login Terlebih Dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

$id_pasien = $_SESSION['pasien']['id_pasien'];
$pas = mysqli_query($conn, "SELECT * FROM pasien WHERE id_pasien='$id_pasien'");
if ($pas) {
    $p = mysqli_fetch_assoc($pas);
} else {
    echo "Error: " . mysqli_error($conn);
    exit();
}

if (isset($_POST["update"])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $umur = $_POST['umur'];
    $telp = $_POST['telp'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Debug echo

    $query = "UPDATE pasien SET 
        nama_pasien='$nama', 
        email_pasien='$email', 
        jenis_kelamin='$jeniskelamin', 
        umur_pasien='$umur', 
        telp_pasien='$telp', 
        username_pasien='$username', 
        password_pasien='$password' 
        WHERE id_pasien='$id_pasien'";

    if ($conn->query($query)) {
        // Update session data
        $_SESSION['pasien']['nama_pasien'] = $nama;
        $_SESSION['pasien']['email_pasien'] = $email;
        $_SESSION['pasien']['jenis_kelamin'] = $jeniskelamin;
        $_SESSION['pasien']['umur_pasien'] = $umur;
        $_SESSION['pasien']['telp_pasien'] = $telp;
        $_SESSION['pasien']['username_pasien'] = $username;
        $_SESSION['pasien']['password_pasien'] = $password;

        echo "<script>alert('Profil berhasil diubah');</script>";
        echo "<script>location='user.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah profil');</script>";
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="gambar/remaja.png" rel="icon" type="image/png">
    <title>Ubah Profil</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500;700&display=swap" rel="stylesheet">

    <!-- icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- css -->
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="registrasi">
            <form action="" method="POST">
                <h1>Ubah Profil</h1>
                <hr>
                <input type="text" name="nama" placeholder="Nama Lengkap" value="<?php echo htmlspecialchars($p['nama_pasien']); ?>" required>
                <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($p['email_pasien']); ?>" required>
                <select class="form-control" name="jeniskelamin">
                    <option disabled>Jenis Kelamin</option>
                    <option value="Laki-laki" <?php if ($p['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if ($p['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
                <input type="number" name="umur" placeholder="Umur" value="<?php echo htmlspecialchars($p['umur_pasien']); ?>" required>
                <input type="number" name="telp" placeholder="Nomor Telepon" value="<?php echo htmlspecialchars($p['telp_pasien']); ?>" required>
                <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($p['username_pasien']); ?>" required>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($p['password_pasien']); ?>" required>
                    <i class="far fa-eye" id="togglePassword"></i>
                </div>
                <button type="submit" name="update">Update</button>
            </form>
            <script>
                const togglePassword = document.getElementById('togglePassword');
                const passwordInput = document.getElementById('password');
                togglePassword.addEventListener('click', function () {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                });
            </script>
        </div>
    </div>
</body>
</html>

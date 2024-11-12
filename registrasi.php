<?php
session_start();

include 'db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="gambar/remaja.png" rel="icon" type="image/png">
    <title>Registrasi</title>

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
            <form action="" method=POST>
            <h1>Registrasi</h1>
            <hr>
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <select class="form-control" name="jeniskelamin" required>
            <option selected disabled>Jenis Kelamin</option>
            <option>Laki-laki</option>
            <option>Perempuan</option>
            </select>
            <input type="number" name="umur" placeholder="Umur" required>
            <input type="number" name="telp" placeholder="Nomor Telepon" required>
            <input type="text" name="username" placeholder="Username" required>
            <div class="input-group">
            <input type="password" id="password" name="password" placeholder="password">
            <i class="far fa-eye" id="togglePassword"></i>
            </div>
            
            <button type="submit" name="daftar">Daftar</button>
            <p>Sudah punya akun?
                <a href="login.php">Login</a>
            </p>
            </form>

            <script>
                const togglePassword = document.getElementById('togglePassword');
                const passwordInput = document.getElementById('password');

                togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
             });
            </script>
            <?php
            if (isset($_POST["daftar"])) 
            {
                //mengambil input form
                $nama = $_POST['nama'];
                $email = $_POST['email'];
                $jeniskelamin = $_POST['jeniskelamin'];
                $umur = $_POST['umur'];
				$telp = $_POST['telp'];
				$username = $_POST['username'];
				$pass = $_POST['pass'];

                //cek apakah email sudah digunakan
                $ambil = $conn->query("SELECT * FROM pasien WHERE email_pasien='$email'");
                $emailcocok = $ambil->num_rows;
                if ($emailcocok==1) 
                {
                   echo "<script>alert('Pendaftaran gagal, email sudah digunakan');</script>";
                   echo "<script>location='registrasi.php';</script>";
                }
                else
                {
                    //insert ke database
                    $conn->query("INSERT INTO pasien (nama_pasien, email_pasien, jenis_kelamin, umur_pasien, telp_pasien, username_pasien, password_pasien) 
                    VALUES ('$nama', '$email', '$jeniskelamin',  '$umur', '$telp', '$username', '$pass' ) ");

                    echo "<script>alert('Pendaftaran berhasil');</script>";
                    echo "<script>location='login.php';</script>";
                }
            }
            ?>
        </div>
    </div>

    <?php
    //jika tombol login dilik
    if (isset($_POST['submit']))
    {

        $username = $_POST["username"];
        $pass = $_POST["pass"];
        //lakukan pengecekan akun
        $ambil = $conn->query("SELECT * FROM pasien WHERE username_pasien='$email' AND password_pasien='$pass'");

        //menghitung akun yang terambil
        $akuncocok = $ambil->num_rows;

        //jika cocok, berhasil login
        if ($akuncocok==1){
            //anda berhasil login
            // mendapatkan akun dalam bentuk array
            $akun = $ambil->fetch_assoc();
            //simpan di session pasien
            $_SESSION["pasien"] = $akun;
            echo "<script>alert('Behasil Login')</script>";
            echo "<script>location='diagnosa.php';</script>";
        }
        else{
            //anda gagal login
            echo "<script>alert('Email atau Password salah')</script>";
            echo "<script>location='login.php';</script>";
        }
    }
    ?>
</body>
</html>
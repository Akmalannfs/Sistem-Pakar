<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="gambar/remaja.png" rel="icon" type="image/png">
    <title>Sistem Pakar</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- CSS -->
    <link href="css/style.css" rel="stylesheet" />
    <style>
       @media (max-width: 768px) {
        nav.active ul {
    display: block;
    position: fixed;
    top: 0;
    right: 0;
    width: 50%;
    height: 100%;
    background-color: rgba(240, 248, 254); /* Latar belakang semi-transparan */
    z-index: 90; /* Z-index di bawah hamburger menu */
    padding: 20px;
    text-align: center; /* Center align text */
    padding-top: 50px; /* Tambahkan padding agar tidak menempel ke atas */
}

    nav ul li {
        margin: 20px 0;
        position: relative; /* Pastikan dropdown terikat pada item li */
    }

    nav.active ul {
        display: flex;
        right: 0; /* Menu muncul dari kanan */
    }
    .navbar-extra {
  display: block;
}

    /* Style untuk Dropdown pada mode responsive */


    nav ul li .dropdown a {
        padding: 10px 0;
        color: #272343;
    }

    /* Tampilkan dropdown di bawah item */
    nav ul li.active .dropdown {
        display: block;
    }
    
    nav ul li .dropdown {
        position: absolute;
        top: auto;
        right: auto;
        opacity: 0;
        max-height: 0;
        transition: all 0.5s ease;
    }

    nav ul li.active .dropdown {
        opacity: 1;
        max-height: 200px;
    }

    #hamburger-menu {
    position: fixed; /* Supaya selalu tetap di pojok kanan atas */
    top: 20px;
    right: 20px;
    z-index: 100; /* Pastikan ikon selalu di atas menu */
    cursor: pointer;
    }   

    #hamburger-menu i {
    stroke: #f40808;
    width: 32px;
    height: 32px;
    transition: all 0.3s ease;
    }
}
    </style>
</head>
<body>

    <!-- Navbar start -->
    <div class="hero">
        <nav>
            <a href="user.php" class="navbar-logo">Sistem Pakar</a>
            <ul>
                <li><a href="user.php">Beranda</a></li>
                <li><a href="diagnosa.php">Diagnosa</a></li>
                <li><a href="history.php">Riwayat</a></li>
                <li>
                    <a href=""><i class="fas fa-user"></i></a>
                    <div class="dropdown">
                        <?php if (isset($_SESSION["pasien"])): ?>
                        <a href="ubahprofil.php">Ubah Profil</a>
                        <a href="logout.php">Keluar</a>
                        <?php else: ?>
                        <a href="Login.php">Masuk</a>
                        <a href="registrasi.php">Daftar</a>
                        <?php endif ?>
                    </div>
                </li>
            </ul>
            <div class="navbar-extra">
                <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
            </div>
        </nav>
    </div>

    <!-- Feather Icons -->
    <script>
        feather.replace()
    </script>

    <!-- Javascript -->
    <script>
        const hamburger = document.querySelector('#hamburger-menu');
const nav = document.querySelector('nav');
const dropdownTriggers = document.querySelectorAll('nav ul li a');

hamburger.addEventListener('click', function() {
    nav.classList.toggle('active');
});

// Menangani dropdown di mode mobile
dropdownTriggers.forEach(trigger => {
    trigger.addEventListener('click', function(e) {
        // Cek apakah menu dropdown ada di dalam item yang diklik
        const dropdown = this.nextElementSibling;
        if (dropdown && dropdown.classList.contains('dropdown')) {
            e.preventDefault(); // Mencegah navigasi
            dropdown.parentElement.classList.toggle('active'); // Toggle aktif dropdown
        }
    });
});

document.addEventListener('click', function(e) {
    const isClickInside = nav.contains(e.target) || hamburger.contains(e.target);
    if (!isClickInside) {
        nav.classList.remove('active'); // Hapus kelas 'active' jika klik di luar menu
    }
});
trigger.addEventListener('click', function(e) {
    const isClickInside = nav.contains(e.target) || dropdown.classList.contains(e.target);
    if (!isClickInside) {
        dropdown.parentElement.classList.remove('active'); // Hapus kelas 'active' jika klik di luar menu
    }
});
    </script>

    <!-- Script.js -->
    <script src="js/script.js"></script>

</body>
</html>

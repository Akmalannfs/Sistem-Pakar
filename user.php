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
    <title>Sistem Pakar</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500;700&display=swap" rel="stylesheet">

    <!-- icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- css -->
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>

<!-- navbar start -->

<?php require "navbar.php"; ?>

<div class="konten">
    <div class="banner">
        <h1>Sistem Pakar <br><span>Kesehatan Mental Remaja</span></h1>
        <p>Jaga Kesehatan Mental Kamu Sekarang!</p>
        <a href="diagnosa.php">Diagnosa Sekarang</a>
    </div>
    <div class="images">
        <img src="gambar/banner.png" class="remaja">
    </div>
</div>

 <?php require "berita.php"; ?>

 <section id="about" class="about">
    <h2>Sistem Pakar</h2>

    <div class="row">
        <div class="about-img">
            <img src="gambar/sistempakar.jpeg" alt="Tentang Kami">
        </div>
        <div class="content">
            <p>Sistem Pakar merupakan salah satu bidang dari Kecerdasan Buatan (Artificial Intelligence). Kecerdasan Buatan (Artificial Intelligence atau AI) adalah cabang ilmu komputer yang berfokus pada pembuatan sistem atau mesin yang dapat melakukan tugas-tugas yang biasanya membutuhkan kecerdasan manusia. AI mencakup berbagai teknik dan teknologi yang memungkinkan mesin untuk belajar, beradaptasi, dan melakukan tugas secara otomatis. Sistem pakar adalah sebuah sistem komputer yang dirancang untuk meniru kemampuan pengambilan keputusan dari seorang pakar manusia dalam suatu bidang tertentu. Sistem ini menggunakan basis pengetahuan yang berisi fakta dan aturan-aturan yang relevan dengan bidang tersebut, serta mekanisme inferensi untuk menganalisis informasi dan memberikan rekomendasi atau keputusan yang informatif.</p>
        </div>
    </div>

    <h2>Kesehatan Mental Remaja</h2>
    <div class="row">
    <div class="vm-img">
            <img src="gambar/kesehatanmental.jpeg" alt="Visi & Misi">
        </div>
        <div class="visi">
           <p>Kesehatan mental remaja merujuk pada kondisi emosional, psikologis, dan sosial yang mempengaruhi cara seorang remaja berpikir, merasa, dan berperilaku. Ini mencakup kemampuan remaja untuk mengatasi tekanan, berinteraksi dengan orang lain, dan membuat keputusan yang sehat. Kesehatan mental yang baik selama masa remaja sangat penting karena masa ini adalah periode perkembangan yang kritis di mana individu mengalami perubahan fisik, emosional, dan sosial yang signifikan. Menurut WHO (World Health Organization) batasan usia remaja adalah 12 sampai 24 tahun dan menurut Badan Kependudukan dan Keluarga Berencana Nasional (BKKBN) batasan usia remaja adalah 10 sampai 24 tahun dan belum menikah.</p>
        </div>
    </div>
</section>
<script src="js/script.js"></script>
</body>
<?php require "footer.php"; ?>
</html>
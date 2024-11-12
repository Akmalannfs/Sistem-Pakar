<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        .carousel-container {
            width: 100%;
            overflow: hidden;
            position: relative;
            margin-bottom: 3%;
        }
        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-item {
            display: flex;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            width: 50%;
            min-width: 50%;
            box-sizing: border-box;
            margin-right: 20px; /* Spasi antar item */
        }
        .carousel-item img {
            width: 150px;
            height: auto;
        }
        .content {
            padding: 15px;
            flex: 1;
        }
        .content h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #333;
        }
        .content p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }
        .carousel-button {
            width: 3%;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 3px;
            cursor: pointer;
            border-radius: 3px;
            z-index: 1;
        }
        .carousel-button.left {
            left: 10px;
        }
        .carousel-button.right {
            right: 10px;
        }
        .hidden {
            display: none;
        }
        @media (max-width: 768px) {
    .carousel-item {
        flex-wrap: wrap;
        justify-content: center;
    }

    .carousel-item {
        width: 100%;
    }

    .carousel-item img {
        width: 100%;
        height: auto;
    }
}

    </style>
</head>
<body>
    <div class="carousel-container">
        <button class="carousel-button left hidden" onclick="moveCarousel(-1)">&#10094;</button>
        <div class="carousel-track">
            <div class="carousel-item">
                <img src="gambar/berita1.jpg" alt="Kesehatan Mental Remaja 1">
                <div class="content">
                    <h3>Krisis Kesehatan Mental Menghantui Generasi Z Indonesia</h3>
                    <p>Riset Kesehatan Dasar (Riskesdas) oleh Kementerian Kesehatan tahun 2018 menunjukkan prevalensi rumah tangga dengan anggota menderita gangguan jiwa skizofrenia meningkat dari 1,7 permil pada 2013 menjadi 7 permil di tahun 2018.</p>
                    <a href="https://rsj.acehprov.go.id/berita/kategori/artikel/krisis-kesehatan-mental-menghantui-generasi-z-indonesia">Lihat Selengkapnya</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="gambar/berita2.jpg" alt="Kesehatan Mental Remaja 2">
                <div class="content">
                    <h3>17 Juta Remaja Indonesia Memiliki Masalah Mental, Ternyata Ini Penyebabnya</h3>
                    <p>Sebanyak 17 juta remaja di Indonesia rentan usia 10-17 tahun memiliki masalah kesehatan mental. Hal itu diketahui berdasarkan survei Kesehatan Jiwa Remaja Nasional (I-NAMHS).</p>
                        <a href="https://www.detik.com/sumut/berita/d-7151847/17-juta-remaja-indonesia-memiliki-masalah-mental-ternyata-ini-penyebabnya">Lihat Selengkapnya</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="gambar/berita3.jpg" alt="Kesehatan Mental Remaja 3">
                <div class="content">
                    <h3>5 Fakta Masalah Kesehatan Mental Remaja, Orangtua Wajib Tahu</h3>
                    <p>Perubahan fisik, emosional dan sosial, termasuk kemiskinan, pelecehan, atau kekerasan membuat kondisi mental mereka lebih rentan. Pengalaman menghadapi kesulitan hidup, tekanan untuk menyesuaikan diri dengan teman sebaya, eksplorasi identitas, juga pengaruh media juga menjadi faktor yang berpengaruh.</p>
                    <a href="https://lifestyle.kompas.com/read/2023/03/15/141854420/5-fakta-masalah-kesehatan-mental-remaja-orangtua-wajib-tahu">Lihat Selengkapnya</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="gambar/berita4.jpg" alt="Kesehatan Mental Remaja 4">
                <div class="content">
                    <h3>Hasil Survei I-NAMHS: Satu dari Tiga Remaja Indonesia Memiliki Masalah Kesehatan Mental</h3>
                    <p>Indonesia National Adolescent Mental Health Survey (I-NAMHS), survei kesehatan mental nasional pertama yang mengukur angka kejadian gangguan mental pada remaja 10 – 17 tahun di Indonesia, menunjukkan bahwa satu dari tiga remaja Indonesia memiliki masalah kesehatan mental sementara satu dari dua puluh remaja Indonesia memiliki gangguan mental dalam 12 bulan terakhir. </p>
                        <a href="https://ugm.ac.id/id/berita/23086-hasil-survei-i-namhs-satu-dari-tiga-remaja-indonesia-memiliki-masalah-kesehatan-mental/">Lihat Selengkapnya</a>
                </div>
            </div>
            <!-- Tambahkan lebih banyak carousel-item di sini -->
        </div>
        <button class="carousel-button right" onclick="moveCarousel(1)">&#10095;</button>
    </div>

    <script>
        let currentIndex = 0;
        
        function moveCarousel(direction) {
            const track = document.querySelector('.carousel-track');
            const items = document.querySelectorAll('.carousel-item');
            const totalItems = items.length;
            const itemWidth = items[0].getBoundingClientRect().width;
            
            currentIndex += direction;
            
            if (currentIndex < 0) {
                currentIndex = 0;
            } else if (currentIndex >= totalItems - 1) {
                currentIndex = totalItems - 1;
            }
            
            const newTransform = -currentIndex * (itemWidth + 20); // 20 adalah margin-right antar item
            track.style.transform = `translateX(${newTransform}px)`;
            
            updateButtons();
        }
        
        function updateButtons() {
            const leftButton = document.querySelector('.carousel-button.left');
            const rightButton = document.querySelector('.carousel-button.right');
            const items = document.querySelectorAll('.carousel-item');
            const totalItems = items.length;
            
            if (currentIndex === 0) {
                leftButton.classList.add('hidden');
            } else {
                leftButton.classList.remove('hidden');
            }
            
            if (currentIndex >= totalItems - 1) {
                rightButton.classList.add('hidden');
            } else {
                rightButton.classList.remove('hidden');
            }
        }

        // Initial setup
        updateButtons();
    </script>
</body>
</html>

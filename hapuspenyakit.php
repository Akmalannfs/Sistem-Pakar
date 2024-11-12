<?php

$ambil = $conn->query("SELECT * FROM penyakit WHERE penyakit='$_GET[id]'" );

$conn->query("DELETE FROM penyakit WHERE id_penyakit='$_GET[id]'");

echo "<script>location='index.php?halaman=penyakit';</script>";
?>
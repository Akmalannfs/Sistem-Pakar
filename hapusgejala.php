<?php

$ambil = $conn->query("SELECT * FROM gejala WHERE id_gejala='$_GET[id]'" );

$conn->query("DELETE FROM gejala WHERE id_gejala='$_GET[id]'");

echo "<script>location='index.php?halaman=gejala';</script>";
?>
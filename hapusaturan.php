<?php

$ambil = $conn->query("SELECT * FROM aturan WHERE id_aturan='$_GET[id]'" );

$conn->query("DELETE FROM aturan WHERE id_aturan='$_GET[id]'");

echo "<script>location='index.php?halaman=aturan';</script>";
?>
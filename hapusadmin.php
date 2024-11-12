<?php

$ambil = $conn->query("SELECT * FROM admin WHERE id_admin='$_GET[id]'" );

$conn->query("DELETE FROM admin WHERE id_admin='$_GET[id]'");

echo "<script>location='index.php?halaman=admin';</script>";
?>
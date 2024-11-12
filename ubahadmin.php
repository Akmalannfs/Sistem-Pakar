<h2>Edit Data Admin</h2>

<?php
$ambil = $conn->query("SELECT * FROM admin WHERE id_admin='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Admin</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_admin']; ?>">
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $pecah['username']; ?>">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control" name="password" value="<?php echo $pecah['password']; ?>">
    </div>
    <button class="btn-primary btn" name="ubah">Edit</button>
</form>
<?php
if (isset($_POST['ubah']))

{
        $conn->query("UPDATE admin SET nama_admin='$_POST[nama]',
        username='$_POST[username]',
        password='$_POST[password]' 
        WHERE id_admin='$_GET[id]'");

    echo "<script>alert('Data Admin Telah Diubah');</script>";
    echo "<script>location='index.php?halaman=admin';</script>";
    }
?>
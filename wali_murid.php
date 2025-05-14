<?php
include 'koneksi.php';

$sql = "SELECT * FROM wali_murid";
$result = mysqli_query($koneksi, $sql);

?>

<html>
    <head>
        <title>Kelola Wali Murid</title>
        <link rel="stylesheet" href="style.css">
    </head>

<body>
    <a href="index.php">Kembali ke data siswa</a>
    <a href="kelas.php">Kelola Kelas</a>
    <a href="wali_murid.php">Kelola Wali Murid</a>
    <a href="tambah_siswa.php">Tambah Siswa</a>

    <table border="1" cellspacing= "0" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Nama Wali</th>
            <th>kontak</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while ($data = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data['nama_wali'] ?></td>
            <td><?= $data['kontak'] ?></td>
            <td>
                <a href="editwali.php?id=<?php echo $data['id_wali'];?>">Edit</a>
                <a href="#">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
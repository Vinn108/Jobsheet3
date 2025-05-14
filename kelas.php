<?php
include 'koneksi.php';

$query = "SELECT * FROM kelas ";
$result = mysqli_query($koneksi, $query);
?>

<html>
<head>
    <title>Data Kelas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="tambah_siswa.php">Tambah Kelas</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID Kelas</th>
                <th>Nama Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($data = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $data['id_kelas']; ?></td>
                <td><?php echo $data['nama_kelas']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $data['id_kelas']; ?>">Edit</a>
                    <a href="#">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="index.php">Kembali Ke Halaman Utama</a>
</body>
</html>

<?php
include 'koneksi.php';

$sql = "SELECT siswa.*, kelas.nama_kelas, wali_murid.nama_wali 
        FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
        JOIN wali_murid ON siswa.id_wali = wali_murid.id_wali";
$result = mysqli_query($koneksi, $sql);

?>

<html>
    <head>
        <title>Data Siswa</title>
        <link rel="stylesheet" href="style.css">
    </head>

<body>
    <a href="kelas.php">Kelola Kelas</a>
    <a href="wali_murid.php">Kelola Wali Murid</a>
    <a href="tambah_siswa.php">Tambah Siswa</a>

    <table border="1" cellspacing= "0" cellpadding="5">
        <tr>
            <th>NIS</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Kelas</th>
            <th>Orang Tua</th>
            <th>Aksi</th>
        </tr>
        <?php while ($data = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $data['nis'] ?></td>
            <td><?= $data['nama_siswa'] ?></td>
            <td><?= $data['jenis_kelamin'] ?></td>
            <td><?= $data['tempat_lahir'] ?></td>
            <td><?= $data['tanggal_lahir'] ?></td>
            <td><?= $data['nama_kelas'] ?></td>
            <td><?= $data['nama_wali'] ?></td>
            <td>
                <a href="edit_siswa.php?id=<?= $data['id_siswa'] ?>">Edit</a>
                <a href="hapus.php?nis=<?= $data['nis'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
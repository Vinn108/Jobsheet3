<?php
include 'koneksi.php';

// Pastikan ID kelas tersedia dan valid
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID kelas tidak ditemukan atau tidak valid!";
    exit();
}

$id_kelas = intval($_GET['id']); // Konversi ke integer untuk keamanan

// Ambil data kelas berdasarkan ID
$query = "SELECT * FROM kelas WHERE id_kelas = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_kelas);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Data kelas tidak ditemukan!";
    exit();
}

$kelas = $result->fetch_assoc();
$stmt->close();

// Proses update data kelas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kelas = trim($_POST['nama_kelas']);
    
    // Validasi input
    if (empty($nama_kelas)) {
        echo "Nama kelas tidak boleh kosong!";
    } elseif (strlen($nama_kelas) > 50) { // Sesuaikan batas panjang sesuai database
        echo "Nama kelas terlalu panjang! Maksimal 50 karakter.";
    } else {
        // Gunakan prepared statement untuk update
        $query_update = "UPDATE kelas SET nama_kelas=? WHERE id_kelas=?";
        $stmt = $koneksi->prepare($query_update);
        $stmt->bind_param("si", $nama_kelas, $id_kelas);

        if ($stmt->execute()) {
            header("Location: kelas.php"); // Redirect ke halaman kelas setelah update
            exit();
        } else {
            echo "Error saat mengupdate data: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Kelas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Data Kelas</h2>
    <form method="POST">
        <label>Nama Kelas</label>
        <input type="text" name="nama_kelas" value="<?php echo htmlspecialchars($kelas['nama_kelas']); ?>" maxlength="50" required>
        <button type="submit">Update</button>
        <a href="kelas.php">Batal</a>
    </form>
</body>
</html>

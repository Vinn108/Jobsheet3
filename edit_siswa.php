<?php
include 'koneksi.php';

if(isset($_GET['id'])) {
    $id_siswa = $_GET['id'];
    $query = "SELECT siswa.*, kelas.id_kelas, wali_murid.id_wali 
              FROM siswa 
              JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
              JOIN wali_murid ON siswa.id_wali = wali_murid.id_wali 
              WHERE siswa.id_siswa = $id_siswa";
    $result = mysqli_query($koneksi, $query);
    $siswa = mysqli_fetch_assoc($result);

    $kelas_query = "SELECT * FROM kelas";
    $kelas_result = mysqli_query($koneksi, $kelas_query);

    $wali_query = "SELECT * FROM wali_murid";
    $wali_result = mysqli_query($koneksi, $wali_query);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_siswa = $_POST['id_siswa'];
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_kelas = $_POST['id_kelas'];
    $id_wali = $_POST['id_wali'];

    $query_update = "UPDATE siswa SET 
                    nis = '$nis',
                    nama_siswa = '$nama_siswa', 
                    jenis_kelamin = '$jenis_kelamin', 
                    tempat_lahir = '$tempat_lahir', 
                    tanggal_lahir = '$tanggal_lahir', 
                    id_kelas = $id_kelas, 
                    id_wali = $id_wali 
                    WHERE id_siswa = $id_siswa";

    if(mysqli_query($koneksi, $query_update)){
        header("Location: index.php");
        exit();
    }else{
        echo "Error: " . mysqli_error($koneksi);
    }    
}
?>

<html>
<head>
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Data Siswa</h2>
    <form method="POST">
        <input type="hidden" name="id_siswa" value="<?php echo $siswa['id_siswa']; ?>">
        
        <label>NIS:</label>
        <input type="text" name="nis" value="<?php echo $siswa['nis']; ?>" required><br>
        
        <label>Nama Siswa:</label>
        <input type="text" name="nama_siswa" value="<?php echo $siswa['nama_siswa']; ?>" required><br>
        
        <label>Jenis Kelamin:</label>
        <select name="jenis_kelamin" required>
            <option value="L" <?php if($siswa['jenis_kelamin'] == 'L') echo 'selected'; ?>>Laki-laki</option>
            <option value="P" <?php if($siswa['jenis_kelamin'] == 'P') echo 'selected'; ?>>Perempuan</option>
        </select><br>
        
        <label>Tempat Lahir:</label>
        <input type="text" name="tempat_lahir" value="<?php echo $siswa['tempat_lahir']; ?>" required><br>
        
        <label>Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" value="<?php echo $siswa['tanggal_lahir']; ?>" required><br>
        
        <label>Kelas:</label>
        <select name="id_kelas" required>
            <?php 
            $kelas_result = mysqli_query($koneksi, "SELECT * FROM kelas");
            while($kelas = mysqli_fetch_assoc($kelas_result)): ?>
                <option value="<?php echo $kelas['id_kelas']; ?>" 
                    <?php if($kelas['id_kelas'] == $siswa['id_kelas']) echo 'selected'; ?>>
                    <?php echo $kelas['nama_kelas']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>
        
        <label>Wali Murid:</label>
        <select name="id_wali" required>
            <?php 
            $wali_result = mysqli_query($koneksi, "SELECT * FROM wali_murid");
            while($wali = mysqli_fetch_assoc($wali_result)): ?>
                <option value="<?php echo $wali['id_wali']; ?>" 
                    <?php if($wali['id_wali'] == $siswa['id_wali']) echo 'selected'; ?>>
                    <?php echo $wali['nama_wali']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>
        
        <button type="submit">Update</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>
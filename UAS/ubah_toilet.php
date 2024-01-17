<?php
// Koneksi database
include 'koneksi.php';

// Ambil data yang akan diedit
$id = $_GET['id'];
$sql = "SELECT * FROM toilet WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Simpan hasil edit
if(isset($_POST['submit'])) {
  $id = $_POST['id'];
  $lokasi = $_POST['lokasi'];
  $keterangan = $_POST['keterangan'];

  $sql = "UPDATE toilet SET lokasi='$lokasi', keterangan='$keterangan' WHERE id=$id";
  mysqli_query($conn, $sql);

  header('location: ind_toilet.php');
  exit; // Pastikan untuk keluar setelah menggunakan header
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UAS Pem. Web 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body style="margin-top: 30px; background-color: #0A2647;">
    <div class="container" style="background-color: #000FFF; width: 50%; padding: 30px;">
        <h1 style="color: #FFFFFF; text-align: center;">Ubah Data Toilet</h1>
        <form method="post"> <!-- Tambahkan tag form dan atribut method -->
            <div class="input">
                <label style="color: #FFFFFF;">Lokasi</label>
                <select class="form-select" aria-label="Default select example" name="lokasi">
                    <option value="Office" <?php echo ($row['lokasi'] == 'Office') ? 'selected' : ''; ?>>Office</option>
                    <option value="Factory 1" <?php echo ($row['lokasi'] == 'Factory 1') ? 'selected' : ''; ?>>Factory 1</option>
                    <option value="Factory 2" <?php echo ($row['lokasi'] == 'Factory 2') ? 'selected' : ''; ?>>Factory 2</option>
                    <option value="Security" <?php echo ($row['lokasi'] == 'Security') ? 'selected' : ''; ?>>Security</option>
                </select>
            </div>
            <div class="input">
                <label style="color: #FFFFFF;">Keterangan</label>
                <select class="form-select" aria-label="Default select example" name="keterangan">
                    <option value="Sudah" <?php echo ($row['keterangan'] == 'Sudah') ? 'selected' : ''; ?>>Sudah</option>
                    <option value="Belum" <?php echo ($row['keterangan'] == 'Belum') ? 'selected' : ''; ?>>Belum</option>
                    <option value="Rusak" <?php echo ($row['keterangan'] == 'Rusak') ? 'selected' : ''; ?>>Rusak</option>
                </select>
            </div> <br>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <!-- Tambahkan input hidden untuk menyimpan nilai id -->
            <input class="btn" style="background-color: #07940e; color: #FFFFFF;" type="submit" name="submit" value="Simpan">
        </form>
    </div>
</body>
</html>


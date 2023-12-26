# Project_UAS

|| KELOMPOK 2 |
| --- | --- |

| NAMA  | NIM |
| --- | --- |
| MUHAMMAD ZIDAN FADILLAH   | 312210277 |
| MUHAMMAD VERDY HASAN ALHAFIZ  | 312210214 |
|  SAHRUL RIDWANSYAH   | 312210063 |
| KELAS :| TI.22.A2 |
| DOSEN :| Agung Nugroho,S.Kom.,M.Kom |

<Hr>

# Tugas Project Ujian Akhir Semester

**Membuat  Checklist Kebersihan Toilet**<br>

|username :| admin  |
| --- | --- |
|password : | admin |

|| HASIL  |
| --- | --- |
|link Web HOSTING DEMO : |  |
|link youtube : |  |
| link drive pdf laporan : | https://drive.google.com/file/d/1DRwqcRCSN1mO3nH0eWp6lGLAwVG43ZH2/view?usp=drivesdk |

Pertama kita membuat database dahulu 


# 1. DATABASE dbchekclist

- Table user

```
CREATE TABLE IF NOT EXISTS `db_checklist`.`users` (
`id` INT NOT NULL AUTO_INCREMENT,
`username` VARCHAR(100) NULL,
`password` VARCHAR(100) NULL,
`nama` VARCHAR(200) NULL,
`email` VARCHAR(200) NULL,
`status` TINYINT(1) NULL,
`role` TINYINT(1) NULL DEFAULT 2 COMMENT '1:Admin\n2:User',
PRIMARY KEY (`id`),
UNIQUE INDEX `username_UNIQUE` (`username` ASC),
UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
```

- Table toilet

```
CREATE TABLE IF NOT EXISTS `mydb`.`toilet` (
`id` INT NOT NULL AUTO_INCREMENT,
`lokasi` VARCHAR(45) NULL,
`keterangan` VARCHAR(45) NULL,
PRIMARY KEY (`id`))
ENGINE = InnoDB
```
- Table  checklist

```
CREATE TABLE IF NOT EXISTS `mydb`.`checklist` (
`id` INT NOT NULL AUTO_INCREMENT,
`tanggal` DATETIME NULL,
`toilet_id` INT NOT NULL,
`kloset` TINYINT(1) NULL,
`wastafel` TINYINT(1) NULL,
`lantai` TINYINT(1) NULL,
`dinding` TINYINT(1) NULL,
`kaca` TINYINT(1) NULL,
`bau` TINYINT(1) NULL,
`sabun` TINYINT(1) NULL,
`users_id` INT NOT NULL,
PRIMARY KEY (`id`),
INDEX `fk_checklist_toilet_idx` (`toilet_id` ASC),
INDEX `fk_checklist_users1_idx` (`users_id` ASC),
CONSTRAINT `fk_checklist_toilet`
FOREIGN KEY (`toilet_id`)
REFERENCES `mydb`.`toilet` (`id`)
ON DELETE NO ACTION
ON UPDATE NO ACTION,
CONSTRAINT `fk_checklist_users1`
FOREIGN KEY (`users_id`)
REFERENCES `mydb`.`users` (`id`)
ON DELETE NO ACTION
ON UPDATE NO ACTION)
ENGINE = InnoDB
```


# 2. TAMPILAN DAN ISI 

Kemudian untuk codingan tampilan dan isi database user itu sendiri 

- login_season

```
<?php

session_start();

if (!isset($_SESSION['isLogin']))
header('location: login.php');

?>
```

- Login.php

```
<?php
session_start();
$title ='Login';
include_once 'koneksi.php';

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE username = '{$username}' AND pass = '{$pass}'";

    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_affected_rows($conn) !=0){
        $_SESSION['login'] = true;
        $_SESSION['username'] = mysqli_fetch_array($result);

        header('location: home.php');
    }else
    $errorMsg = "<p style=\"color:red;\">Gagal Login,
    silakan ulangi lagi.</p>";
}
if (isset($errorMsg)) echo $errorMsg;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web Checklist Toilet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body style="margin-top: 30px; background-color: #8B008B;">
<div class="container" style=" background-color: #2F4F4F; width: 70%; padding: 20px;" >
<h1 style="color: #FFFFFF; text-align: center;">DATA CHECKLIST KEBERSIHAN TOILET</h1><br>
<h2 style="color: #FFFFFF; text-align: center;">LOGIN</h2><br>
    <form method="POST">
        <div class="mb-3 row" style="background-color: #3CB371;">
            <label for="staticEmail" class="col-sm-2 col-form-label" style="color: #FFFFFF;">Username</label>
            <div class="col-sm-10">
                <input style="color: #000000;" type="text" class="form-control" id="staticEmail" placeholder="Username" name="username">
            </div>
        </div>
        <br>
        <div class="mb-3 row " style="background-color: #3CB371;">
            <label for="inputPassword" class="col-sm-2 col-form-label" style="color: #FFFFFF;">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" placeholder="Password" accept=""name="pass">
            </div>
        </div>
        <br>
        <div class="submit">
            <button type="submit" name="submit" class="btn" style="background-color: #3CB371; color: #FFFFFF n ;">Login</button>
        </div>
        <div><br><br>
            <p style="color: #FF4500;">Belum memiliki akun??</p>
            <a href="tam_login.php" style="color: #FF4500;">Buat Akun Baru</a>
        </div>
    </form>
</div>
</body>
```

- Tam_login

```
<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit']))
{
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $stat = $_POST['stat'];
    $rol = $_POST['rol'];

    $sql = 'INSERT INTO users ( username, pass, nama, email, stat, rol)';
    $sql .= "VALUE ('$username', '$pass', '$nama', '$email', '$stat', '$rol')";
    $result = mysqli_query($conn, $sql);
    header('location: login.php');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body style="margin-top: 30px; background-color: #0A2647;">
    <div class="container" style= "background-color: #144272; width: 30%; ">
        <h1 style="color: #FFFFFF; text-align: center;">Tambah Akun</h1>
        <div class="main">
            <form method="post" action="tam_login.php" enctype="multipart/form-data">    
                <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Username</span>
                    <input type="text" name="username" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Password</span>
                    <input type="password" name="pass" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nama</span>
                    <input type="text" name="nama" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">E-mail</span>
                    <input type="text" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="">
                    <h6 style="color: #FFFFFF;">Status</h6>
                    <select class="form-select" aria-label="Default select example" name="stat">
                        <option value=""></option>
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Non Aktif</option>
                    </select>
                </div><br>
                <div class="">
                    <h6 style="color: #FFFFFF;">Role</h6>
                    <select class="form-select" aria-label="Default select example" name="rol">
                        <option value=""></option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div> <br>
                <input type="submit" name="submit" value="Simpan" class= "btn" style="background-color: #2C74B3; color: #FFFFFF;">
            </form>
        </div>
    </div>
</body>
</html>
```



- Koneksi.php

```
<?php 
$host = "localhost"; 
$user = "root"; 
$pass = "";
$db = "db_checklist"; 
$conn = mysqli_connect($host, $user, $pass, $db); 
?>
```

- index.php

```
<?php
include("koneksi.php");

$q = "";
if (isset($_GET['submit']) && !empty($_GET['q'])) {
    $q = $_GET['q'];
    $sql_where = "WHERE tanggal LIKE '%".$q."%' or toilet_id LIKE '%".$q."%' or kloset LIKE '%".$q."%' or wastafel LIKE '%".$q."%' or lantai LIKE '%".$q."%' or dinding LIKE '%".$q."%' or sabun LIKE '%".$q."%' or bau LIKE '%".$q."%' or users_id LIKE '%".$q."%'" ;


}
$title = 'Checklist Toilet';
$sql = 'SELECT * FROM checklist ';
if (isset($sql_where))
    $sql .= $sql_where;
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web Checklist Toilet</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body style="margin-top: 30px; background-color: #7eeef3;">
    <div class="container" style="background-color: #4b9b7f; width: 250%; padding: 10px;">
        <br><br>
        <div class="head">
        <h1 style="color: #7eeef3;">Checklist Toilet</h1>
        <form>
            <div class="form-group" action="index.php" method="get" >
                <label for="q" style="color: #FFFFFF;">Cari Data Toilet</label>
                <input type="text" placeholder="Masukkan Pencarian"  id="q" name="q" class="input-q" value="<?php echo $q ?>">
                <button type="submit" name="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
        </div>
        <div class="main">
            <table class="table table-striped table-hover">
            <tr>
                <th style="color: #7eeef3;">Tanggal</th>
                <th style="color: #7eeef3; width: 5%;">Kode Toilet</th>
                <th style="color: #7eeef3;">Kloset</th>
                <th style="color: #7eeef3;">Wastafel</th>
                <th style="color: #7eeef3;">Lantai</th>
                <th style="color: #7eeef3;">Dinding</th>
                <th style="color: #7eeef3;">Kaca</th>
                <th style="color: #7eeef3;">Bau</th>
                <th style="color: #7eeef3;">Sabun</th>
                <th style="color: #7eeef3;">Petugas</th>
                <th style="color: #7eeef3; width: 5%;">ID Barang</th>
                <th style="color: #7eeef3;">Aksi</th>
            </tr>
            <?php if($result): ?>
            <?php while($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td style="color: #7eeef3;"><?= $row['tanggal'];?></td>
                <td style="color: #7eeef3;"><?= $row['toilet_id'];?></td>
                <td style="color: #7eeef3;"><?= $row['kloset'];?></td>
                <td style="color: #7eeef3;"><?= $row['wastafel'];?></td>
                <td style="color: #7eeef3;"><?= $row['lantai'];?></td>
                <td style="color: #7eeef3;"><?= $row['dinding'];?></td>
                <td style="color: #7eeef3;"><?= $row['kaca'];?></td>
                <td style="color: #7eeef3;"><?= $row['bau'];?></td>
                <td style="color: #7eeef3;"><?= $row['sabun'];?></td>
                <td style="color: #7eeef3;"><?= $row['users_id'];?></td>
                <td style="color: #7eeef3;"><?= $row['id'];?></td>
                <td style="color: #7eeef3;">
                    <button class="btn" type="button" style="background-color: #09bcf3; width: 45%;"><a style="color: #FFFFFF;" href="ubah.php?id=<?= $row['id'];?>">Ubah Data</a></button> 
                    <button class="btn" type="button" style="background-color: #e4492e; width: 50%;"><a style="color: #FFFFFF;" href="hapus.php?id=<?= $row['id'];?>">Hapus Data</a></button>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
                <td style="color: #7eeef3;" colspan="7">Belum ada data</td>
            </tr>
            <?php endif; ?>
            </table>
        </div><br><br><br>
        <div>
        <button class="btn" type="button" style="background-color: #07940e;"><a style="color: #7eeef3" href="tambah.php">Tambah Data Checklist</a></button>
        </div> <br>
        <div>
        <button class="btn" type="button" style="background-color: #07940e;"><a style="color: #FFFFFF" href="home.php">Kembali</a></button>
        </div>
    </div>
</body>
</html>
```

- home.php

```
<?php
session_start();
$title ='Home';
include_once 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web Checklist Toilet</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body style="margin-top: 30px; background-color: #8B008B;">
    <h1 style="color: #000000; text-align: center;">SELAMAT DATANG DI APLIKASI CHECKLIST</h1>
    <div class = "container" style= "width: 50%; padding: 30px;">
        <ul class="list-group">
            <li class="list-group-item active" aria-current="true" style="background-color: #EE82EE;">Menu</li>
            <li class="list-group-item" type="" style="font-size: 30px; color: #FFFFFF;"><a style="color: #FF0000;" href="index.php">Checklist Toilet</a></li>
            <li class="list-group-item" style="font-size: 30px; color: #FFFFFF;"><a style="color: #144272;" href="ind_toilet.php">Data Toilet</a></li>
        </ul>
    </div>
    <div class="d-grid gap-2 container" style="width:50%;">
        <button class="btn" type="button" style="background-color: #008080"><a style="color: #FFFFFF" href="login.php">Logout</a></button>
    </div>
</body>
</html>
```

- tambah.php

```
<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit']))
{
    $tanggal = $_POST['tanggal'];
    $toilet_id = $_POST['toilet_id'];
    $kloset = $_POST['kloset'];
    $wastafel = $_POST['wastafel'];
    $lantai = $_POST['lantai'];
    $dinding = $_POST['dinding'];
    $kaca = $_POST['kaca'];
    $bau = $_POST['bau'];
    $sabun = $_POST['sabun'];
    $users_id = $_POST['users_id'];

    $sql = 'INSERT INTO checklist (tanggal, toilet_id, kloset, wastafel, lantai, dinding, kaca, bau, sabun, users_id) ';
    $sql .= "VALUE ('{$tanggal}', '{$toilet_id}', '{$kloset}', '{$wastafel}', '{$lantai}', '{$dinding}', '{$kaca}', '{$bau}', '{$sabun}', '{$users_id}')";
    $result = mysqli_query($conn, $sql);
    header('location: index.php');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body style="margin-top: 30px; background-color: #0A2647;">
    <div class="container" style="background-color: #144272; width: 50%; padding: 30px;">
        <h1 style="color: #FFFFFF; text-align: center;">Tambah Data</h1>
        <div class="main">
            <form method="post" action="tambah.php" enctype="multipart/form-data">
                <div class="input-group">
                    <span class="input-group-text">Tanggal</span>
                    <input class="form-control" type="date" name="tanggal" data-date-format="DD/MMM/YYYY" placeholder="dd/mm/yyyy">
                </div><br>
                <div class="input-group">
                    <span class="input-group-text">Kode Toilet</span>
                    <input class="form-control" type="text" name="toilet_id">
                </div><br>
                <div class="input-group">
                    <span class="input-group-text">Kode Petugas</span>
                    <input class="form-control" type="text" name="users_id">
                </div>  
                <div class="input">
                    <label style="color: #FFFFFF;">Kloset</label>
                    <select class="form-select" aria-label="Default select example" name="kloset">
                        <option value=""></option>
                        <option value="Bersih">Bersih</option>
                        <option value="Kotor">Kotor</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Wastafel</label>
                    <select class="form-select" aria-label="Default select example" name="wastafel">
                        <option value=""></option>
                        <option value="Bersih">Bersih</option>
                        <option value="Kotor">Kotor</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Lantai</label>
                    <select class="form-select" aria-label="Default select example" name="lantai">
                        <option value=""></option>
                        <option value="Bersih">Bersih</option>
                        <option value="Kotor">Kotor</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Dinding</label>
                    <select class="form-select" aria-label="Default select example" name="dinding">
                        <option value=""></option>
                        <option value="Bersih">Bersih</option>
                        <option value="Kotor">Kotor</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Kaca</label>
                    <select class="form-select" aria-label="Default select example" name="kaca">
                        <option value=""></option>
                        <option value="Bersih">Bersih</option>
                        <option value="Kotor">Kotor</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Bau</label>
                    <select class="form-select" aria-label="Default select example" name="bau">
                        <option value=""></option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Sabun</label>
                    <select class="form-select" aria-label="Default select example" name="sabun">
                        <option value=""></option>
                        <option value="Ada">Ada</option>
                        <option value="Habis">Habis</option>
                        <option value="Hilang">Hilang</option>
                    </select>
                </div><br>
                
                <input class= "btn" style="background-color: #2C74B3; color: #FFFFFF;" type="submit" name="submit" value="Simpan">
            </form>
        </div>
    </div>
</body>
</html>
```

- ubah.php

```
<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit'])) 
{
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $toilet_id = $_POST['toilet_id'];
    $kloset = $_POST['kloset'];
    $wastafel = $_POST['wastafel'];
    $lantai = $_POST['lantai'];
    $dinding = $_POST['dinding'];
    $kaca = $_POST['kaca'];
    $bau = $_POST['bau'];
    $sabun = $_POST['sabun'];
    $users_id = $_POST['users_id'];

    $sql = "UPDATE checklist SET tanggal = '$tanggal', toilet_id = '$toilet_id', kloset = '$kloset', 
    wastafel = '$wastafel', lantai = '$lantai', dinding = '$dinding', kaca = '$kaca', 
    bau = '$bau', sabun = '$sabun', users_id = '$users_id' ";
    $sql .= "WHERE id = '{$id}'";
    $result = mysqli_query($conn, $sql);

    header('location: index.php');
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM checklist WHERE id = '{$id}'";
    $result = mysqli_query($conn, $sql);
    if (!$result) die('Error: Data tidak tersedia');
    $data = mysqli_fetch_array($result); 

    function is_select($var, $val) {
        if ($var == $val) return 'selected="selected"';
        return false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ubah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body style="margin-top: 30px; background-color: #8B008B;">
    <div class="container" style="background-color: #000000; width: 50%; padding: 30px;">
        <h1 style="color: #FFFFFF; text-align: center;">Ubah Data</h1>
        <div class="main">
            <form method="post" action="ubah.php" enctype="multipart/form-data">
                <div class="input-group">
                    <span class="input-group-text">Tanggal</span>
                    <input class="form-control" type="date" name="tanggal" data-date-format="DD/MMM/YYYY" placeholder="dd/mm/yyyy" value = "<?php echo $data['tanggal'];?>"/>
                </div><br>
                <div class="input-group">
                    <span class="input-group-text">Kode Toilet</span>
                    <input class="form-control" type="text" name="toilet_id" value="<?php echo $data['toilet_id'];?>"/>
                </div><br>
                <div class="input-group">
                    <span class="input-group-text">Kode Petugas</span>
                    <input class="form-control" type="text" name="users_id" value="<?php echo $data['users_id'];?>"/>
                </div><br>
                <div class="input">
                    <label style="color: #FFFFFF;">Kloset</label>
                    <select class="form-select" aria-label="Default select example" name="kloset">
                        <option <?php echo is_select ('Bersih', $data['kloset']);?> value="Bersih">Bersih</option>
                        <option <?php echo is_select ('Kotor', $data['kloset']);?> value="Kotor">Kotor</option>
                        <option <?php echo is_select ('Rusak', $data['kloset']);?> value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Wastafel</label>
                    <select class="form-select" aria-label="Default select example" name="wastafel">
                        <option <?php echo is_select ('Bersih', $data['wastafel']);?> value="Bersih">Bersih</option>
                        <option <?php echo is_select ('Kotor', $data['wastafel']);?> value="Kotor">Kotor</option>
                        <option <?php echo is_select ('Rusak', $data['wastafel']);?> value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Lantai</label>
                    <select class="form-select" aria-label="Default select example" name="lantai">
                        <option <?php echo is_select ('Bersih', $data['lantai']);?> value="Bersih">Bersih</option>
                        <option <?php echo is_select ('Kotor', $data['lantai']);?> value="Kotor">Kotor</option>
                        <option <?php echo is_select ('Rusak', $data['lantai']);?> value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Dinding</label>
                    <select class="form-select" aria-label="Default select example" name="dinding">
                        <option <?php echo is_select ('Bersih', $data['dinding']);?> value="Bersih">Bersih</option>
                        <option <?php echo is_select ('Kotor', $data['dinding']);?> value="Kotor">Kotor</option>
                        <option <?php echo is_select ('Rusak', $data['dinding']);?> value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Kaca</label>
                    <select class="form-select" aria-label="Default select example" name="kaca">
                        <option <?php echo is_select ('Bersih', $data['kaca']);?> value="Bersih">Bersih</option>
                        <option <?php echo is_select ('Kotor', $data['kaca']);?> value="Kotor">Kotor</option>
                        <option <?php echo is_select ('Rusak', $data['kaca']);?> value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Bau</label>
                    <select class="form-select" aria-label="Default select example" name="bau">
                        <option <?php echo is_select ('Ya', $data['bau']);?> value="Ya">Ya</option>
                        <option <?php echo is_select ('Tidak', $data['bau']);?> value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Sabun</label>
                    <select class="form-select" aria-label="Default select example" name="sabun">
                        <option <?php echo is_select ('Ada', $data['sabun']);?> value="Ada">Ada</option>
                        <option <?php echo is_select ('Habis', $data['sabun']);?> value="Habis">Habis</option>
                        <option <?php echo is_select ('Hilang', $data['sabun']);?> value="Hilang">Hilang</option>
                    </select>
                </div>
                <div>
                <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                <input class="tombol" type="submit" name="submit" value="Simpan"/>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
```

- hapus.php

```
<?php
include_once 'koneksi.php';
$id = $_GET['id'];
$sql = "DELETE FROM checklist WHERE id = '{$id}'";
$result = mysqli_query($conn, $sql);
header('location: index.php');
?>
```



- ind_toilet.php

```
<?php
include("koneksi.php");

$q = "";
if (isset($_GET['submit']) && !empty($_GET['q'])) {
    $q = $_GET['q'];
    $sql_where = "WHERE keterangan LIKE '%".$q."%' or lokasi LIKE '%".$q."%'";
}
$title = 'Toilet';
$sql = 'SELECT * FROM toilet ';
if (isset($sql_where))
    $sql .= $sql_where;
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cheklist Toilet</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body style="margin-top: 30px; background-color: #0A2647;">
    <div class="container" class="container" style="background-color: #144272; width: 50%; padding: 30px;">
        <br><br>
        <div class="head">
        <h1 style="color: #FFFFFF;">Data Toilet</h1>
        <form>
            <div class="form-group" action="" method="get" >
                <label for="q" style="color: #FFFFFF;">Cari Data Toilet</label>
                <input type="text" placeholder="Masukkan Pencarian"  id="q" name="q" class="input-q" value="<?php echo $q ?>">
                <button type="submit" name="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
        </div>
        <div class="main">
            <table class="table table-striped table-hover">
            <tr>
                <th style="color: #FFFFFF;">Kode Toilet</th>
                <th style="color: #FFFFFF;">Lokasi Toilet</th>
                <th style="color: #FFFFFF;">Keterangan</th>
                <th style="color: #FFFFFF;">Aksi</th>
            </tr>
            <?php if($result): ?>
            <?php while($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td style="color: #FFFFFF;"><?= $row['id'];?></td>
                <td style="color: #FFFFFF;"><?= $row['lokasi'];?></td>
                <td style="color: #FFFFFF;"><?= $row['keterangan'];?></td>
                <td style="color: #FFFFFF;">
                    <button class="btn" type="button" style="background-color: #e4492e; width: 70%;"><a style="color: #FFFFFF;" href="hap_toilet.php?id=<?= $row['id'];?>">Hapus Data</a></button>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
                <td style="color: #FFFFFF;" colspan="7">Belum ada data</td>
            </tr>
            <?php endif; ?>
            </table>
        </div><br><br><br>
        <div>
        <button class="btn" type="button" style="background-color: #07940e;"><a style="color: #FFFFFF" href="tam_toilet.php">Tambah Data Toilet</a></button>
        </div> <br>
        <div>
        <button class="btn" type="button" style="background-color: #07940e;"><a style="color: #FFFFFF" href="home.php">Kembali</a></button>
        </div>
    </div>
</body>
</html>
```

- tam_toilet.php

```
<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit']))
{
    $toilet_id = $_POST['toilet_id'];
    $lokasi = $_POST['lokasi'];
    $keterangan = $_POST['keterangan'];

    $sql = 'INSERT INTO toilet (id, lokasi, keterangan) ';
    $sql .= "VALUE ('{$toilet_id}', '{$lokasi}', '{$keterangan}')";
    $result = mysqli_query($conn, $sql);
    header('location: ind_toilet.php');
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
    <div class="container" style="background-color: #144272; width: 50%; padding: 30px;">
        <h1 style="color: #FFFFFF; text-align: center;">Tambah Data Toilet</h1>
        <div class="main">
            <form method="post" action="tam_toilet.php" enctype="multipart/form-data">
                <div class="input-group">
                    <span class="input-group-text">Kode Toilet</span>
                    <input class="form-control" type="text" name="toilet_id">
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Lokasi</label>
                    <select class="form-select" aria-label="Default select example" name="lokasi">
                        <option value=""></option>
                        <option value="Office">Office</option>
                        <option value="Factory 1">Factory 1</option>
                        <option value="Factory 2">Factory 2</option>
                        <option value="Security">Security</option>
                    </select>
                </div>
                <div class="input">
                    <label style="color: #FFFFFF;">Keterangan</label>
                    <select class="form-select" aria-label="Default select example" name="keterangan">
                        <option value=""></option>
                        <option value="Sudah">Sudah</option>
                        <option value="Belum">Belum</option>
                    </select>
                </div> <br>
                <input class= "btn" style="background-color: #2C74B3; color: #FFFFFF;" type="submit" name="submit" value="Simpan">
            </form>
        </div>
    </div>
</body>
</html>
```

- hap_toilet.php

```
<?php
include_once 'koneksi.php';
$id = $_GET['id'];
$sql = "DELETE FROM toilet WHERE id = '{$id}'";
$result = mysqli_query($conn, $sql);
header('location: ind_toilet.php');
?>
```




# Screnshoot tampilan di web user dan admin

Tampilan daftar
![Screenshot (391)](https://github.com/muhammadzidanfadilah/UAS-PEMROGRAMAN-WEB/assets/115553474/5752295a-81b1-4523-ad98-0e17632aa65a)



Tampilan Login
![Screenshot (392)](https://github.com/muhammadzidanfadilah/UAS-PEMROGRAMAN-WEB/assets/115553474/e04fb918-d208-43f3-96de-ad9cd77efc37)



Tampilan Menu
![Screenshot (393)](https://github.com/muhammadzidanfadilah/UAS-PEMROGRAMAN-WEB/assets/115553474/c6c36105-b2ac-47c2-acb6-aaacbc99de06)



Tampilan Checklist Toilet
![Screenshot (394)](https://github.com/muhammadzidanfadilah/UAS-PEMROGRAMAN-WEB/assets/115553474/594b935f-443e-4f49-b77e-ca95e7b3fc31)


Tampilan Tambah Data
![Screenshot (395)](https://github.com/muhammadzidanfadilah/UAS-PEMROGRAMAN-WEB/assets/115553474/282a4da7-b0a2-40a1-a2c2-d648373fbe56)




Tampilan Ubah Data
![Screenshot (396)](https://github.com/muhammadzidanfadilah/UAS-PEMROGRAMAN-WEB/assets/115553474/0c9e5858-f2ec-4875-94d3-fc8e712145c9)




Tampilan Data Toilet
![Screenshot (397)](https://github.com/muhammadzidanfadilah/UAS-PEMROGRAMAN-WEB/assets/115553474/7ee47d5d-d7ed-494a-8391-01a9329c83b2)




Tampilan Tambah Data Toilet
![Screenshot (398)](https://github.com/muhammadzidanfadilah/UAS-PEMROGRAMAN-WEB/assets/115553474/3c3787fe-fdfa-46c3-867a-fe6c60b9b4f5)



Terima Kasih 
semoga Hasilnya memuaskan

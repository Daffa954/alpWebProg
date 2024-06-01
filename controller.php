<?php
function bukaKonesi()
{
    $host = 'localhost';
    $user = 'root';
    $pwd = '';
    $db = 'our_food';

    $conn = mysqli_connect($host, $user, $pwd, $db) or die("Koneksi ke database gagal: " . mysqli_connect_error());
    return $conn;
}

function tutupKoneksi($conn)
{
    mysqli_close($conn);
}

function getAllBooks()
{
    $sql = "SELECT * FROM buku";
    $conn = bukaKonesi();
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    tutupKoneksi($conn);
    return $rows;
}



function addProduk($data)
{
    $conn = bukaKonesi();
    $nama = htmlspecialchars($data['nama']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $kategori = htmlspecialchars($data['kategori']);
    $jumlah = htmlspecialchars($data['jumlah']);
    $harga = htmlspecialchars($data['harga']);

    // Upload gambar
    $photo = upload();
    if (!$photo) {
        return false;
    }
    $sql = "INSERT INTO produk (id_produk, nama, deskripsi, kategori, jumlah, harga, photo) VALUES (NULL,'$nama', '$deskripsi', '$kategori', '$jumlah', '$harga', '$photo')";
    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    tutupKoneksi($conn);
}
//upload gambar
function upload()
{
    $filename = $_FILES['photo']['name'];
    $filesize = $_FILES['photo']['size'];
    $error = $_FILES['photo']['error'];
    $tmpname = $_FILES['photo']['tmp_name'];

    // cek apakah gambar tidak ada yg diupload
    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu')</script>";
        return false;
    }

    // cek apakah yg di upload gambar
    $fileExtension = ['jpg', 'jpeg', 'png', 'gif'];
    $getExtension = explode('.', $filename);
    $getExtension = strtolower(end($getExtension));
    if (!in_array($getExtension, $fileExtension)) {
        echo "<script>alert('Yang anda pilih bukan gambar')</script>";
        return false;
    }
    // cek jika ukuran nya besar
    if ($filesize >= 1000000) { // 1MB
        echo "<script>alert('Ukuran terlalu besar')</script>";

        return false;
    }


    $newFileName = uniqid();
    $newFileName = $newFileName . '.' . $getExtension;
    // Lolos pengecekan, gambar siap di upload
    if (move_uploaded_file($tmpname, 'image/' . $newFileName)) {
        return 'image/' . $newFileName;
    } else {
        echo "error";
        return $_FILES["photo"]["name"];
    }
}

function register($data)
{
    $conn = bukaKonesi();
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $password = htmlspecialchars($data['password']);

    $checkEmail = "SELECT email from user WHERE email = '$email'";
    $checking = mysqli_query($conn, $checkEmail);
    $row = mysqli_fetch_assoc($checking);

    if ($row != null) {
        echo " <script>
        alert('email sudah digunakan');
        document.location.href = 'register.php';
        </script>";
        return false;
    }
    $sql = "INSERT INTO user (id_user,nama, email, password) VALUES (NULL, '$nama', '$email', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo " <script>
        alert('data berhasil ditambah');
        document.location.href = 'home.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    tutupKoneksi($conn);
}

function login($data)
{
    $conn = bukaKonesi();
    $email = htmlspecialchars($data['email']);
    $password = htmlspecialchars($data['password']);
    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $user = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($user);
    tutupKoneksi($conn);
    return $row;
}


function seeStock()
{
    $conn = bukaKonesi();

    $sql = "SELECT SUM(jumlah) AS total FROM produk";
    $sumStock = mysqli_query($conn, $sql);

    if (!$sumStock) {
        // Menangani kesalahan query
        echo "Error: " . mysqli_error($conn);
        tutupKoneksi($conn);
        return null;
    }

    $result = mysqli_fetch_assoc($sumStock);
    tutupKoneksi($conn);
    return $result;
}


?>
<?php
    session_start();
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
    $sql = "SELECT * FROM produk";
    $conn = bukaKonesi();
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    tutupKoneksi($conn);
    return $rows;
}

function seeDetails($id)
{
    $sql = "SELECT * FROM produk WHERE id = $id";
    $conn = bukaKonesi();
    $book = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($book);
    tutupKoneksi($conn);
    return $row;
}

function addBooks($data)
{
    $conn = bukaKonesi();
    $title = htmlspecialchars($data['title']);
    $description = htmlspecialchars($data['description']);

    // Upload gambar
    $photo = upload();
    if (!$photo) {
        return false;
    }

    $sql = "INSERT INTO buku (id, category_id, title, description, author, nidn, photo) VALUES (NULL, NULL, '$title', '$description', NULL, NULL, '$photo')";
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
    //generate nama baru
    $newFileName = uniqid();
    $newFileName = $newFileName .'.'.$getExtension;

    // Lolos pengecekan, gambar siap di upload
    if (move_uploaded_file($tmpname, 'image/' . $newFileName)) {
       
        return 'image/' .$newFileName;
    } else {
        echo "error";
        return $_FILES["photo"]["name"];
    }
}


?>
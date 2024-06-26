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

function getProduct($id)
{
    $sql = "SELECT * FROM produk WHERE id_produk = $id";
    $conn = bukaKonesi();
    $product = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($product);
    tutupKoneksi($conn);
    return $row;
}


function getAllProducts()
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
        echo "<script>alert('Produk berhasil ditambah')</script>";
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

    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $user = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($user);
    tutupKoneksi($conn);
    return $row;

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




    $result = mysqli_fetch_assoc($sumStock);
    tutupKoneksi($conn);
    return $result;
}

function rubah($data, $id)
{

    $conn = bukaKonesi();
    $nama = htmlspecialchars($data["nama"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $harga = htmlspecialchars($data["harga"]);
    $oldPhoto = htmlspecialchars($data["oldPhoto"]);

    // Cek apakah user memilih gambar baru atau tidak
    if ($_FILES['photo']['error'] === 4) {
        $photo = $oldPhoto;
    } else {
        $photo = upload();
    }

    //Query untuk update data di database
    $query = "UPDATE produk SET nama = '$nama', deskripsi = '$deskripsi', kategori = '$kategori', jumlah = '$jumlah', harga = '$harga', photo = '$photo' WHERE id_produk = $id";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        echo "<script>
        alert('Data berhasil diubah');
        document.location.href = 'listMenu.php';
        </script>";
    } else {
        echo "<script>alert('Data gagal diubah: " . mysqli_error($conn) . "')</script>";
    }



    // Tutup koneksi
    mysqli_close($conn);
}

function deleteProduct($id)
{
    $conn = bukaKonesi();

    $sql = "SELECT photo FROM produk WHERE id_produk = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $filePath = $row['photo'];
        // Hapus file dari sistem file jika file tersebut ada
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // Hapus entri dari database
    mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id");

    $affectedRows = mysqli_affected_rows($conn);
    mysqli_close($conn);
    return $affectedRows;
}

function getAllFoods()
{
    $conn = bukaKonesi();
    $sql = "SELECT * FROM produk WHERE kategori = 'makanan'";
    $rows = [];
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    tutupKoneksi($conn);
    return $rows;
}

function getAllDrinks()
{
    $conn = bukaKonesi();
    $sql = "SELECT * FROM produk WHERE kategori = 'minuman'";
    $rows = [];
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    tutupKoneksi($conn);
    return $rows;
}

function createOrder($id_produk, $id_user, $harga, $stok, $jumlah)
{
    $conn = bukaKonesi();
    $total = $jumlah * $harga;
    $tanggal = date('Y-m-d');
    $check = "SELECT jumlah from produk WHERE id_produk = '$id_produk'";
    $result = mysqli_query($conn, $check);
    $resultDetail = mysqli_fetch_assoc($result);
    if ($jumlah <= $resultDetail['jumlah']) {
        $sql = "INSERT INTO memesan(id_memesan, id_user, id_produk, jumlah, harga, checkout, tanggal) VALUES (NULL, '$id_user','$id_produk','$jumlah', '$total', 0, '$tanggal')";
        $sisa = $stok - $jumlah;
        $updateStock = "UPDATE produk SET jumlah = '$sisa' where id_produk = '$id_produk'";
        if (mysqli_query($conn, $sql) && mysqli_query($conn, $updateStock)) {
            echo "<script>alert('Produk berhasil dipesan')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Produk sudah habis')</script>";
        return false;
    }
    tutupKoneksi($conn);
}

function sumOrderToday()
{
    $conn = bukaKonesi();
    $dateNow = date('Y-m-d');
    $sql = "SELECT COUNT(id_memesan) AS total FROM memesan where tanggal = '$dateNow'";
    $sumOrder = mysqli_query($conn, $sql);

    $result = mysqli_fetch_assoc($sumOrder);
    tutupKoneksi($conn);
    return $result;
}

function sumProductSoldToday()
{
    $conn = bukaKonesi();
    $dateNow = date('Y-m-d');
    $sql = "SELECT SUM(jumlah) AS total FROM memesan where tanggal = '$dateNow' AND checkout = 1";
    $sumOrder = mysqli_query($conn, $sql);

    $result = mysqli_fetch_assoc($sumOrder);
    tutupKoneksi($conn);
    return $result;
}

function seeAllOrderToday()
{
    $conn = bukaKonesi();
    $dateNow = date('Y-m-d');
    $sql = "SELECT m.id_memesan, u.nama AS nama_pemesan, p.nama as menu, m.jumlah, m.harga, m.checkout, m.tanggal FROM memesan m, user u, produk p where u.id_user = m.id_user and p.id_produk = m.id_produk and tanggal ='$dateNow'";
    $rows = [];
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $rows[] = $row;
    }
    tutupKoneksi($conn);
    return $rows;
}

function seeAllOrder()
{
    $conn = bukaKonesi();
    $sql = "SELECT m.id_memesan, u.nama AS nama_pemesan, p.nama as menu, m.jumlah, m.harga, m.checkout, m.tanggal FROM memesan m, user u, produk p where u.id_user = m.id_user and p.id_produk = m.id_produk order by tanggal DESC";
    $rows = [];
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $rows[] = $row;
    }
    tutupKoneksi($conn);
    return $rows;
}
function finishOrder($id_memesan)
{

    $conn = bukaKonesi();
    $check = "SELECT checkout from memesan WHERE id_memesan = '$id_memesan'";
    $result = mysqli_query($conn, $check);
    $resultDetail = mysqli_fetch_assoc($result);
    if ($resultDetail['checkout'] != 1) {
        $sql = "UPDATE memesan SET checkout = 1 where id_memesan = '$id_memesan'";
        mysqli_query($conn, $sql);
        echo "<script>
    alert('Produk berhasil diproses');
    document.location.href = 'admin.php';
    </script>";
    } else {
        echo "<script>
    alert('Produk telah diproses');
    document.location.href = 'admin.php';
    </script>";
        return false;
    }
    tutupKoneksi($conn);
}

function deleteOrder($id)
{
    $conn = bukaKonesi();

    mysqli_query($conn, "DELETE FROM memesan WHERE id_memesan = $id");

    $affectedRows = mysqli_affected_rows($conn);
    mysqli_close($conn);
    return $affectedRows;
}

function searchProduct($keyword)
{
    $conn = bukaKonesi();

    $sql = "SELECT * FROM produk WHERE 
    nama LIKE '%$keyword%' OR
    deskripsi LIKE '%$keyword%' OR
    kategori LIKE'%$keyword%' OR
    jumlah LIKE'%$keyword%' OR  
    harga LIKE'%$keyword%'
    ";

    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    tutupKoneksi($conn);
    return $rows;
}

function custOrderToday($userId)
{
    $conn = bukaKonesi();
    $dateNow = date('Y-m-d');
    $sql = "SELECT m.id_memesan,p.nama, m.jumlah, m.harga , m.checkout 
    FROM memesan m, produk p WHERE 
    m.id_produk = p.id_produk AND m.id_user = '$userId' AND tanggal = '$dateNow';
   
    ";

    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    tutupKoneksi($conn);
    return $rows;
}

function custOrderAll($userId)
{
    $conn = bukaKonesi();
    $dateNow = date('Y-m-d');
    $sql = "SELECT m.id_memesan,p.nama, m.jumlah, m.harga , m.tanggal
    FROM memesan m, produk p WHERE 
    m.id_produk = p.id_produk AND m.id_user = '$userId' ORDER BY m.tanggal;
   
    ";

    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    tutupKoneksi($conn);
    return $rows;
}

function updateProfile($data, $id)
{

    $conn = bukaKonesi();
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $password = htmlspecialchars($data["password"]);
    var_dump($nama);
    $query = "UPDATE user SET nama = '$nama', password = '$password', email = '$email' WHERE id_user = $id";

    if (mysqli_query($conn, $query)) {
        echo "<script>
        alert('Data berhasil diubah');
        document.location.href = 'profile.php';
        </script>";
    } else {
        echo "<script>alert('Data gagal diubah: " . mysqli_error($conn) . "')</script>";
    }
    mysqli_close($conn);
}

function deleteUser($id)
{
    $conn = bukaKonesi();

    mysqli_query($conn, "DELETE FROM user WHERE id_user = $id");

    $affectedRows = mysqli_affected_rows($conn);
    mysqli_close($conn);
    return $affectedRows;
}
?>
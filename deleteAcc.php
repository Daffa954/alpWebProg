<?php
require "controller.php";
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>
    alert('Tidak bisa menghapus akun silahkan login terlebih dahulu');
    document.location.href = 'home.php';
    </script>";
}
$del = deleteUser($_GET['id']);
if ($del > 0) {
    session_destroy();
    echo "
    <script>
        alert('Akun berhasil dihapus');
        document.location.href = 'home.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Akun gagal dihapus');
        document.location.href = 'home.php';
    </script>
    ";
}
?>
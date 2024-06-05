<?php
require "controller.php";
session_start();
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
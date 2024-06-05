<?php
require "controller.php";
session_start();

$del = deleteOrder($_GET['id']);
if ($del > 0) {
    echo "
    <script>
        alert('pesanan berhasil dihapus');
    </script>
    ";
    if($_SESSION['user']['role'] == 'admin') {
        echo "
        <script>          
            document.location.href = 'admin.php';
        </script>
        ";
    }else {
        echo "
        <script>          
            document.location.href = 'myOrder.php';
        </script>
        ";
    }
} else {
    echo "
    <script>
        alert('pesanan gagal dihapus');
        document.location.href = 'admin.php';
    </script>
    ";
}
?>
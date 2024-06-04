<?php
require "controller.php";
$del = deleteOrder($_GET['id']);
if ($del > 0) {
    echo "
    <script>
        alert('pesanan berhasil dihapus');
        document.location.href = 'admin.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('pesanan gagal dihapus');
        document.location.href = 'admin.php';
    </script>
    ";
}
?>
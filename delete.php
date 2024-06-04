<?php
require "controller.php";
$del = deleteProduct($_GET['id']);
if ($del > 0) {
    echo "
    <script>
        alert('data berhasil dihapus');
        document.location.href = 'listMenu.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('data gagal dihapus');
        document.location.href = 'listMenu.php';
    </script>
    ";
}
?>
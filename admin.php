<?php
session_start();
if(isset($_POST['logout'])) {
    session_destroy();
    echo "<script>
    alert('logout berhasil');
    document.location.href = 'home.php';
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hallo admin</h1>
    <form action="" method="post">
    <button name="logout">logout</button>

    </form>
</body>
</html>
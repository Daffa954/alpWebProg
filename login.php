<?php
require "controller.php";
session_start();

if(isset($_POST['submit'])) {
    $user = login($_POST);
    if($user != null) {
        $_SESSION['user'] = $user;
        if($user['role'] == 'customer') {
        echo " <script>
        alert('login berhasil');
        document.location.href = 'home.php';
        </script>";
        }elseif ($user['role'] == 'admin') {
            # code...
            echo " <script>
            alert('login berhasil');
            document.location.href = 'admin.php';
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title>Register</title>
</head>

<body>
    <div class="bg-[#ffd700] w-full h-[100vh] flex items-center justify-center p-4">

        <form class="lg:w-1/2 w-full p-4 rounded-xl bg-white" method="post">
            <h1 class="text-4xl font-bold mb-8">Login</h1>


            <div class="mb-5">
                <label for="email" class="block mb-2 text-lg font-medium text-gray-900">Masukkan nama
                   </label>
                <input type="email" id="email"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="name@flowbite.com" name="email" required />
            </div>

            <div class="mb-5">
                <label for="password" class="block mb-2 text-lg font-medium text-gray-900">Your
                    password</label>
                <input type="password" id="password"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text- rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required name="password"/>
            </div>
            

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="submit">login
        </form>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>

</html>
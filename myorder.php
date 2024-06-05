<?php
session_start();
require "controller.php";
if ($_SESSION['user']['role'] == 'admin') {
    echo "<script>
    document.location.href = 'admin.php';
    </script>";
}
$orders = custOrderToday($_SESSION['user']['id_user']);
$ordersAll = custOrderAll($_SESSION['user']['id_user']);

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
    <style>
        .active div:nth-child(1) {
            transform: rotate(45deg);
        }

        .active div:nth-child(2) {
            transform: scale(0);
        }

        .active div:nth-child(3) {
            transform: rotate(-45deg);
        }

        .nav-fix {
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            z-index: 99999;
            background-color: rgba(255, 215, 0, 0.6) !important;
            backdrop-filter: blur(5px);
            box-shadow: 1px 1px 1px white;
        }

        header {
            z-index: 9999;
            /* Ensure header has a high z-index */
        }
    </style>
    <title>Document</title>
</head>

<body>
    <!-- navbar -->
    <header class="w-[100%] flex items-center z-10" style="background-color: #ffd700;">
        <div class="flex items-center relative justify-between w-full p-2">
            <div class="flex flex-row gap-2">
                <div class="flex items-center">
                    <div class="w-10 h-10  p-1.5 flex flex-col justify-around rounded z-40" id="hamburger">
                        <div class="bg-white h-1 w-full transition duration-300 origin-top-left"></div>
                        <div class="bg-white h-1 w-full transition duration-300"></div>
                        <div class="bg-white h-1 w-full transition duration-300 origin-bottom-left"></div>
                    </div>
                </div>

                <div class="">
                    <h1 class="font-bold text-2xl text-white  block py-5"><a href="">OurFood</a></h1>
                </div>
            </div>

            <div id="nav-menu"
                class="hidden py-5 absolute shadow-lg bg-[#ffd700] z-30 w-1/2 left-0 top-0 h-[100vh]  lg:w-[25%]">
                <ul class="items-center h-full flex flex-col justify-around">
                    <li class="group"><a href="home.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">Home</a></li>
                    <li class="group"><a href="profile.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">My
                            profile</a>
                    </li>
                    <li class="group"><a href="myorder.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">My
                            Order</a>
                    </li>

                </ul>
            </div>

            <div class="" style="padding-right:20px">
                <?php if (isset($_SESSION['user'])) { ?>
                    <div class="flex gap-10 items-center">
                        <h2>Hello, <?php echo $_SESSION['user']['nama'] ?></h2>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#f9f5f5"
                                class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                        </div>
                    </div>

                <?php } else { ?>
                    <div>
                        <a href="login.php">sign in</a>/<a href="register.php">sign up</a>
                    </div>
                <?php } ?>
            </div>

        </div>
    </header>
    <!-- navbar -->

    <div class="p-4">
        <h2 class="font-bold text-3xl">Pesanan saya hari ini</h2>

        <div class="mt-2">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 rounded-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor order
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Menu
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($orders); $i++) { ?>
                        <tr class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                <?php echo ($i + 1) ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo $orders[$i]['id_memesan'] ?>
                            </td>

                            <td class="px-6 py-4">
                                <?php echo $orders[$i]['nama'] ?>

                            </td>
                            <td class="px-6 py-4">
                                <?php echo $orders[$i]['jumlah'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $orders[$i]['harga'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($orders[$i]['checkout'] == 0) { ?>
                                    <p>proses</p>
                                <?php } else { ?>
                                    <p>selesai</p>
                                <?php } ?>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="deleteOrder.php?id=<?php echo $orders[$i]["id_memesan"] ?>"
                                    class="font-medium text-blue-600 hover:underline" onclick="return confirm('yakin?')">
                                    batalkan</a>
                            </td>
                        </tr>
                    <?php } ?>


                </tbody>
            </table>
        </div>
    </div>

    <div class="p-4">
        <h2 class="font-bold text-3xl">Histori Pesanan</h2>

        <div class="mt-2">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 rounded-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor order
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Menu
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah
                        </th>
                        
                        <th scope="col" class="px-6 py-3">
                            Harga
                        </th>
                        <th scope="col" class="px-6 py-3">
                          Tanggal
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($ordersAll); $i++) { ?>
                        <tr class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                <?php echo ($i + 1) ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo $ordersAll[$i]['id_memesan'] ?>
                            </td>
                            
                            <td class="px-6 py-4">
                                <?php echo $ordersAll[$i]['nama'] ?>

                            </td>
                            <td class="px-6 py-4">
                                <?php echo $ordersAll[$i]['jumlah'] ?>
                            </td>
                            
                            <td class="px-6 py-4">
                                <?php echo $ordersAll[$i]['harga'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $ordersAll[$i]['tanggal'] ?>
                            </td>
                    
                        </tr>
                    <?php } ?>


                </tbody>
            </table>
        </div>
    </div>
    </div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        $('#hamburger').click(function () {
            $('#hamburger').toggleClass('active');
            $("#nav-menu").toggleClass('hidden')
        });

       
    </script>
</body>

</html>
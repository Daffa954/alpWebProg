<?php
require "controller.php";
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    echo "<script>
    alert('logout berhasil');
    document.location.href = 'home.php';
    </script>";
}
$total = seeStock();
$orderToday = sumOrderToday();
$productSoldToday = sumProductSoldToday();
$allOrder = seeAllOrderToday();
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
            background-color: #ffd700 !important;
            backdrop-filter: blur(5px);
            box-shadow: 1px 1px 1px white;
        }

        header {
            z-index: 9999;
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
                    <li class="group"><a href="listMenu.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">List Menu</a>
                    </li>
                    <li class="group"><a href="listOrder.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">List Order</a>
                    </li>
                    <li class="group"><a href="AddMenu.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">Add Menu
                        </a>
                    </li>
                    <li class="group"><a href="profile.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">Profile
                        </a>
                    </li>
                </ul>
            </div>

            <div class="" style="padding-right:20px">
                <?php if (isset($_SESSION['user'])) { ?>
                    <div class="flex gap-10 items-center">
                    <h2>Hello! <?php echo $_SESSION['user']['nama'],"." ?></h2>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#f9f5f5"
                                class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                        </div>
                    </div>

                <?php } else { ?>
                    <div>
                        <a href="login.php">Sign in</a>
                        <a href="register.php">Sign up</a>
                    </div>
                <?php } ?>
            </div>

        </div>
    </header>
    <!-- navbar -->

    <!-- detail -->
    <div class="p-4 w-full flex gap-10 flex-wrap">
        <div class="p-2 bg-white rounded-xl lg:w-[30%] h-32 w-full flex items-center" style="border: 3px solid #27742d">
            <p class="text-xl font-semibold">Jumlah order hari ini : <?php echo $orderToday['total'] ?> </p>
        </div>

        <div class="p-2 bg-white rounded-xl lg:w-[30%] w-full h-32 flex items-center" style="border: 3px solid #27742d">
            <p class="text-xl font-semibold">Jumlah menu yang terjual hari ini :
                <?php echo $productSoldToday['total'] ?>
            </p>
        </div>

        <div class="p-2 bg-white rounded-xl lg:w-[30%] w-full h-32 flex items-center" style="border: 3px solid #27742d">
            <p class="text-xl font-semibold">Stok hari ini : <?php echo $total['total'] ?> </p>
        </div>

    </div>
    <!-- detail -->

    <!-- list order -->
    <div class="p-4  mt-2">
        <h2>Order hari ini</h2>
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
                        <th scope="col" class="px-6 py-3 ">
                            Nama pemesan
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
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($allOrder); $i++) { ?>
                        <tr class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                <?php echo ($i + 1) ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo $allOrder[$i]['id_memesan'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $allOrder[$i]['nama_pemesan'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $allOrder[$i]['menu'] ?>

                            </td>
                            <td class="px-6 py-4">
                                <?php echo $allOrder[$i]['jumlah'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $allOrder[$i]['harga'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($allOrder[$i]['checkout'] == 0) { ?>
                                    <p>proses</p>
                                <?php } else { ?>
                                    <p>selesai</p>
                                <?php } ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $allOrder[$i]['tanggal'] ?>

                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="finish.php?id=<?php echo $allOrder[$i]["id_memesan"] ?>"
                                    class="font-medium text-blue-600 hover:underline"
                                    onclick="return confirm('yakin?')">proses</a>
                                <a href="deleteOrder.php?id=<?php echo $allOrder[$i]["id_memesan"] ?>"
                                    class="font-medium text-blue-600 hover:underline" onclick="return confirm('yakin?')">
                                    Delete</a>
                            </td>
                        </tr>
                    <?php } ?>


                </tbody>
            </table>
        </div>
    </div>
    <!-- list order -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        $('#hamburger').click(function () {
            $('#hamburger').toggleClass('active');
            $("#nav-menu").toggleClass('hidden')
        });

       
    </script>
</body>

</html>
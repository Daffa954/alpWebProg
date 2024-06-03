<?php
include ("controller.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
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
            background-color: #189ab4a7 !important;
            backdrop-filter: blur(5px);
            box-shadow: 1px 1px 1px white;
        }
    </style>
    <title>OurFood</title>
</head>

<body>
    <!-- navbar -->
    <header class="w-[100%] flex items-center z-10" style="background-color: #ffd700;">
        <div class="flex items-center justify-between relative  w-full">
            <div class="px-4">
                <h1 class="font-bold text-2xl text-white  block py-5"><a href="">Food Shop</a></h1>
            </div>
            <div id="nav-menu"
                class="hidden py-5 absolute shadow-lg bg-[#189AB4] z-30 w-[250px] right-0 top-0 h-[100vh] lg:h-full lg:bg-transparent lg:shadow-none lg:block lg:static lg:w-4/6">
                <ul class=" lg:flex lg:flex-row lg:justify-around items-center h-full flex flex-col justify-around">
                    <li class="group"><a href="home.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">Home</a></li>
                    <li class="group"><a href="add.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">Add
                            Food/Drink</a>
                    </li>

                </ul>
            </div>
            <div class="flex items-center px-4 lg:hidden">
                <div class="w-10 h-10  p-1.5 flex flex-col justify-around rounded z-40" id="hamburger">
                    <div class="bg-white h-1 w-full transition duration-300 origin-top-left"></div>
                    <div class="bg-white h-1 w-full transition duration-300"></div>
                    <div class="bg-white h-1 w-full transition duration-300 origin-bottom-left"></div>
                </div>
            </div>

        </div>
    </header>
    <!-- navbar -->

    <!-- HOME -->
    <form class="md:w-1/2 w-full p-4 mt-4 bg-blue-200 rounded rounded-lg" method="POST" enctype="multipart/form-data"
        action="add.php">
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="nama" id="nama"
                class="block py-2.5 px-0 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="title"
                class="peer-focus:font-medium absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama
            </label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="description" id="description"
                class="block py-2.5 px-0 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="description"
                class="peer-focus:font-medium absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description
            </label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <select name="kategori" id="kategori"
                class="block py-2.5 px-0 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" ">
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
            </select>
            <label for="kategori"
                class="peer-focus:font-medium absolute text-lg text-gray-500 dark:text-gray-400 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Kategori
            </label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <input type="number" name="jumlah" id="jumlah"
                class="block py-2.5 px-0 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="jumlah"
                class="peer-focus:font-medium absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jumlah
            </label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="number" name="harga" id="harga"
                class="block py-2.5 px-0 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="harga"
                class="peer-focus:font-medium absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Harga
            </label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="file" name="foto" id="foto"
                class="block py-2.5 px-0 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="foto"
                class="peer-focus:font-medium absolute text-lg text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Photo
            </label>
        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            name="submitBook">Submit</button>
    </form>
    <!-- HOME -->
</body>

</html>
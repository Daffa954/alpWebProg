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

if(isset($_POST['submit'])) {
    addProduk($_POST);
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
                        <a href="login.php">sign in</a>/<a href="register.php">sign up</a>
                    </div>
                <?php } ?>
            </div>

        </div>
    </header>



    <div class="p-4">

        <h1 class="text-3xl font-bold mb-5">Tambah Menu</h1>
        <form class="p-4 bg-white  w-full m-auto rounded-xl" style="border: 3px solid #ffd700" method="post" enctype="multipart/form-data">
            <div class="mb-5">
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Menu</label>
                <input type="text" id="nama"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    required name="nama" />
            </div>
            <div class="mb-5">
                <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">
                    Deskripsi</label>
                <textarea id="deskripsi" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Write your thoughts here..." name="deskripsi"></textarea>
            </div>
            <div class="mb-5">

                <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                <select id="kategori" name="kategori"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option selected>pilih kategori</option>
                    <option value="makanan">makanan</option>
                    <option value="minuman">minuman</option>
                </select>
            </div>
            <div class="mb-5">
                <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900">Jumlah Menu</label>
                <input type="number" id="jumlah"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    required name="jumlah" />
            </div>
            <div class="mb-5">
                <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Harga Menu</label>
                <input type="number" id="harga"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    required name="harga" />
            </div>

            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="photo">Upload
                    gambar</label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                    aria-describedby="photo_help" id="photo" type="file" name="photo">
                <p class="mt-1 text-sm text-gray-500 0" id="photo_help">PNG, JPG or GIF (MAX.
                   1 MB).</p>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" name="submit">Submit</button>
        </form>

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
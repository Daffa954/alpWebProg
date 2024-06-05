<?php
session_start();
if (isset($_POST['logout'])) {
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

                    <li class="group"><a href="profile.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">My Profile
                        </a>
                    </li>
                    <?php if ($_SESSION['user']['role'] == 'admin') { ?>
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
                    <?php } else { ?>
                        <li class="group"><a href="myorder.php"
                                class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">My Order
                            </a>
                        </li>
                    <?php } ?>

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
                    <a href="login.php" class="p-3  rounded-xl text-slate-500 border-white border-solid border-2">Sign in</a>
                        <a href="register.php" class="ml-4 p-3  rounded-xl text-slate-500 border-white border-solid border-2">Sign up</a>
                    </div>
                <?php } ?>
            </div>

        </div>
    </header>
    <!-- navbar -->

    <div class="p-4 lg:w-[70%] w-full m-auto flex flex-col">
        <h1 class="text-3xl font-bold">My Profile</h1>
        <div class="p-4 rounded-lg mt-4" style="border: 2px solid black">
            <table class="text-xl ">
                <tr>
                    <td>Nama</td>
                    <td> : </td>
                    <td><?php echo $_SESSION['user']['nama'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td> : </td>
                    <td><?php echo $_SESSION['user']['email'] ?></td>
                </tr>

            </table>
            <div class="mt-2 flex gap-4">
                <?php if ($_SESSION['user']['role'] != 'admin') { ?>
                    <a href="updateAcc.php?id=<?= $_SESSION['user']['id_user'] ?>" class="p-2 bg-blue-100 rounded-lg">Rubah
                        data</a>
                    <a href="deleteAcc.php?id=<?= $_SESSION['user']['id_user'] ?>" class="p-2 bg-red-500 rounded-lg text-white"
                        onclick="confirm('yakin?')">Hapus akun</a>

                <?php } ?>
            </div>

        </div>

        <form action="" method="post" class="mt-2">
            <button name="logout" class="bg-red-500 text-white p-2 rounded-lg">Logout</button>
        </form>



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
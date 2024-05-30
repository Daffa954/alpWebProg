<?php
session_start();

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
            background-color: #ffd700 !important;
            backdrop-filter: blur(5px);
            box-shadow: 1px 1px 1px white;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <!-- navbar -->
    <header class="w-[100%] flex items-center z-10" style="background-color: #ffd700;">
        <div class="flex items-center relative justify-between w-full z-10 gap-10">
            <div class="flex flex-row gap-5">
                <div class="flex items-center px-4 bg-blue-200">
                    <div class="w-10 h-10  p-1.5 flex flex-col justify-around rounded z-40" id="hamburger">
                        <div class="bg-white h-1 w-full transition duration-300 origin-top-left"></div>
                        <div class="bg-white h-1 w-full transition duration-300"></div>
                        <div class="bg-white h-1 w-full transition duration-300 origin-bottom-left"></div>
                    </div>
                </div>

                <div class="bg-blue-200 w-[60%]">
                    <h1 class="font-bold text-2xl text-white  block py-5"><a href="">OurFood</a></h1>
                </div>
            </div>

            <div id="nav-menu"
                class="hidden py-5 absolute shadow-lg bg-[#ffd700] z-30 w-1/2 left-0 top-0 h-[100vh]  lg:w-[25%]">
                <ul class="items-center h-full flex flex-col justify-around">
                    <li class="group"><a href="home.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">Home</a></li>
                    <li class="group"><a href="add.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">My
                            add book</a>
                    </li>

                </ul>
            </div>

            <div class="bg-blue-200 px-8">
                <?php if (isset($_SESSION['email'])) { ?>
                    
                <?php } else { ?>
                    <div>
                        <a href="">sign in</a>/<a href="">sign up</a>
                    </div>
                <?php } ?>
            </div>

        </div>
    </header>
    <!-- navbar -->
    <div class="p-4 w-full">
        <form class="w-[45%]">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search Mockups, Logos..." required />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
    </div>

    <script>
        $('#hamburger').click(function () {
            $('#hamburger').toggleClass('active');
            $("#nav-menu").toggleClass('hidden')
        })

        $(window).scroll((function () {
            const fixedNav = document.querySelector('header').offsetTop;
            if (window.pageYOffset > fixedNav) {
                document.querySelector('header').classList.add("nav-fix")
            } else {
                document.querySelector('header').classList.remove("nav-fix")
            }
        }))
    </script>
</body>

</html>
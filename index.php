<?php?>
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
    <title>Document</title>
</head>
<body>
     <!-- navbar -->
     <header class="w-[100%] flex items-center z-10" style="background-color: #ffd700;">
        <div class="flex items-center justify-between relative  w-full">
            <div class="px-4">
                <h1 class="font-bold text-2xl text-white  block py-5"><a href="">Book Shop</a></h1>
            </div>
            <div id="nav-menu"
                class="hidden py-5 absolute shadow-lg bg-[#189AB4] z-30 w-[250px] right-0 top-0 h-[100vh] lg:h-full lg:bg-transparent lg:shadow-none lg:block lg:static lg:w-4/6">
                <ul class=" lg:flex lg:flex-row lg:justify-around items-center h-full flex flex-col justify-around">
                    <li class="group"><a href="home.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">Home</a></li>
                    <li class="group"><a href="add.php"
                            class="text-base text-white font-bold py-2 mx-8 group-hover:text-stone-200">My
                            add book</a>
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
<p>aa</p>
</body>
</html> 
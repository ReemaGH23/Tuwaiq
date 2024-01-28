<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$myDB = "e-commerce";
// Create connection
$conn = new mysqli($servername, $username, $password, $myDB);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
    
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Libre+Baskerville:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
    <!-- header -->
    <header class="p-3 navbar-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="assets/img/logo.png" alt="" width="40" height="32">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-left: auto; margin-right: 0 !important; padding-right: 15px; font-size: 20px;">
                    <li><a href="index.php" class="nav-link px-2 text-black">الرئيسية</a></li>
                    <li><a href="products.html" class="nav-link px-2 text-black">المنتجات</a></li>
                    <li><a href="#" class="nav-link px-2 text-black">العروض</a></li>
                    <li><a href="#" class="nav-link px-2 text-black">من نحن</a></li>
                    <li><a href="#" class="nav-link px-2 text-black">تواصل معنا</a></li>
                    <li><a href="Cart.html" class="nav-link px-2 text-warning"><strong>السلة</strong></a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="عن ماذا تبحث؟" aria-label="Search" style="background: transparent !important; border-color: black !important;">
                </form>

                <div class="text-end">
                    <button type="button" class="btn btn-warning"> تسجيل الدخول</button>
                </div>
            </div>
        </div>
    </header>
    </div>
    </section>

    <!-- your code -->
    <div class="login">
        <div class="wapper">
        <form action="SendPasswordReset.php" method="post">
    <h1>إعادة تعيين كلمة المرور </h1>

    <div class="input-box">
        <input type="email" placeholder="البريد الإلكتروني" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" id="email"  value="" required >
        <i class='bx bxs-user'></i>
    </div>
    
    <button type="submit" class="btn" name="submit" onclick="location.href ='SendPasswordReset.php';">إرسال </button>
</form>
        </div>
    </div>






    <!-- footer section -->
    <div class="container ">
        <footer class="py-3 my-4 ">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3 ">
                <li class="nav-item "><a href="home.html" class="nav-link px-2 text-body-secondary ">الرئيسية</a></li>
                <li class="nav-item "><a href="products.html" class="nav-link px-2 text-body-secondary ">المنتجات</a></li>
                <li class="nav-item "><a href="# " class="nav-link px-2 text-body-secondary ">العروض</a></li>
                <li class="nav-item "><a href="# " class="nav-link px-2 text-body-secondary ">من نحن</a></li>
                <li class="nav-item "><a href="# " class="nav-link px-2 text-body-secondary ">تواصل معنا</a></li>
            </ul>
            <p class="text-center text-body-secondary ">© 2023 Company, Inc</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js " integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz " crossorigin="anonymous "></script>
</body>

</html>

<?php
 include "../includes/DBConnection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>الصفحة الرئيسية</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Libre+Baskerville:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
    direction: rtl;
    font-family: 'Cairo', sans-serif !important;
    font-family: 'Libre Baskerville', serif !important;
        }
        .p-3 .nav-link.text-black{
            color: rgb(3, 56, 57) !important;
   }
   .p-3 .nav-link.text-warning{
    
    color: rgb(156, 148, 124) !important;
   }
   .p-3 .nav-link.text-warning:hover{
    color: rgb(3, 56, 57) !important;
   }
   .p-3 .nav-link.text-black:hover{
    color: rgb(156, 148, 124) !important;
   }
   .bxs-cart-alt:hover{
            color:#af9d80;
        }
        .bxs-cart-alt{
            color:#033135;
        }
        .btn-lg {
background-color:#033135;
        }
        .h1{
            color:#fff;
        }
        </style>
</head>

<body dir="rtl">
    <!-- header -->
    <header class="p-3 navbar-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="../assets/img/logo.png" alt="" width="40" height="32">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-left: auto; margin-right: 0 !important; padding-right: 15px; font-size: 20px;">
                        <li><a href="adminProfile.php" class="nav-link px-2 text-black">معلومات حسابي</a></li>
                        <li><a href="Display_productNew.php" class="nav-link px-2 text-black">ادارة المنتجات</a></li>
                        <li><a href="Orders_DisplayAll.php" class="nav-link px-2 text-black">طلبات العملاء</a></li>
                        <li><a href="Categories_dispalyAll.php" class="nav-link px-2 text-black">تصنيف المنتجات</a></li>
                        <li><a href="Offers.php" class="nav-link px-2 text-black">العروض</a></li>
                        <li><a href="Coupons_dispalyAll.php" class="nav-link px-2 text-black">الكوبونات</a></li>
                        <li><a href="Slider_dispalyAll.php" class="nav-link px-2 text-warning"><strong>الخلفيات</strong></a></li>
                </ul>
                <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)  {
                        echo '<div class="text-end">
                                <button type="button" class="btn btn-warning" onclick="location.href=\'customerProfile.php\'" style="margin-left: 1rem; background-color: #af9d80; border:none; color:#ffff;">حسابي</button>
                            </div>';
                    } else {
                        echo '<div class="text-end">
                                <button type="button" class="btn btn-warning" onclick="location.href=\'login.php\'" style="margin-left: 1rem; background-color: #af9d80; border:none; color:#ffff;">تسجيل الدخول</button>
                            </div>';
                    } ?>
            </div>
        </div>
    </header>
    <!-- shop section -->
    <section id=shopping>
        <div class="album py-5 bg-body-tertiary slide " style="color:#af9d80;">
            <div class="container ">
                <h1>إضافة صورة جديدة</h1><br>
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 g-3 ">
                <form class="row"  action="Slider_Handlar.php" method="post" enctype="multipart/form-data">

                    <div class="boxs col-md-6" >
                        <div class="form-group" >
                            <label for="name" > عنوان الصورة</label>
                            <input class="form-control" type="text" id="name" name="name" style="border-radius: 15px" required="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="img">صورة </label> 
                            <input class="form-control" type="file" id="image" name="image" accept=".jpg, .jpeg, .png" style="border-radius: 15px" required="" value="Upload">
                        </div>
                    </div>

                    <div class="col-md-6" style="align-items: center;">
                        <button class="btn btn-dark btn-lg px-4 me-md-2" style=" margin-top: 10%; " 
                        type="submit"  >إضافة</button>
                    </div>
                    

                </form>
                </div>

            
            </div>
        </div>
    </section>

    <!-- footer section -->
    <div class="container ">
        <footer class="py-3 my-4 ">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3 " > 
                <li class="nav-item "><a href="index.php" class="nav-link px-2 text-body-secondary ">الرئيسية</a></li>
                <li class="nav-item "><a href="products.php" class="nav-link px-2 text-body-secondary ">المنتجات</a></li>
                <li class="nav-item "><a href="sales.php" class="nav-link px-2 text-body-secondary ">العروض</a></li>
                <li class="nav-item "><a href="index.php.#about-us " class="nav-link px-2 text-body-secondary ">من نحن</a></li>
                <li class="nav-item "><a href="index.php.#contact-us" class="nav-link px-2 text-body-secondary ">تواصل معنا</a></li>
            </ul>
            <p class="text-center text-body-secondary ">© 2023 bena Company, Inc</p>
        </footer>
    </div>




    </body>

</html>
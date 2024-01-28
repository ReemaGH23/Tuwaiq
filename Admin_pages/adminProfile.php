<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>حسابي</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Libre+Baskerville:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="..\assets\css\styles.css">
    <style>
        .profile .container {
            margin-top: 3rem;
            margin-bottom: 3rem;
            padding-top: 3rem;
            padding-bottom: 3rem;
            color: rgb(3, 56, 57) !important;
        }
        
        .profile button {
            margin-top: 50px !important;
            color: #033135;
            border-radius: 6px;
            border: none;
            color:#ffff;
        }
        
        .profile button:hover {
            background-color:#af9d80;
            color:#ffff;
            
            ;
        }
        
        .profile h1 {
            margin-bottom: 50px;
            color:#af9d80;
            ;
        }
        .bxs-cart-alt:hover{
            color:#af9d80;
        }
        .mb-4 {
            color:#033135;
        }
        .display-5 {
            color:#af9d80;
        }
        .btn-warning{
            color:#ffff;
        }
        .btn-lg {
background-color:#033135;
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
   .display-5{
     color:#af9d80;"
   }
  
    </style>
</head>

<body>
    <?php include '../Admin_pages/Admin_accDB.php';
    if (isset($_POST['signout'])) {
        // Set the value of $_SESSION['loggedin'] to false
        $_SESSION['loggedin'] = false;
        // Unset all of the other session variables
        session_unset();
        // Redirect to the home page
        header("location: ../index.php");
        exit;
    } ?>
    <!-- header -->
    <header class="p-3 navbar-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="../assets/img/logo.png" alt="" width="40" height="32">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-left: auto; margin-right: 0 !important; padding-right: 15px; font-size: 20px; ">
                        <li><a href="#" class="nav-link px-2 text-warning"><strong>معلومات حسابي</strong> </a></li>
                        <li><a href="Display_productNew.php" class="nav-link px-2 text-black">ادارة المنتجات</a></li>
                        <li><a href="Orders_DisplayAll.php" class="nav-link px-2 text-black">طلبات العملاء</a></li>
                        <li><a href="Categories_dispalyAll.php" class="nav-link px-2 text-black">تصنيف المنتجات</a></li>
                        <li><a href="Offers.php" class="nav-link px-2 text-black">العروض</a></li>
                        <li><a href="Coupons_dispalyAll.php" class="nav-link px-2 text-black">الكوبونات</a></li>
                        <li><a href="Slider_DisplayAll.php" class="nav-link px-2 text-black">الخلفيات</a></li>
                </ul>

            </div>
        </div>
    </header>
    </div>
    </section>

    <!-- profile -->
    <div class="profile">
        <div class="container">
            <h1 class="display-5" >حسابي</h1>
            <div class="col-md-7 col-lg-8">
                <form class="needs-validation" action="../Admin_pages/Admin_accDB.php" method="post" novalidate="">
                    <div class="row g-3">

                        <div class="col-sm-4">
                            <label for="account-fn" class="form-label">الاسم الأول</label>
                            <input type="text" class="form-control" id="account-fn" name="account-fn" placeholder="" value="<?php echo $Fristname; ?>" required="">
                        </div>

                        <div class="col-sm-4">
                            <label for="account-mn" class="form-label">اسم الاب</label>
                            <input type="text" class="form-control" id="account-mn" name="account-mn" placeholder="" value="<?php echo $Middlename; ?>" required="">
                        </div>

                        <div class="col-sm-4">
                            <label for="account-ln" class="form-label">اسم العائلة</label>
                            <input type="text" class="form-control" id="account-ln" name="account-ln"placeholder="" value="<?php echo $Lastname; ?> " required="">
                        </div>

                        <div class="col-12">
                            <label for="account-phone" class="form-label">رقم الجوال</label>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control" id="account-phone" name="account-phone" placeholder="" value="<?php echo $phone; ?>" required="">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="account-email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="account-email" name="account-email" placeholder="" value="<?php echo $email; ?>">
                        </div>

                        <div class="col-12">
                            <label for="username" class="form-label">اسم المستخدم</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="" value="<?php echo $Username; ?>" required="">
                        </div>

                        <div class="col-12">
                            <label for="pass" class="form-label">الرقم السري</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="<?php echo $pass; ?>" value="382940SDV">
                        </div>
                    </div>
                    <button class="w-100 btn btn-primary btn-lg" type="submit" name="edit" style="margin-top: 20px;">تعديل معلومات الحساب</button>
                </form>
                <div class="text-end">
               <form method="post">
                <button type="submit" name="signout" class="w-100 btn btn-primary btn-lg"style="margin-top: 20px; !important">تسجيل الخروج</button>
               </form>
            </div>
            </div>
        </div>
    </div>





    <!-- footer section -->
    <div class="container ">
        <footer class="py-3 my-4 ">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3 ">
            <li class="nav-item "><a href="" class="nav-link px-2 text-body-secondary ">حساب المدير</a></li>
            </ul>
            <p class="text-center text-body-secondary ">© 2023 bena Company, Inc</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js " integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz " crossorigin="anonymous "></script>
</body>

</html>
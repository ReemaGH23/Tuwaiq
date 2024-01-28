<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>حسابي</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Libre+Baskerville:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .profile .container {
            margin-top: 3rem;
            margin-bottom: 3rem;
            padding-top: 3rem;
            padding-bottom: 3rem;
            color: rgb(255, 193, 7);
        }
        
        .profile button {
            margin-top: 50px !important;
            background-color: rgb(255, 193, 7);
            border-radius: 6px;
            border: none;
            color: black;
        }
        
        .profile button:hover {
            background-color: rgb(255, 213, 87);
            
        }
        
        .profile h1 {
            margin-bottom: 50px;
            color: rgb(255, 193, 7);
            
        }
        
    </style>
</head>

<body>
<?php include 'Customer_accDB.php'; ?>
    <!-- header -->
    <header class="p-3 navbar-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="assets/img/logo.png" alt="" width="40" height="32">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-left: auto; margin-right: 0 !important; padding-right: 15px; font-size: 20px; ">
                    <li><a href="index.php" class="nav-link px-2 text-black ">الرئيسية</a></li>
                    <li><a href="index.php.#shopping" class="nav-link px-2 text-black ">المنتجات</a></li>
                    <li><a href="sales.php" class="nav-link px-2 text-black">العروض</a></li>
                    <li><a href="index.php.#about-us" class="nav-link px-2 text-black">من نحن</a></li>
                    <li><a href="index.php.#contact-us" class="nav-link px-2 text-black">تواصل معنا</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" style="margin-left: 1rem;">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="عن ماذا تبحث؟" aria-label="Search" style="background: transparent !important; border-color: black !important;">
                </form>

                <div class="text-end">
                    <button type="button" class="btn btn-outline-dark me-2"><strong>حسابي</strong></button>
                </div>
                <a href="cart.php" style="hover-color: rgb(255, 193, 7); color: black"><i class='bx bxs-cart-alt' style="font-size: 30px;"></i></a>
            </div>
        </div>
    </header>
    </div>
    </section>


    <?php
// Start the session

if (isset($_POST['signout'])) {
    // Set the value of $_SESSION['loggedin'] to false
    $_SESSION['loggedin'] = false;

    // Unset all of the other session variables
    session_unset();

    // Redirect to the home page
    header("location: index.php");
    exit;
}
?>
    <!-- profile -->
    <div class="profile">
        <div class="container">
            <h1 class="display-5 fw-bold text-body-emphasis">حسابي</h1>
            <div class="col-md-7 col-lg-8">
                <form class="needs-validation" action="Customer_accDB.php" method="post" novalidate="">
                    <div class="row g-3">

                        <div class="col-sm-4">
                            <label for="account-fn" class="form-label" style="font-size:18px;color:black">الاسم الأول</label>
                            <input type="text" class="form-control" id="account-fn" name="account-fn" placeholder="" value="<?php echo $Fristname; ?>" required="">
                        </div>

                        <div class="col-sm-4">
                            <label for="account-mn" class="form-label"  style="font-size:18px;color:black">اسم الاب</label>
                            <input type="text" class="form-control" id="account-mn" name="account-mn" placeholder="" value="<?php echo $Middlename; ?>" required="">
                        </div>

                        <div class="col-sm-4">
                            <label for="account-ln" class="form-label"  style="font-size:18px;color:black">اسم العائلة</label>
                            <input type="text" class="form-control" id="account-ln" name="account-ln" placeholder="" value=" <?php echo $Lastname; ?>" required="">
                        </div>

                        <div class="col-12">
                            <label for="account-phone" class="form-label"  style="font-size:18px;color:black">رقم الجوال</label>
                            <div class="input-group has-validation"> 
                                <input type="text" class="form-control" id="account-phone" name="account-phone" placeholder="" value="<?php echo $phone; ?>" required="">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="account-email" class="form-label"  style="font-size:18px;color:black">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="account-email" name="account-email" placeholder="" value="<?php echo $email; ?>">
                        </div>


                        <div class="col-12">
                            <label for="pass" class="form-label"  style="font-size:18px;color:black">الرقم السري</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="" value="<?php echo $pass; ?>">
                        </div>
                    </div>
                    <button class="w-100 btn btn-primary btn-lg" type="submit" style="margin-top: 20px;  background-color:#af9d80; color:#ffff; border:2px #af9d80;" name="edit" >تعديل معلومات الحساب</button>
                </form>

          
        <div class="text-end">
             <form method="post">
                <button type="submit" name="signout" class="w-100 btn btn-primary btn-lg"style=" background-color:#af9d80; color:#ffff; border:2px #af9d80;">تسجيل الخروج</button>
            </form>
            </div>
            </div>
            </div>
            </div>







    <!-- footer section -->
          <!-- footer section -->
          <div class="container ">
        <footer class="py-3 my-4 ">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3 ">
                <li class="nav-item "><a href="index.php" class="nav-link px-2 text-body-secondary ">الرئيسية</a></li>
                <li class="nav-item "><a href="products.php" class="nav-link px-2 text-body-secondary ">المنتجات</a></li>
                <li class="nav-item "><a href="sales.php" class="nav-link px-2 text-body-secondary ">العروض</a></li>
                <li class="nav-item "><a href="index.php.#about-us " class="nav-link px-2 text-body-secondary ">من نحن</a></li>
                <li class="nav-item "><a href="index.php.#contact-us" class="nav-link px-2 text-body-secondary ">تواصل معنا</a></li>
            </ul>
            <p class="text-center text-body-secondary " >© 2023 bena Company, Inc</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js " integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz " crossorigin="anonymous "></script>
</body>

</html>
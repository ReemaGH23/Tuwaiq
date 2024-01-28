<?php 
 include "includes/DBConnection.php";

$token = $_GET["token"];

$token_hash = hash("sha256", $token);


$sql = "SELECT * FROM customer
        WHERE reset_token_hash = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
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
                    <li><a href="index.php" class="nav-link px-2 text-black ">الرئيسية</a></li>
                    <li><a href="products.php" class="nav-link px-2 text-warning"><strong>المنتجات</strong></a></li>
                    <li><a href="sales.php" class="nav-link px-2 text-black">العروض</a></li>
                    <li><a href="index.php.#about-us" class="nav-link px-2 text-black">من نحن</a></li>
                    <li><a href="index.php.#contact-us" class="nav-link px-2 text-black">تواصل معنا</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="عن ماذا تبحث؟" aria-label="Search" style="background: transparent !important; border-color: black !important;">
                </form>

                <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)  {
                        echo '<div class="text-end">
                                <button type="button" class="btn btn-warning" onclick="location.href=\'customerProfile.php\'" style="margin-left: 1rem;">حسابي</button>
                            </div>';
                    } else {
                        echo '<div class="text-end">
                                <button type="button" class="btn btn-warning" onclick="location.href=\'login.php\'" style="margin-left: 1rem;>تسجيل الدخول</button>
                            </div>';
                    } ?>
                 <a href="cart.php" style="hover-color: rgb(255, 193, 7); color: black"><i class='bx bxs-cart-alt' style="font-size: 30px;"></i></a>
            </div>
        </div>
    </header>
    </div>
    </section>

    <!-- your code -->
    <div class="login">

        <div class="wapper">
        <form method="post" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <div class="input-box">
        <input type="text" placeholder=" كلمة المرور الجديدة " name="password" id="password"  value="" required >
        </div>

        <div class="input-box">
        <input type="text" placeholder=" تأكيد كلمة المرور الجديدة " name="password_confirmation" id="password"  value="" required >
        </div>

        
    <button type="submit" class="btn" name="submit" >تعيين </button>
    </form>

        </div>
    </div>






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
            <p class="text-center text-body-secondary ">© 2023 Company, Inc</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js " integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz " crossorigin="anonymous "></script>
</body>

</html>
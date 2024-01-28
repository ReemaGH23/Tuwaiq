<?php 
 
 include "includes/DBConnection.php";

 $customer_id= $_SESSION['customer_id'];
?>
<!DOCTYPE html>
<html>
<!-- Latest compiled and minified CSS -->

<head>
<meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/Cart.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  

  <title>سلة التسوق</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 
<style>
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
            background-color:#af9d80;
            border:none;
           
        }
        .btn-lg {
background-color:#033135;

        }
        .btn-lg:hover{
background-color:#af9d80;

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
 

   .btn.btn-secondary{
    background-color:#033135;
    color:#ffff;

}
.btn.btn-success{
background-color:#af9d80;
    color:#ffff;
}
.btn.btn-danger{
background-color:#af9d80;
    color:#ffff;
}
li {
  color: #af9d80;
  display: inline-block;
  padding: 0.625rem 0;
  
}
</style>
</head>

<body dir="rtl">
    
   <!-- header -->
   <header class="p-3 navbar-dark" dir="rtl">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img src="assets/img/logo.png" alt="" width="40" height="32">
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-left: auto; margin-right: 0 !important; padding-right: 15px; font-size: 20px;">
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
                <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)  {
                        echo '<div class="text-end">
                                <button type="button" class="btn btn-warning" onclick="location.href=\'customerProfile.php\'" style="margin-left: 1rem;">حسابي</button>
                            </div>';
                    } else {
                        echo '<div class="text-end">
                                <button type="button" class="btn btn-warning" onclick="location.href=\'login.php\'" style="margin-left: 1rem;">تسجيل الدخول</button>
                            </div>';
                    }
                   ?>
                </div>
                <a href="cart.php" style="color: rgb(255, 193, 7) !important;"><i class='bx bxs-cart-alt' style="font-size: 30px;"></i></a>
        </div>
    </div>
</header>

  <div class="container" style="margin-top:5%;">
    <div class="row">
      <div class="jumbotron ">
      <center>
      <img src="assets/img/Successful_order.jpg"  style=" width:150px;">
     </center>
        <h2 class="text-center">شكرا لطلبك معنا</h2>
        <h3 class="text-center">تم تاكيد طلبك بنجاح </h3>
       
        <p class="text-center" style="color:grey;">رمز طلبك هو <strong># <?php echo $_SESSION["order_id"];?></strong></p>
        <center>
          <div class="btn-group" style="margin-top:50px; ">
            <a href="products.php" class="btn btn-lg btn-warning" style="color:#ffff; ">الاستمرار بالتسوق</a>
          </div>
        </center>
      </div>
    </div>
  </div>

  <!-- footer section -->
  <div class="Container ">
    <footer class="py-3 my-4 ">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3 ">
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
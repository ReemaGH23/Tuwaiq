<?php 
 include "includes/DBConnection.php";

 // Prepare the SQL query
$stmt = mysqli_prepare($conn, "SELECT * FROM product ;");
// Execute the query
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>الصفحة الرئيسية</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
   .btn.btn-warning{
    background-color:#fff;
   }
   
        
    </style>
</head>

<body>
    <!-- header -->
    <header class="p-3 navbar-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="assets/img/logo.png" alt="" width="45" height="45"  >
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-left: auto; margin-right: 0 !important; padding-right: 15px; font-size: 20px; ">
                    <li><a href="index.php" class="nav-link px-2 text-warning" ><strong>الرئيسية</strong></a></li>
                    <li><a href="#shopping" class="nav-link px-2 text-black">المنتجات</a></li>
                    <li><a href="#sales" class="nav-link px-2 text-black">العروض</a></li>
                    <li><a href="#about-us" class="nav-link px-2 text-black">من نحن</a></li>
                    <li><a href="#contact-us" class="nav-link px-2 text-black">تواصل معنا</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" style="margin-left: 1rem;">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="عن ماذا تبحث؟" aria-label="Search" style="background: transparent !important; border-color:#003b3a; !important;">
                </form>
               
                <div class="text-end">
                <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)  {
                        echo '<div class="text-end">
                                <button type="button" class="btn btn-warning" onclick="location.href=\'customerProfile.php\'" style="margin-left: 1rem; background-color: #af9d80; border:none; color:#ffff; ">حسابي</button>
                            </div>';
                    } else {
                        echo '<div class="text-end">
                                <button type="button" class="btn btn-warning" onclick="location.href=\'login.php\'" style="margin-left: 1rem;  !important; background-color: #af9d80; border:none; color:#ffff;">تسجيل الدخول</button>
                            </div>';
                    } ?>
                </div>
                <a href="cart.php" style=" color: #033135;" ><i class='bx bxs-cart-alt' style="font-size: 30px;" ></i></a>

            </div>
        </div>
    </header>


    <!-- slider -->
    <section id="slider">
        <div id="carouselExampleDark" class="carousel carousel-dark" style="max-height: 90vh !important; overflow: hidden !important;">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <?php // Prepare the SQL query
                        $stmt2 = mysqli_prepare($conn, "SELECT * FROM slider ;");
                        // Execute the query
                        mysqli_stmt_execute($stmt2);
                        $result2 = mysqli_stmt_get_result($stmt2);
                        
                        while($row2 = mysqli_fetch_assoc($result2)){ 
                ?>
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="Admin_Pages/uploads/<?php echo $row2['image_path']; ?>" class="d-block w-100 sliderImg" alt="...">
                </div>
                <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
        </div>
    </section>


    
    <!-- sales section -->
    <section id="sales" >
        <div class="container">
            <div class="px-4 py-5 my-5 text-center">
                <img class="d-block mx-auto mb-4"  src="assets/img/discount.png" alt=" " width="100" height="100" >
                <h1 class="display-5  ">لا تفوت عروضنا</h1>
                <div class="col-lg-6 mx-auto " >
                    <p class="lead mb-4 " >تخفيضات ولفترة محدودة من 20% الى 70% لا تضيعها واضغط المزيد</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center " >
                        <button type="button " class="btn btn-warning btn-lg px-4 gap-3 " style="background-color:#033135; border:none;"  ><a href="sales.php" style="color:#ffff; text-decoration: none;">المزيد</a></button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- shop section -->
    <section id=shopping>
        <div class="album py-5 bg-body-tertiary slide ">
            <div class="container ">
                <h1>المنتجات</h1><br>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 ">
                    <?php $i=0;
                         while($row = mysqli_fetch_assoc($result)){  
                            if($i<3) {
                                $product_id = $row['Product_id'];
                                if($row['Offer_id']!=0)
                                    continue;
                                // Prepare the SQL query
                                $stmt3 = mysqli_prepare($conn, "SELECT * FROM images WHERE Product_id='$product_id' AND main_image='1';");
                                // Execute the query
                                mysqli_stmt_execute($stmt3);
                                $result3 = mysqli_stmt_get_result($stmt3);
                                $row3 = mysqli_fetch_assoc($result3); 
                                ?>
                    <div class="col ">
                        <div class="card shadow-sm ">
                            <img src="Admin_Pages/uploads/<?php  echo $row3['Image_path'];  ?>" alt=" " class="homeImg ">
                            <div class="card-body ">
                                <p class="card-text "><?php  echo $row['title'];?></p>
                                <div class="d-flex justify-content-between align-items-center ">
                                    <div class="btn-group ">
                                        <form action="productDetails.php" method="POST"> 
                                            <input type="hidden" name="Product_id" value="<?php  echo $row['Product_id'];?>"/>
                                            <button type="submit" class="btn btn-sm btn-warning " style="background-color:#033135; border:none  " name="details">تفاصيل</button>
                                        </form>
                                    </div>
                                    <small class="text-body-secondary "><?php  echo $row['Price'];?> SAR</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++;   }else
                                  break; } ?>
                </div>
                <div style="display: flex; align-items: center; justify-content: center; margin-top: 30px; ">
                    <button type="button" class="btn btn-dark btn-lg px-4 me-md-2 "><a href="products.php" style="color:white; text-decoration: none; background-color:#033135;">المزيد</a></button>
                </div>
            </div>
        </div>
    </section>
        <!-- about us section -->
        <div id="about-us" class="about-us" Style="background-color:#033135;">
        <div class="container" Style="background-color:#033135; color:#ccc;">
            <div class="row featurette">
                <div class="col-md-9 text" >
                    <h1 class="display-5  " >من نحن؟</h1>
                    <p class="lead">محل بيع اجهزة كهربائية من افضل محلات بيع الاجهزة في الشرق الاوسط ولدينا 40 فرع حول العالم هدفنا الاول والاخير الحصول على راحة العميل ولضمان جودة المنتجات يمكن استرجاع المنتج بعد سنة من استخدامه في حال وجود اي تغيرات</p>
                </div>
                <div class="col-md-3" >
                    <img src="assets/img/logo.png" alt="" width="250" height="250">
                </div>
            </div>
        </div>
    </div>

    <!-- contact us section -->
    <div id="contact-us" class="contact-us" Style="color:#033135;">
        <div class="container">
            <div class="content">
                <div class="left-side">

                    <div class="assrass details">
                        <i class='bx bxs-map' Style="color:#af9d80;"></i>
                        <div class="topic">العنوان</div>
                        <div class="text-one">جدة. حي الروضة</div>
                    </div>

                    <div class="phone details">
                        <i class='bx bxs-phone'Style="color:#af9d80;" ></i>
                        <div class="topic">رقم الجوال</div>
                        <div class="text-one">+966 5555 5555</div>
                    </div>

                    <div class="email details">
                        <i class='bx bxs-envelope' Style="color:#af9d80;"></i>
                        <div class="topic">البريد الالكتروني</div>
                        <div class="text-one">Bete2023@gmail.com</div>
                        <div class="text-two"></div>
                    </div>

                </div>
                <div class="right-side">
                    <div class="topic-text" Style="color:#af9d80;">تواصل معنا</div>
                    <form action="#" method = "post">
                        <div class="input-box">
                            <input type="text" id ="name" name ="name" placeholder="الاسم" required>
                        </div>
                        <div class="input-box">
                            <input type="text" id ="email" name="email" placeholder="الايميل" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        </div>
                        <div class="input-box message-box">
                        <textarea id="message" name="message" required></textarea>
                        </div>
                        <div class="button">
    <input type="submit" name="submit" value="ارسال" style = " background-color: #033135 ;
  color: #ffff;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 4px


"
 required>
  </div>


                    </form>
                </div>
            </div>
           
 <?php

  require 'includes/PHPMailer.php';
  require 'includes/SMTP.php';
  require 'includes/Exception.php';
 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

try {
  $mail = new PHPMailer(true);

  // Email sending code
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'bena.customerservices@gmail.com';
  $mail->Password = 'acmabquermxpblcp';
  $mail->SMTPSecure = 'tls';
  $mail->Port = '587';

  $mail->setFrom('bena.customerservices@gmail.com');
  $mail->addAddress('bena.customerservices@gmail.com');

  $mail->isHTML(true);
  $mail->Subject = "Message sent from Clinet in BENA website";
  $mail->Body = "Name: $name<br>Email: $email<br>Message: $message";

  $mail->send();

  
} catch (Exception $e) {
  echo 'Message could not be sent. Error: ', $mail->ErrorInfo;
  exit();
}
}

            ?>
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
            <p class="text-center text-body-secondary ">© 2023 bena Company, Inc</p>
        </footer>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js " integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz " crossorigin="anonymous "></script>
</body>

</html>
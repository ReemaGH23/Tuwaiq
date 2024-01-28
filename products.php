<?php 
 include "includes/DBConnection.php";


 $stmt4 = mysqli_prepare($conn, "SELECT * FROM category ;");
 // Execute the query
 mysqli_stmt_execute($stmt4);
 $result4 = mysqli_stmt_get_result($stmt4);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>المنتجات</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Libre+Baskerville:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
     <!-- header -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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
            background-color:#033135;
            border:none;
           
        }
        .btn-warning:hover{
            color:#ffff;
            background-color:#af9d80;
            border:none;
           
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
 

   .btn.btn-secondary{
    background-color:#033135;
    color:#ffff;

}
.btn.btn-success{
background-color:#af9d80;
    color:#ffff;
}


        .applybtn{
            background-color: rgb(255, 193, 7);
            color: white;
            border-style: none;
            border-radius: 6px;
            width: 75px;
            height: 36px;
            cursor: pointer;
            font-weight: bold;
            font-size: 15px;
            margin-left: 20px;
        }
    </style>
</head>

<body>
     <!-- header -->
     <header class="p-3 navbar-dark">
        <div class="container" >
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="assets/img/logo.png" alt="" width="45" height="45">
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-left: auto; margin-right: 0 !important; padding-right: 15px; font-size: 20px;">
                    <li><a href="index.php" class="nav-link px-2 text-black ">الرئيسية</a></li>
                    <li><a href="index.php.#shopping" class="nav-link px-2 text-warning"><strong>المنتجات</strong></a></li>
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
                    } ?>
                </div>

                <a href="cart.php" style="hover-color:#af9d80; color:#033135; "><i class='bx bxs-cart-alt' style="font-size: 30px;"></i></a>

            </div>
        </div>
    </header>
   



    <!-- shop section -->
    <section id=shopping>
        <div class="album py-5 bg-body-tertiary slide ">
            <div class="container ">
                <h1>المنتجات</h1><br>

                <form action="" method="POST">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                        تصفية المنتجات
                        </div>
                        <ul class="list-group list-group-flush">
                        <?php   while($row4 = mysqli_fetch_assoc($result4)){   
                                $checked=[]; 
                                if(isset($_POST['category'])){
                                    $checked[]=$_POST['category'];
                                }
                                ?>
                            <li class="list-group-item"> 
                            <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" style="text-align: right" value="<?php echo $row4['category_id'];?>"id="flexSwitchCheckDefault" name="category" 
                                    <?php 
                                    if(in_array($row4['category_id'],$checked)){
                                        echo "checked";
                                    }
                                    ?>
                                    />
                                    <label class="form-check-label" for="flexSwitchCheckDefault">
                                    <?php echo $row4['category_name'];?>
                                    </label>
                            </div>
                                
                            </li>
                            <?php } ?>
                            <li class="list-group-item"> 
                            <button type="submit" class="applybtn" style="       background-color:#af9d80;">تطبيق</button>
                            <button type="submit" class="applybtn" style="       background-color:#033135;"onclick='window.location.reload();'>الغاء </button>
                            </li> 
                        </ul>
                    </div>
                    </form>

                    <br><br>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 ">

                
                <?php  
                                        if(isset($_POST['category'])){
                                            $rowcate= implode(',', $checked);

                                            // Prepare the SQL query
                                            $stmt = mysqli_prepare($conn, "SELECT * FROM product WHERE category_id IN ($rowcate) ;");
                                            // Execute the query
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);
                                        while($row = mysqli_fetch_assoc($result)){   
                                            $product_id = $row['Product_id'];
                                            // Prepare the SQL query
                                            $stmt2 = mysqli_prepare($conn, "SELECT * FROM images WHERE Product_id='$product_id' AND main_image='1';");
                                            // Execute the query
                                            mysqli_stmt_execute($stmt2);
                                            $result2 = mysqli_stmt_get_result($stmt2);
                                            $row2 = mysqli_fetch_assoc($result2);
                                            $offer = $row['Offer_id'];
                                        if($offer== 0){?>

                
                    <div class="col ">
                        <div class="card shadow-sm ">
                            <img src="Admin_pages/uploads/<?php  echo $row2['Image_path'];  ?>" alt=" " class="homeImg ">
                            <div class="card-body ">
                                <p class="card-text "><?php  echo $row['title'];?></p>
                                <h10 class="text-body-secondary before">-</h10>
                                <div class="d-flex justify-content-between align-items-center ">
                                    <h5 class="after"><?php  echo $row['Price'];?> SAR</h5>
                                    <div class="btn-group ">
                                    <form action="ProductDetails.php" method="POST"> 
                                        <button type="button " class="btn btn-sm btn-warning " name="details">تفاصيل</button>
                                        <input type="hidden" name="Product_id" value="<?php  echo $row['Product_id'];?>"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }else{    $stmt3 = mysqli_prepare($conn, "SELECT value FROM offers WHERE Offer_id='$offer';");
                                    mysqli_stmt_execute($stmt3);
                                    $result3 = mysqli_stmt_get_result($stmt3);
                                    $row3 = mysqli_fetch_assoc($result3); 
                                    $value = $row3['value'];
                                    $after_price = $row['Price']-(($value*0.01)*$row['Price']);?>
                         <div class="col ">
                    <!-- <div class="percentage">عرض</div>-->
                        <div class="card shadow-sm ">
                          <a href="productDetails.html"><img src="assets/img/<?php  echo $row2['Image_path'];  ?>" alt=" " class="homeImg "></a>
                            <div class="card-body ">
                                <p class="card-text "><?php  echo $row['title'];?></p>
                                <h10 class="text-body-secondary before"><?php  echo $row['Price'];?> SAR</h10>
                                <div class="d-flex justify-content-between align-items-center ">
                                    <h5 class="after" style="color:red;"><?php  echo $after_price;?> SAR</h5>
                                    <div class="btn-group ">
                                        <form action="ProductDetails.php" method="POST"> 
                                            <input type="hidden" name="Product_id" value="<?php  echo $row['Product_id'];?>"/>
                                            <button type="submit" class="btn btn-sm btn-warning " name="details">تفاصيل</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 <?php   }  }}else{
                                        // Prepare the SQL query
                                        $stmt = mysqli_prepare($conn, "SELECT * FROM product ;");
                                        // Execute the query
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);
                                        while($row = mysqli_fetch_assoc($result)){   
                                        $product_id = $row['Product_id'];
                                        // Prepare the SQL query
                                        $stmt2 = mysqli_prepare($conn, "SELECT * FROM images WHERE Product_id='$product_id' AND main_image='1';");
                                        // Execute the query
                                        mysqli_stmt_execute($stmt2);
                                        $result2 = mysqli_stmt_get_result($stmt2);
                                        $row2 = mysqli_fetch_assoc($result2);
                                        $offer = $row['Offer_id'];
                                        if($offer== 0){?> 
                                        <div class="col ">
                        <div class="card shadow-sm ">
                            <img src="Admin_Pages/uploads/<?php  echo $row2['Image_path'];  ?>" alt=" " class="homeImg ">
                            <div class="card-body ">
                                <p class="card-text "><?php  echo $row['title'];?></p>
                                <h10 class="text-body-secondary before">-</h10>
                                <div class="d-flex justify-content-between align-items-center ">
                                    <h5 class="after"><?php  echo $row['Price'];?> SAR</h5>
                                    <div class="btn-group ">
                                        <form action="ProductDetails.php" method="POST"> 
                                            <input type="hidden" name="Product_id" value="<?php  echo $row['Product_id'];?>"/>
                                            <button type="submit" class="btn btn-sm btn-warning " name="details">تفاصيل</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }else{    $stmt3 = mysqli_prepare($conn, "SELECT value FROM offers WHERE Offer_id='$offer';");
                                    mysqli_stmt_execute($stmt3);
                                    $result3 = mysqli_stmt_get_result($stmt3);
                                    $row3 = mysqli_fetch_assoc($result3); 
                                    $value = $row3['value'];
                                    $after_price = $row['Price']-(($value*0.01)*$row['Price']);?>
                         <div class="col ">
                    <!--<div class="percentage">عرض</div>-->
                        <div class="card shadow-sm ">
                          <a href="productDetails.html"><img src="Admin_Pages/uploads/<?php  echo $row2['Image_path'];  ?>" alt=" " class="homeImg "></a>
                            <div class="card-body ">
                                <p class="card-text "><?php  echo $row['title'];?></p>
                                <h10 class="text-body-secondary before"><?php  echo $row['Price'];?> SAR</h10>
                                <div class="d-flex justify-content-between align-items-center ">
                                    <h5 class="after" style="color:red;"><?php  echo $after_price;?> SAR</h5>
                                    <div class="btn-group ">
                                        <form action="ProductDetails.php" method="POST"> 
                                            <input type="hidden" name="Product_id" value="<?php  echo $row['Product_id'];?>"/>
                                            <button type="submit" class="btn btn-sm btn-warning " name="details">تفاصيل</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } }} ?>
                </div>
            </div>
        </div>
    </section>

   
                

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


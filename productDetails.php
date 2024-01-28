<?php  
include "includes/DBConnection.php";

if(isset($_POST['details'])){
    $_SESSION['product_id']=  $_POST["Product_id"];
}
   $product_id = $_SESSION['product_id'];

//add product
if(isset($_POST['addcart'])){
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)  {
        $customer_id= $_SESSION['customer_id'];
        $quantity = $_POST["quantity"]; 
        //check if product already exists in the cart
        $sql_check = $conn->prepare("SELECT * FROM order_items WHERE Product_id = ? AND order_id = ?");
        $sql_check->bind_param("ii", $product_id, $customer_id);
        $sql_check->execute();
        $result_check = $sql_check->get_result();
        if($result_check->num_rows > 0) {
            //update quantity
            $row = $result_check->fetch_assoc();
            $new_quantity = $row["quantity"] + $quantity;
            $sql_update = $conn->prepare("UPDATE order_items SET quantity = ? WHERE Product_id = ? AND order_id = ?");
            $sql_update->bind_param("iii", $new_quantity, $product_id, $customer_id);
            $sql_update->execute();
            
        } else {
            //add new product
            $sql_insert = $conn->prepare("INSERT INTO order_items (`Product_id`, `order_id`, `quantity`)  VALUES (?, ?, ?)");  
            $sql_insert->bind_param("iii", $product_id, $customer_id, $quantity);
            $sql_insert->execute();
        }
      
    } else {
        echo "<script> alert('يجب عليك تسجيل الدخول'); </script>";
        header('location:Must_login.php');
    } 
}

// Prepare the SQL query
$stmt = mysqli_prepare($conn, "SELECT * FROM product WHERE Product_id='$product_id';");
// Execute the query
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

// Prepare the SQL query
$stmt2 = mysqli_prepare($conn, "SELECT * FROM images WHERE Product_id='$product_id' AND main_image='1';");
// Execute the query
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
$row2 = mysqli_fetch_assoc($result2);

// Prepare the SQL query
$stmt3 = mysqli_prepare($conn, "SELECT * FROM images WHERE Product_id='$product_id' AND main_image='0';");
// Execute the query
mysqli_stmt_execute($stmt3);
$result3 = mysqli_stmt_get_result($stmt3);







?>  

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض المنتج</title>
    <!-- css -->
    <link rel="stylesheet" href="assets/css/productDetails.css">
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
.btn.btn-danger{
background-color:#af9d80;
    color:#ffff;
}
li {
  color: #af9d80;
  display: inline-block;
  padding: 0.625rem 0;
  
}
.alert-success {
  z-index: 1;
  background: #E6F9E6;
  font-size: 15px;
  font-weight: 788;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  padding: 10px 70px;
  display: inline-block;
  border-Right: 8px solid #3ad66e;
  border-radius: 4px;
  font-family: 'Dubai', Arial, sans-serif;
}
    </style>
</head>
<body dir="rtl">
    
 <!-- header -->
 <header class="p-3 navbar-dark">
        <div class="container" >
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="assets/img/logo.png" alt="" width="45" height="45">
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-left: auto; margin-right: 0 !important; padding-right: 15px; font-size: 20px;">
                    <li><a href="index.php" class="nav-link px-2 text-black ">الرئيسية</a></li>
                    <li><a href="index.php.#shopping" class="nav-link px-2 text-black ">المنتجات</a></li>
                    <li><a href="sales.php" class="nav-link px-2 text-warning"><strong>العروض</strong></a></li>
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
                                <button type="button" class="btn btn-warning" onclick="location.href=\'login.php\'" style="margin-left: 1rem;>تسجيل الدخول</button>
                            </div>';
                    } ?>
                </div>
                <a href="cart.php" style="hover-color: #af9d80; color: #033135;"><i class='bx bxs-cart-alt' style="font-size: 30px;"></i></a>

            </div>
        </div>
    </header>
   <vr><br><br>
    <!-- product section -->
    <?php if($row["Offer_id"] != 0  ){ ?>
    <section class="product-container" style="background-color: #E74646 ;  border-radius: 6px;">
        <!-- left side -->
        <div class="img-card" style="margin:2%;" >
            <img src="Admin_Pages/uploads/<?php  echo $row2['Image_path'];  ?>" alt="image can`t be found" id="featured-image">
            <!-- small img -->
            <div class="small-Card">
                <?php while ($row3 = mysqli_fetch_assoc($result3)){ ?>
                <img src="Admin_Pages/uploads/<?php  echo $row3['Image_path'];  ?>" alt="image can`t be found" class="small-Img">
                <?php } ?>
            </div>
        </div>
        <!-- Right side -->
        <div class="product-info">
            <br>
            <h3 style="color:white;"> <?php  echo $row['title'];?></h3>
            <h5 style="color:yellow;"><?php  echo $row['Price'];?> SAR </h5>
            <h10 class="text-body-secondary before"><?php  echo $row['Price'];?> SAR</h10>

            <br>
            <p style="color:white;" ><?php  echo $row['description'];?></p>
            <br>
            <form action="" method="POST">
                <div class="quantity">
                    <input type="number" max="<?php  echo $row['Quantity'];?>" min="1" placeholder="1" name="quantity">
                    <input type="hidden" value="<?php  echo $row['Product_id'];?>" name="product_id"/>
                    <button type="submit" name="addcart" Style=" background-color:#033135;">اضف الى السلة</button>
                </div>
            </form>

            <div style="color:white;">
                <p  style="color:white;"><strong>تفاصيل المنتج :</strong> </p>
                <div class="delivery" style="color:white;">
                    <p style="color:white;">الشركة : <?php  echo $row['brand'];?></p> 
                    <p style="color:white;">الضمان : <?php  echo $row['insurance'];?> سنة  </p>
                </div>
                <hr>
                <div class="delivery">
                    <p style="color:white;"> اللون : <?php  echo $row['color'];?></p>
                </div>
                </div>
            </div>
        </div>
    </section>
    
        <?php } else{ ?>
                <section class="product-container" style="border-radius: 6px;">
                <!-- left side -->
                <div class="img-card" style="margin:2%;" >
                    <img src="Admin_Pages/uploads/<?php  echo $row2['Image_path'];  ?>" alt="image can`t be found" id="featured-image">
                    <!-- small img -->
                    <div class="small-Card">
                        <?php while ($row3 = mysqli_fetch_assoc($result3)){ ?>
                        <img src="Admin_Pages/uploads/<?php  echo $row3['Image_path'];  ?>" alt="image can`t be found" class="small-Img">
                        <?php } ?>
                    </div>
                </div>
                <!-- Right side -->
                <div class="product-info" style="margin:5%;">
                    <br>
                    <h3> <?php  echo $row['title'];?></h3>
                    <h5 style="color:grey;"><?php  echo $row['Price'];?> SAR </h5>
        
                    <br>
                    <p  ><?php  echo $row['description'];?></p>
                    <br>
                    <form action="" method="POST">
                        <div class="quantity">
                            <input type="number" max="<?php  echo $row['Quantity'];?>" value="1" min="1" placeholder="1" name="quantity">
                            <button name="addcart"Style="background-color:#033135; color:#ffff; border-radius:5Rrpx; " >اضف الى السلة</button>
                        </div>
                        <?php
    // display success message
    if(isset($_POST['addcart'])){
        echo '<div class="alert-success">تم إضافة المنتج بنجاح</div>';
    }
    ?>
                        </form>
                        <div>
                            <p><strong>تفاصيل المنتج :</strong> </p>
                            <div class="delivery" style="color:white;">
                            <p >الشركة : <?php  echo $row['brand'];?></p> 
                            <p >الضمان : <?php  echo $row['insurance'];?> سنة  </p>
                        </div>
                        <hr>
                        <div class="delivery">
                            
                            <p> اللون : <?php  echo $row['color'];?></p>
                        </div>
                            
                    </div>
                        
                </section>

    <?php } ?>

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


    <!-- script tags -->
    <script src="/assets/js/productDetails.js"></script>
</body>
</html>
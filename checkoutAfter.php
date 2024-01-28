<?php 
include "includes/DBConnection.php";


$customer_id= $_SESSION['customer_id'];
$order_id= $_SESSION['customer_id'];

 //$customer_id= $_SESSION['customer_id'];
  //$order_id= $_SESSION['order_id'];

 // Prepare the SQL query
$stmt = mysqli_prepare($conn, "SELECT * FROM customer WHERE Customer_id = '$customer_id' ;");
// Execute the query
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$stmt2 = mysqli_prepare($conn, "SELECT * FROM location WHERE Customer_id = '$customer_id' ;");
// Execute the query
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);
$row2 = mysqli_fetch_assoc($result2);


$stmt3= mysqli_prepare($conn, "SELECT * FROM product JOIN order_items ON product.Product_id= order_items.Product_id WHERE order_items.order_id = $order_id ;");
// Execute the query
mysqli_stmt_execute($stmt3);
$result3 = mysqli_stmt_get_result($stmt3);

$stmt4= mysqli_prepare($conn, "SELECT * FROM product JOIN order_items ON product.Product_id= order_items.Product_id JOIN images ON product.Product_id= images.Product_ID WHERE order_items.order_id = $order_id AND images.main_image= 1;");
// Execute the query
mysqli_stmt_execute($stmt4);
$result4 = mysqli_stmt_get_result($stmt4);
$row4 = mysqli_fetch_assoc($result4);

//add product
if(isset($_POST['insertBtn'])){
  echo $customer_id;
  $total_price = $_POST["total_price"]; 
  $Status = $_POST["Status"]; 
  $order_date = $_POST["order_date"]; 
  //add new service
  $sql=$conn->prepare("INSERT INTO orders (`total_price`, `Status`, `order_date`,Admin_id,Customer_id)  
                                   VALUES ('$total_price','$Status',' $order_date','1','$customer_id')");
                              
        
  if($sql->execute()) {
        while($row3 = mysqli_fetch_assoc($result3)){ 
            // Update the quantity of the product in the order
            /*
            $quantity = $row3['Quantity']-1;
            $product_id = $row3['Product_id']-1;
            $sql2 = "UPDATE product SET quantity='$quantity' WHERE  product_id='$product_id'";
            $result = mysqli_query($conn, $sql2);
            // Check if the query was successful
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
            */
        // Prepare the SQL query
        $stmt7 = mysqli_prepare($conn, "SELECT * FROM orders WHERE Customer_id = '$customer_id';");
        // Execute the query
        mysqli_stmt_execute($stmt7);
        $result7 = mysqli_stmt_get_result($stmt7);
        while( $row7=  mysqli_fetch_assoc($result7))
       
        $_SESSION["order_id"] = $row7['order_id'];
        
         header("location:Successful_Order.php");
  }
  }
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/checkout.css">
<link rel="stylesheet" href="assets/css/styles.css">
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
                <a href="cart.php" style="hover-color: #af9d80; color:#033135;"><i class='bx bxs-cart-alt' style="font-size: 30px;"></i></a>
        </div>
    </header>
    </div>
    </section>


<div class="row" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
  <div class="col-75">
    <div class="checkContainer">
    <form action="" method="POST">
      
      <div class="row">
        <div class="col-50">
          <h3 style="padding-top: 25px; padding: 20px; padding-right:5px">مـعـلـومـات   العـمـيـل</h3>
          <label for="fullname"><i class="fa fa-user"></i> الاسم الكامل</label>
          <input type="text" id="fullname" name="firstname" value=" <?php echo $row['First_name'] . " " . $row['Middle_name'] . " " . $row['Last_name']; ?>" required disabled>
          <label for="email"><i class="fa fa-envelope" ></i> البريد الالكتروني</label>
          <input type="text" id="email" name="email" value="<?php echo $row['Email'];?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required disabled>
          <label for="address"><i class="fa fa-address-card-o"></i> العنوان</label>
          <input type="text" id="address" name="address" value="<?php echo "";?>"required disabled>
          <label for="city"><i class="fa fa-institution"></i> الدولة</label>
          <input type="text" id="city" name="city" value="<?php echo "";?>" required disabled>
          <label for="state">المدينة</label>
          <input type="text" id="state" name="state" value="<?php echo $row['city'];?>" required disabled>
        </div>
    
        <div class="col-50">
          <h3 style="padding-top: 25px; padding: 20px; padding-right:5px" >مـعـلـومـات الـطـلـب</h3>
          <label for="cardname"> المنتجات </label>
    <?php 
            $i=0;
            $bill_total=0;
            while($row3 = mysqli_fetch_assoc($result3)){ ?>     
                <div class="card mb-3" style="max-width: 540px; padding-right: 15px;">
                  <div class="row g-0">
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $row3['title'];?></h5>
                        <p class="card-text">السعر</p>
                        <p class="card-text"><small class="text-muted"><?php echo $row3['Price'];?> SAR</small></p>
                        <p class="card-text">الكمية</p>
                        <p class="card-text"><small class="text-muted"><?php echo $row3['quantity'];?> </small></p>
                        <p class="card-text">الاجمالي</p>
                        <p class="card-text"><small class="text-muted"><?php 
                                                                        $price= $row3['Price'];
                                                                        $quan= $row3['quantity'];
                                                                        $total= $quan * $price;
                                                                        $element=array();
                                                                        $element[$i]=$total;
                                                                        $bill_total=$bill_total + $element[$i] ;
                                                                        $i++;
                                                                        echo $total;
                                                                        ?> SAR</small></p>
                        <p class="card-text">الضريبة</p>
                        <p class="card-text"><small class="text-muted"><?php echo ($total*0.15);?> SAR</small></p>
                      </div>
                    </div>
                    
                  </div>
                  
                </div>

                <?php } ?>
                
                <h3 style="padding-top: 25px; padding: 20px; padding-right:5px">إجمالي   الـفاتـورة</h3>
                <input type="text" id="state" name="total" value="<?php echo $bill_total+($bill_total*0.15);?>" required disabled>
          
                <div class="row" >
                  <div class="col-sm">
                  <input type="button" value=" عودة" class="btn2" Style="background-color:#033135; color:#ffff;"
     onclick=" location.href ='Cart.php';">
                  </div> 
                  <input type="hidden" name="order_date" value="<?php echo date("Y-m-d")." / ".date("h-min");  ?>"/>
                  <input type="hidden" name="Status" value="<?php     echo " تم تأكيد الطلب "  ?>"/>
                  <input type="hidden" name="total_price" value="<?php  echo $bill_total+($$bill_total*0.15) ;  ?>"/>
                  <input type="hidden" name="Customer_id" value="<?php    echo $customer_id;  ?>"/>
                  <input type="submit" value=" إتمام الشراء" name="insertBtn"class="btn2" Style="background-color:#af9d80; color:#ffff;" >
                  </div> 
                </div> 
          
          </div>
        </div>
              
      </div>
      
    </form>
    
    

<script>
var emailInput = document.getElementById('email');
var fName = document.getElementById('fullname');
// add event listener to inputs
confirmPasswordInput.addEventListener('input', checkPassword);
phone.addEventListener('input', checkPhone);
fName.addEventListener('input', checkFName);


function checkFName() {
  var checkName = fName.value.match(/^[\u0621-\u064Aa-zA-Z]+$/);
    console.log(checkName);
    if(checkName) {
        fName.setCustomValidity('');
    } else {
        fName.setCustomValidity('يجب ان لا يحتوي الإسم على رقم ');
    }
}




    </script>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js " integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz " crossorigin="anonymous "></script>

</body>
</html>
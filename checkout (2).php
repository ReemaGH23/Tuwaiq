<?php 
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
 
 session_start();

 //$customer_id= $_SESSION['customer_id'];
 $customer_id= 1;
  //$order_id= $_SESSION['order_id'];
  $order_id= 1;
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
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/checkout.css">
<link rel="stylesheet" href="assets/css/styles.css">

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
                    <li><a href="index.html" class="nav-link px-2 text-black">الرئيسية</a></li>
                    <li><a href="products.html" class="nav-link px-2 text-black">المنتجات</a></li>
                    <li><a href="#" class="nav-link px-2 text-black">العروض</a></li>
                    <li><a href="#" class="nav-link px-2 text-warning"><strong>السلة</strong></a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="عن ماذا تبحث؟" aria-label="Search" style="background: transparent !important; border-color: black !important;">
                </form>

                <div class="text-end">
                    <button type="button" class="btn btn-warning">أهلا 
                    <?php echo $row['First_name'];?>
                    </button>
                </div>
            </div>
        </div>
    </header>
    </div>
    </section>


<div class="row" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
  <div class="col-75">
    <div class="checkContainer">
    <form action="">
      
      <div class="row">
        <div class="col-50">
          <h3 style="padding-top: 25px; padding: 20px; padding-right:5px">مـعـلـومـات   العـمـيـل</h3>
          <label for="fullname"><i class="fa fa-user"></i> الاسم الكامل</label>
          <input type="text" id="fullname" name="firstname" value=" <?php echo $row['First_name'] . " " . $row['Middle_name'] . " " . $row['Last_name']; ?>" required disabled>
          <label for="email"><i class="fa fa-envelope" ></i> البريد الالكتروني</label>
          <input type="text" id="email" name="email" value="<?php echo $row['Email'];?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required disabled>
          <label for="address"><i class="fa fa-address-card-o"></i> العنوان</label>
          <input type="text" id="address" name="address" value="<?php echo $row2['address'];?>"required disabled>
          <label for="city"><i class="fa fa-institution"></i> الدولة</label>
          <input type="text" id="city" name="city" value="<?php echo $row2['Country'];?>" required disabled>
          <label for="state">المدينة</label>
          <input type="text" id="state" name="state" value="<?php echo $row2['city'];?>" required disabled>
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
                      </div>
                    </div>
                    
                  </div>
                  
                </div>

                <?php } ?>

                <h3 style="padding-top: 25px; padding: 20px; padding-right:5px">إجمالي   الـفاتـورة</h3>
                <input type="text" id="state" name="total" value="<?php echo $bill_total?>" required disabled>
          
                <div class="row" >
                  <div class="col-sm">
                  <input type="button" value=" عودة" class="btn2" style="background-color: #000; color: #fff;">
                  </div>
                  <div class="col-sm">
                  <input type="submit" value=" إتمام الشراء" class="btn2">
                  </div>
                </div> 
          
          </div>
        </div>
              
      </div>
      
    </form>
    
    <?php
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $_SESSION["fullname"] = $_POST["firstname"];
      $_SESSION["email"] = $_POST["email"];
      $_SESSION["address"] = $_POST["address"];
      $_SESSION["city"] = $_POST["city"];
      $_SESSION["state"] = $_POST["state"];
      $_SESSION["zip"] = $_POST["zip"];
      $_SESSION["cardname"] = $_POST["cardname"];
      $_SESSION["cardnumber"] = $_POST["cardnumber"];
      $_SESSION["expmonth"] = $_POST["expmonth"];
      $_SESSION["expyear"] = $_POST["expyear"];
      $_SESSION["cvv"] = $_POST["cvv"];
      
      header("Location: /confirmation_page.php");
      exit;
    }
    ?>


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
            <li class="nav-item "><a href="index.html" class="nav-link px-2 text-body-secondary ">الرئيسية</a></li>
            <li class="nav-item "><a href="products.html" class="nav-link px-2 text-body-secondary ">المنتجات</a></li>
            <li class="nav-item "><a href="# " class="nav-link px-2 text-body-secondary ">العروض</a></li>
            <li class="nav-item "><a href="# " class="nav-link px-2 text-body-secondary ">من نحن</a></li>
            <li class="nav-item "><a href="# " class="nav-link px-2 text-body-secondary ">تواصل معنا</a></li>
        </ul>
        <p class="text-center text-body-secondary ">© 2023 bena Company, Inc</p>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js " integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz " crossorigin="anonymous "></script>

</body>
</html>
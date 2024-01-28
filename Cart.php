<?php
 include "includes/DBConnection.php";

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)  {
        $customer_id= $_SESSION['customer_id'];
            
    } else {
        echo "<script> alert('يجب عليك تسجيل الدخول'); </script>";
        header('location:Must_Login.php');
        
    } 
    

?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantity = $_POST['quantity'];
    $product_id = $_POST['product_id'];
    $order_id = $customer_id; // replace with the actual order ID
    
    if (isset($_POST['delete'])) {
        // Delete the product from the order
        $sql = "DELETE FROM order_items WHERE order_id='$order_id' AND product_id='$product_id'";
        $result = mysqli_query($conn, $sql);
        // Check if the query was successful
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else if (isset($_POST['update'])) {
        // Update the quantity of the product in the order
        $sql = "UPDATE order_items SET quantity='$quantity' WHERE order_id='$order_id' AND product_id='$product_id'";
        $result = mysqli_query($conn, $sql);
        // Check if the query was successful
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html >

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="assets/css/Cart.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  

  <title>سلة التسوق</title>
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

<body >

   <!-- header -->
   <header class="p-3 navbar-dark" dir="rtl">
    <div class="container" >
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
                    } ?>
                </div>
                <a href="cart.php"style="hover-color: rgb(255, 193, 7);  color:#033135;"><i class='bx bxs-cart-alt' style="font-size: 30px;"></i></a>
    </div>
</header>
</div>
</section>




<main>
  <div class="basket" >

<div class="basket-module" dir="ltr">
        <label for="promo-code" style=" font-weight: 800; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">اضف كود الخصم هنا</label>
        <input id="promo-code" type="text" name="promo-code" maxlength="5" class="promo-code-field">
        <button class="promo-code-cta" Style="background-color:#033135; color:#ffff;"> تـفـعـيـل</button>
      </div>
    <div class="basket-labels" >
      <ul>
        <li class="item item-heading">الـمـنـتـج</li>
        <li class="price">الـسـعـر</li>
        <li class="quantity">الـكـمـيـة</li>
        <li class="subtotal">الـمـجـمـوع</li>
      </ul>
    </div>
   <?php
   
$customer_id = $_SESSION['customer_id'];
$sql = "SELECT * FROM order_items
        JOIN product ON order_items.Product_id = product.Product_id
        JOIN images ON product.Product_id = images.Product_ID
        WHERE order_items.order_id = $customer_id AND images.main_image = 1";
$result = mysqli_query($conn, $sql);
$subtotal=0;

// Loop through the results and generate HTML for each product
while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="basket-product">';
    echo '<div class="item">';
    echo '<div class="product-image">';
    echo '<img src="Admin_Pages/uploads/' . $row['Image_path'] . '" alt="' . $row['title'] . '" class="product-frame">';
    echo '</div>';

    echo '<div class="product-details">';
    echo '<h1 style="font-family:\'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;"><strong><span class="item-quantity"><span id="quantity-' . $row['Product_id'] . '">' . $row['quantity'] . '</span> x</span> ' . $row['title'] . '</strong> ' . $row['material'] . ' </h1>';
    echo '<p style="font-family:\'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;"><strong>' . $row['color'] . '</strong></p>';
    echo '<p style="font-family:\'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;">رمز الـمـنـتـج - ' . $row['Product_id'] . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="price">' . $row['Price'] . '</div>';
    
    echo '<div class="quantity">';

    echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" id="update-form-' . $row['Product_id'] . '">';

    echo '<input type="number" name="quantity" id="quantity" value="' . $row['quantity'] . '" min="1" class="quantity-field">';

    echo '<input type="hidden" name="product_id" value="' . $row['Product_id'] . '">';

    echo '</div>';

    if(isset($row['Price'])) {
        $subtotal +=  $row['quantity']  * $row['Price'];
    }
    echo '<div class="subtotal">'  . $subtotal .  '</div>';
    echo '<div class="remove">';
    echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
    echo '<input type="hidden" name="product_id" value="' . $row['Product_id'] . '">';
    echo '<button type="submit" name="delete" value="1" style="color: red;">حـذف</button>';
    echo '<button type="submit" name="update" style="color:  black;">تحديث </button>';
    echo '</form>';
    echo '</div>';

    echo '</div>';
}
?>





  </div>
  <aside>
    <div class="summary" >
        <div class="summary-total-items" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600; color:#af9d80;">

            <span class="total-items" ></span> منتجاتك في السلة
        </div>
        <div class="summary-subtotal" dir="ltr">
          <div class="subtotal-title" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">المجموع</div>
          <div class="subtotal-value final-value" id="basket-subtotal"><?php echo $subtotal?></div>
          <div class="summary-promo hide">
            <div class="promo-title">كود الخصم</div>
            <div class="promo-value final-value" id="basket-promo"></div>
          </div>
        <div class="summary-subtotal" dir="ltr">
            <div class="subtotal-title" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">الضريبة</div>
            <div class="subtotal-value final-value" id="basket-subtotal"><?php echo $subtotal*0.15  ?></div> 
            <div class="summary-promo hide">
              <div class="promo-title">كود الخصم</div>
              <div class="promo-value final-value" id="basket-promo"></div>
            </div>
        </div>
      
        <script>
            var deliverySelect = document.getElementById('delivery-collection');
            var errorElement = document.getElementById('delivery-error');
            deliverySelect.addEventListener('change', function() {
                var deliveryOption = this.value;
                var subtotalElement = document.getElementById('basket-total');
                var value = 0;
                if (deliveryOption == 'collection') {
                    value = 50;
                } else if (deliveryOption == 'first-class' || deliveryOption == 'second-class') {
                    value = 25;
                }
                var subtotal = parseFloat('<?php echo $subtotal; ?>') + value;
                subtotalElement.innerHTML = subtotal.toFixed(2);

                // Validate delivery option selection
                if (deliveryOption == '0') {
                    errorElement.style.display = 'block';
                } else {
                    errorElement.style.display = ' none';
                }
            });
        </script>
        <?php 
        $final_price = $subtotal*0.15+$subtotal;
          date_default_timezone_set('Asia/Riyadh');
           if(isset($_POST['activate'])){
            $coupon_name  =   $_POST["promo-code"];
                  
                  // Prepare the SQL query
                    $stmt = mysqli_prepare($conn, "SELECT * FROM coupons where Coupon_name='$coupon_name';");
                    // Execute the query
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                       
                    if(mysqli_num_rows($result) == 1){
                        $row = mysqli_fetch_assoc($result);
                        $current_date = date("Y-m-d");

                        if (strtotime($current_date) >= strtotime($row['start_date'])) {
                            if(strtotime($current_date) <= strtotime($row['expired_date'])){
                                echo " <script> 
                                            const input = document.querySelector('#promo-code'); 
                                            input.value = ' $coupon_name'; </script>";
  
                                $value=$row['Value']*0.01;
                                $final_price = $final_price-$final_price*$value;
                             }
                            else
                                echo "<script> document.getElementById('error-msg').innerHTML = 'كود منتهي';
                                               const input = document.querySelector('#promo-code'); 
                                               input.value = ' $coupon_name'; </script>";   
                        } else
                            echo "<script> document.getElementById('error-msg').innerHTML = 'لم يبدأ تفعيل الكود بعد';
                                           document.getElementById('promo-code').innerHTML = ' $coupon_name'; </script>";   
                    }              
                    else
                          echo " <script> document.getElementById('error-msg').innerHTML = ' هذا الرمز غير موجود';
                                            const input = document.querySelector('#promo-code'); 
                                            input.value = ' $coupon_name'; </script>";
 
           }
        ?>
        <div class="summary-total" >
            <div class="total-title" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">المبلغ الاجمالي</div>
            <div class="total-value final-value" id="basket-total"><?php echo $final_price?></div>
        </div>
        <div class="summary-checkout">
    <button class="checkout-cta" onclick="location.href='checkoutAfter.php'" Style="background-color:#033135; color:#ffff;">اكـمـال الشراء</button>
         
          
    

        </div>
    </div>
</aside>
</main>
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

  
</body>

</html>


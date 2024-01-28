<?php
 include "../includes/DBConnection.php";

// Prepare the SQL query
$stmt = mysqli_prepare($conn, "SELECT * FROM orders ;");
// Execute the query
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>جميع الطلبات</title>

    <link rel="stylesheet" href="css/sidebar.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Libre+Baskerville:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
    body {
    direction: rtl;
    font-family: 'Cairo', sans-serif !important;
    font-family: 'Libre Baskerville', serif !important;
        }
        table {
        border-collapse: collapse;
        border-spacing: 0;
        border: 1px solid #ddd;
        }

        th, td {
        text-align: center;
        padding: 8px;
        font-size:14px;
        width:10%;
        }

tr:nth-child(even){background-color: #f2f2f2}

</style>    
</head>

<body dir="rtl">
    <!-- header -->
    <header class="p-3 navbar-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="../assets/img/logo.png" alt="" width="40" height="32">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-left: auto; margin-right: 0 !important; padding-right: 15px; font-size: 20px;">
                        <li><a href="adminProfile.php" class="nav-link px-2 text-black">معلومات حسابي</a></li>
                        <li><a href="Display_productNew.php" class="nav-link px-2 text-black">ادارة المنتجات</a></li>
                        <li><a href="#" class="nav-link px-2 text-warning"><strong>طلبات العملاء</strong> </a></li>
                        <li><a href="Categories_dispalyAll.php" class="nav-link px-2 text-black">تصنيف المنتجات</a></li>
                        <li><a href="Offers.php" class="nav-link px-2 text-black">العروض</a></li>
                        <li><a href="Coupons_displayAll.php" class="nav-link px-2 text-black">الكوبونات</a></li>
                        <li><a href="Slider_displayAll.php" class="nav-link px-2 text-black">الخلفيات</a></li>
                </ul>
            </div>
        </div>
    </header>
    <!-- shop section -->

    <section id=shopping>
        <div class="album py-5 bg-body-tertiary slide ">
            <div class="container "  style="color:#af9d80;" >
            <h1>سجل الطلبات</h1><br>
                <div style="overflow-x:auto;  color:#033135;">
                <table>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>اسم العميل</th>
                        <th>رقم الجوال</th>
                        <th>تاريخ الطلب</th>
                        <th>السعر</th>
                        <th>التوصيل</th>
                        <th>حالة الطلب</th>
                        <th>تفاصيل</th>
                    </tr>
                    <?php   while($row = mysqli_fetch_assoc($result))
                            {
                                    $customer_id = $row['Customer_id'];
                                    // Prepare the SQL query
                                    $stmt2 = mysqli_prepare($conn, "SELECT * FROM customer WHERE Customer_id='$customer_id';");
                                    // Execute the query
                                    mysqli_stmt_execute($stmt2);
                                    $result2 = mysqli_stmt_get_result($stmt2);
                                    $row2 = mysqli_fetch_assoc($result2); 
                                    $delivery_id= $row['delivery_id'];
                                    // Prepare the SQL query
                                    //$stmt3 = mysqli_prepare($conn, "SELECT * FROM delivery WHERE delivery_id='$delivery_id';");
                                    // Execute the query
                                    //mysqli_stmt_execute($stmt3);
                                    //$result3 = mysqli_stmt_get_result($stmt3);
                                    //$row3 = mysqli_fetch_assoc($result3); 

                    ?>
                    <tr>
                        <td><?php  echo $row['order_id'];  ?></td>
                        <td><?php  echo $row2['First_name']." ". $row2['Middle_name']." ".$row2['Last_name'];  ?></td>
                        <td><?php  echo $row['order_date'];  ?></td>
                        <td><?php  echo $row['order_date'];  ?></td>
                        <td><?php  echo $row['total_price'];  ?></td>
                        <td><?php  echo "-"  ?></td>
                        <td><input type="text" value="<?php  echo $row['Status'];  ?>"/></td>
                        <td><a href="#">تفاصيل</a></td>
                    </tr>
                    <?php } ?>
                </table>
                </div>

                    
                    

                </form>
                </div>

            
            </div>
        </div>
    </section>

    <!-- footer section -->
    <div class="container ">
        <footer class="py-3 my-4 ">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3 ">
            <li class="nav-item "><a href="" class="nav-link px-2 text-body-secondary ">حساب المدير</a></li>
            </ul>
            <p class="text-center text-body-secondary ">© 2023 bena Company, Inc</p>
        </footer>
    </div>


</div>

    </body>

</html>
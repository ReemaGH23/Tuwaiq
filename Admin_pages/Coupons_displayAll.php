<?php
 include "../includes/DBConnection.php";
// Prepare the SQL query
$stmt = mysqli_prepare($conn, "SELECT * FROM coupons ;");
// Execute the query
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


//--------------------------------------------- delete product ---------------------------------------------------------------
// Delete product if delete request is sent
if(isset($_POST['delete_product']) && !empty($_POST['delete_product'])){
    echo "yessss";
    $coupon_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $stmt = mysqli_prepare($conn,"DELETE FROM `coupons` WHERE coupon_id='$coupon_id'");
    if(mysqli_stmt_execute($stmt)){
        header("Location: ".$_SERVER['PHP_SELF']); // Redirect to the same page
        exit; // Stop the script execution after the delete operation
    }
}
//--------------------------------------------- insert coupon ---------------------------------------------------------------
if(isset($_POST['insertBtn'])){
    $value         =   $_POST["value"]; //not null
    $name          =   $_POST["name"]; //not null
    $start_date    =   $_POST["start_date"]; //not null
    $expired_date  =   $_POST["expired_date"];

        //add new service
          $sql=$conn->prepare("INSERT INTO `coupons`(`Value`, `coupon_name`, `Start_date`, `expired_date`)  VALUES ('$value','$name',' $start_date','$expired_date')");
          
            if($sql->execute()){
                   echo "coupon added successfully <br>";
            } else
                   echo "coupon added failed<br>";
   
   header("location:Coupons_displayAll.php");
   }

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
        font-size:16px;
        }

        th, td {
        text-align: center;
        padding: 8px;
        width:10%;
        }

       tr:nth-child(even){
        background-color: #f2f2f2;
    }
    table button  {
        background: none!important;
        border: none;
        padding: 0!important;
        /*optional*/
        font-family: arial, sans-serif;
        /*input has OS specific font-family*/
        color: #069;
        text-decoration: underline;
        cursor: pointer;
    }
    

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

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" 
                style="margin-left: auto; margin-right: 0 !important; padding-right: 15px; font-size: 20px;">
                    <li><a href="adminProfile.php" class="nav-link px-2 text-black">معلومات حسابي</a></li>
                    <li><a href="Display_productNew.php" class="nav-link px-2 text-black">ادارة المنتجات</a></li>
                    <li><a href="Orders_DisplayAll.php" class="nav-link px-2 text-black">طلبات العملاء</a></li>
                    <li><a href="Categories_dispalyAll.php" class="nav-link px-2 text-black">تصنيف المنتجات</a></li>
                    <li><a href="Offers.php" class="nav-link px-2 text-black">العروض</a></li>
                    <li><a href="#" class="nav-link px-2 text-warning"><strong>الكوبونات</strong></a></li>
                    <li><a href="Slider_DisplayAll.php" class="nav-link px-2 text-black">الخلفيات</a></li>
                </ul>
            </div>
        </div>
    </header>
    <!-- shop section -->

    <section id=shopping>
        <div class="album py-5 bg-body-tertiary slide ">
            <div class="container " Style="color:#af9d80;">
            <h1>الكوبونات</h1><br>
                <div style="overflow-x:auto; color:#033135;" >
                <table>
                    <tr>
                        <th>م</th>
                        <th>رمز الكوبون</th>
                        <th>القيمة</th>
                        <th>تاريخ التفعيل</th>
                        <th>تاريخ الانتهاء</th>
                        <th></th>
                    </tr>
                    <?php   $i=1; 
                            while($row = mysqli_fetch_assoc($result))
                            { 
                                //onclick="return confirm('هل انت متأكد من حذف هذا الكوبون ؟ \n\n **لا يمكن التراجع بعد تأكيد الحذف**');"

                    ?>
                    <form action="" method="POST">
                    <tr>
                        <td><?php  echo $i;  ?></td>
                        <td><?php  echo $row['Coupon_name'];  ?></td>
                        <td><?php  echo $row['Value'];  ?>%</td>
                        <td><?php  echo $row['start_date'];  ?></td>
                        <td><?php  echo $row['expired_date'];  ?></td>
                        <td><button type="button" class="btn btn-danger" 
                        style="background-color:#af9d80 !important; border: 7px solid #af9d80; border-radius: 7px; padding: 1px 7px !important;" 
                            data-toggle="modal" data-target="#deleteEmployeeModal" data-productid="<?php echo $row['Coupon_id']; ?>">حذف  </button></td>
                            <input type="hidden" name="product_id" value="<?php echo $row['Coupon_id']; ?>"/>
                            <input type="hidden" name="delete_product" value="1"/>
                    </tr>
                    </form>
                    <?php $i++;} ?>
                </table>
                </div>
                </div> 
                <div style="display: flex; align-items: center; justify-content: center; margin-top: 30px; ">
                    <button type="button" class="btn btn-dark btn-lg px-4 me-md-2 ">
                         <a href="#addEmployeeModal"  data-toggle="modal"  style="color:white; text-decoration: none;">إضافة كوبون جديد</a>
                    </button>
                </div>          
            </div>
        </div>
    </section>
  
<!----------------------->
<!----add-modal start--------->
<div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" dir="rtl">
            </div>
            <div class="modal-body" dir="rtl">
                <div class="form-group">
                <form action="" method="POST" >
                    <label style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">قيمة الخصم</label>
                    <select class="form-control" name = "value" id = "value" required>
                        <option selected disabled>%</option>
                        <option>5%</option>
                        <option>10%</option>
                        <option>15%</option>
                        <option>20%</option>
                        <option>25%</option>
                        <option>30%</option>
                        <option>40%</option>
                        <option>50%</option>
                        <option>60%</option>
                        <option>70%</option>
                        <option>75%</option>
                        <option>80%</option>
                        <option>90%</option>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">ادخل رمز الكوبون</label>
                    <input type="text" class="form-control" name = "name"  id = "name" required>
                </div>
                <div class="form-group">
                    <label style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">تاريخ بدء التفعيل</label>
                    <input type="date" class="form-control" name = "start_date"  id = "start_date" required>
                </div>
                <div class="form-group">
                    <label style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">تاريخ الانتهاء</label>
                    <input type="date" class="form-control" name = "expired_date" id = "expired_date" required>
                </div>
            </div>

            <!-- Add the form element and set the "action" attribute to the current file name -->

            
                 <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;" 
                        data-dismiss="modal">تراجع</button>
                      
                        <button type="submit" name="insertBtn" class="btn btn-success" 
                        style="border: none; ; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">اضف</button>
                 </div>
            
            </form>

           
        </div>
    </div>
</div>


<!----add-modal end--------->
<!----------------------->
<script>
		  let sidebar = document.querySelector(".sidebar");
		  let closeBtn = document.querySelector("#btn");
		  let searchBtn = document.querySelector(".bx-search");
		
		  closeBtn.addEventListener("click", ()=>{
			sidebar.classList.toggle("open");
			menuBtnChange();//calling the function(optional)
		  });
		
		  searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
			sidebar.classList.toggle("open");
			menuBtnChange(); //calling the function(optional)
		  });
		
		  // following are the code to change sidebar button(optional)
		  function menuBtnChange() {
		   if(sidebar.classList.contains("open")){
			 closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
		   }else {
			 closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
		   }
		  }
		  </script>

          <!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.3.1.slim.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function () {
			$(".xp-menubar").on('click', function () {
				$("#sidebar").toggleClass('active');
				$("#content").toggleClass('active');
			});

			$('.xp-menubar,.body-overlay').on('click', function () {
				$("#sidebar,.body-overlay").toggleClass('show-nav');
			});

		});
	</script>
    <!----delete-modal start--------->
    <div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog" dir="rtl">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" dir="rtl" style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 700;" dir="rtl">حذف منتج</h5>
                    </div>
                    <div class="modal-body">
                        <p style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">هل انت متأكد من حذف هذا المنتج ؟</p>
                        <p class="text-warning" ><small style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">لايمكن التراجع بعد تنفيذ الامر *</small></p>
                    </div>
                    <!-- Hidden input field for Product_id -->
                    <input type="hidden" name="product_id" id="deleteProductID">
                    <input type="hidden" name="delete_product" value="1">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">تراجع</button>
                        <button type="submit" class="btn btn-success"  id="deleteBtn" name="deleteBtn" style=" border:none; background-color:  #af9d80; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;" >حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

<!----add-modal end--------->
<!----------------------->
<script>
		  let sidebar = document.querySelector(".sidebar");
		  let closeBtn = document.querySelector("#btn");
		  let searchBtn = document.querySelector(".bx-search");
		
		  closeBtn.addEventListener("click", ()=>{
			sidebar.classList.toggle("open");
			menuBtnChange();//calling the function(optional)
		  });
		
		  searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
			sidebar.classList.toggle("open");
			menuBtnChange(); //calling the function(optional)
		  });
		
		  // following are the code to change sidebar button(optional)
		  function menuBtnChange() {
		   if(sidebar.classList.contains("open")){
			 closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
		   }else {
			 closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
		   }
		  }
		  </script>

          <!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.3.1.slim.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function () {
			$(".xp-menubar").on('click', function () {
				$("#sidebar").toggleClass('active');
				$("#content").toggleClass('active');
			});

			$('.xp-menubar,.body-overlay').on('click', function () {
				$("#sidebar,.body-overlay").toggleClass('show-nav');
			});

		});
	</script>
<script>
$(document).ready(function() {
    $('#deleteEmployeeModal').on('show.bs.modal', function(e) {
        let product_id = $(e.relatedTarget).data('productid');
        $('#deleteProductID').val(product_id);
    });
    
    $('#deleteEmployeeModal').on('hidden.bs.modal', function(e) {
        $('#deleteProductID').val('');
    });
});

function deleteProduct() {
    if (confirm("هل انت متأكد من حذف هذا المنتج؟")) {
        let form = document.querySelector("#deleteEmployeeModal form"); 
        let productId = form.elements["product_id"].value;
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "", true); // Send the request to the same script
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                document.getElementById("productTable").innerHTML = xhr.responseText; // Update the product table with the response
            }
        }
        xhr.send("product_id=" + productId + "&delete_product=1");
    }
}
</script>
 
<!--delete modal-->
<div class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title" dir="rtl" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 700;" dir="rtl">حذف كوبون</h5>
                </div>
                <div class="modal-body">
                    <p style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">هل انت متأكد من حذف هذا الكوبون ؟</p>
                    <p class="text-warning"><small style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">لايمكن التراجع بعد تنفيذ الامر *</small></p>
                    <!-- Hidden input field for Product_id -->
                    <input type="hidden" name="product_id" id="deleteProductID">
                    <input type="hidden" name="delete_product" value="1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">تراجع</button>
                    <button type="submit" class="btn btn-success" style="border:none; background-color: rgb(241, 195, 71); font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">حذف</button>
                </div>
            </form>
        </div>
    </div>
</div>

<


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
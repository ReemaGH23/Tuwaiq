<?php
 include "../includes/DBConnection.php";

 // Prepare the SQL query
$stmt = mysqli_prepare($conn, "SELECT * FROM product ;");
// Execute the query
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

//--------------------------------------------- delete product ---------------------------------------------------------------
// Delete product if delete request is sent
if(isset($_POST['delete_product']) && !empty($_POST['delete_product'])){
    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $stmt = mysqli_prepare($conn, "DELETE FROM `order_items` WHERE `Product_id` = ?");
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt); // Delete corresponding rows in order_items table
    $stmt = mysqli_prepare($conn, "DELETE FROM `images` WHERE `Product_id` = ?");
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt); // Delete corresponding rows in images table
    $stmt = mysqli_prepare($conn, "DELETE FROM `product` WHERE `Product_id` = ?");
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    if(mysqli_stmt_execute($stmt)){
        header("Location: ".$_SERVER['PHP_SELF']); // Redirect to the same page
        exit; // Stop the script execution after the delete operation
    }
}

//--------------------------------------------- insert coupon ---------------------------------------------------------------
function getAll($table){
    global $conn;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> ادارة المنتجات </title>

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
                    <img src="../assets/img/logo.png" alt="" width="45" height="45">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-left: auto; margin-right: 0 !important; padding-right: 15px; font-size: 20px;">
                        <li><a href="adminProfile.php" class="nav-link px-2 text-black">معلومات حسابي</a></li>
                        <li><a href="#" class="nav-link px-2 text-warning"><strong>ادارة المنتجات</strong> </a></li>
                        <li><a href="Orders_DisplayAll.php" class="nav-link px-2 text-black">طلبات العملاء</a></li>
                        <li><a href="Categories_dispalyAll.php" class="nav-link px-2 text-black">تصنيف المنتجات</a></li>
                        <li><a href="Offers.php" class="nav-link px-2 text-black">العروض</a></li>
                        <li><a href="Coupons_displayAll.php" class="nav-link px-2 text-black">الكوبونات</a></li>
                        <li><a href="Slider_DisplayAll.php" class="nav-link px-2 text-black">الخلفيات</a></li>
                </ul>

            </div>
        </div>
    </header>

            
            </div>
        </div>
    </header>
    <!-- shop section -->

    <section id=shopping>
        <div class="album py-5 bg-body-tertiary slide ">
            <div class="container "  style="color:#af9d80;">
            <h1> ادارة المنتجات</h1><br>
                <div style="overflow-x:auto; color:#033135;">
                <table>
                    <tr>
                    <th>رقم المنتج </th>
                        <th>اسم المنتج</th>
                        <th>تصنيف المنتج</th>
                        <th>صورة المنتج </th>
                        <th>سعر المنتج</th>
                        <th>كمية المنتج</th>
                      
                        <th></th>
                    </tr>
                    <?php 
                      $i=1; 
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $imgP = $row['Product_id'];
                                $category_id = $row['category_id'];
                                // Prepare the SQL query
                                $stmt2 = mysqli_prepare($conn, "SELECT * FROM images WHERE
                                Product_ID =' $imgP ' AND main_image = '1' ;");
                               // Execute the query
                                mysqli_stmt_execute($stmt2);
                                $result2 = mysqli_stmt_get_result($stmt2);
                                $row2 = mysqli_fetch_assoc($result2);
                                // Prepare the SQL query
                                $stmt3 = mysqli_prepare($conn, "SELECT * FROM category WHERE
                                category_id =' $category_id ';");
                               // Execute the query
                                mysqli_stmt_execute($stmt3);
                                $result3 = mysqli_stmt_get_result($stmt3);
                                $row3 = mysqli_fetch_assoc($result3);

                            
                    ?>
                   <tr>
                   <form method="POST" action="">
        <td><?php echo $i; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row3['category_name']; ?></td>
        <td><img src="uploads/<?php echo $row2['Image_path']; ?>" alt=" " class="imgP" Style="height:80px;width:90px;"></td>
        <td><?php echo $row['Price']; ?> SAR</td>
        <td><?php echo $row['Quantity']; ?></td>
        <td><a href="edit_product.php?id=<?php echo $row['Product_id']; ?>" class="btn btn-danger" Style="background-color:#033135; border: 1px #033135; ">تعديل</a></td>
        <td><button type="button" class="btn btn-danger" style="background-color:#af9d80 !important; border: 7px solid #af9d80; border-radius: 7px; padding: 1px 7px !important;" 
             data-toggle="modal" data-target="#deleteEmployeeModal" data-productid="<?php echo $row['Product_id']; ?>">حذف  </button></td>
             <input type="hidden" name="product_id" value="<?php echo $row['Product_id']; ?>"/>
             <input type="hidden" name="delete_product" value="1"/>
    </form>
</tr>
                    <?php $i++;} ?>
                </table>
                </div>
                </div> 
                <div style="display: flex; align-items: center; justify-content: center; margin-top: 30px; ">
                    <button type="button" class="btn btn-dark btn-lg px-4 me-md-2 ">
                         <a href="#addEmployeeModal"  data-toggle="modal"  style="color:white; text-decoration: none;">إضافة منتج جديد</a>
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
            <div class="modal-body" dir="rtl">
            <form action="addProduct.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">اسم المنتج</label>
                    <input type="text" class="form-control" name="title"  id = "title" required="">
                </div>

                <div class="form-group">
                    <label style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">وصف المنتج</label>
                    <input type="text" class="form-control" name="description"  id = "description" required="">
                </div>

                <div class="form-group">
                    <label style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">سعر المنتج</label>
                    <input type="text" class="form-control" name="price"  id = "price" required="">
                </div>

                <div class="form-group">
                <form action="" method="POST" >
                    <label style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">تصنيف المنتج</label>
                    <select class="form-control" name= "category_id" id= "category_id" required>
                        <option selected disabled>تصنيف المنتج هو..</option>
                        <?php
                        $category = getAll("category");
                        if(mysqli_num_rows($category) > 0){
                            foreach($category as $item){
                                ?>
                                    <option value= "<?= $item ['category_id']; ?>"><?=$item['category_name']; ?></option>
                                <?php
                            }
                        }else{
                            echo"لا يوجد تصنيفات, الرجاء اضافة تصنيف";
                        } 
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">الكمية المتوفرة</label>
                    <input type="number" class="form-control" name="quantity"  id = "quantity" required="">
                </div>


                <div class="form-group">
                    <label style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">صورة المنتج</label>
                    <div class="container" style="display: flex; align-items: center; justify-content:center; text-align: center; flex-direction: column; padding: 0px">
                    <input class="form-control" type="file" id="image" name="image" accept=".jpg, .jpeg, .png" style="border-radius: 6px;" required="" value="Upload">
                    </div>
					<script src="js/uploadimg.js"></script>
                </div>

                <div class="form-group">
                    <label style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">الشركة </label>
                    <input type="text" class="form-control" name="brand"  id = "material" required="">
                </div>

             

                <div class="form-group">
                    <label style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">لون المنتج</label>
                    <input type="text" class="form-control" name="color"  id = "color" required="">
                </div>

                <div class="form-group">
                    <label style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">مدة الضمان</label>
                    <input type="number" class="form-control" name="insurance"  id = "insurance" required="">
                </div>

            </div>

            <!-- Add the form element and set the "action" attribute to the current file name -->

            
                 <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;" 
                        data-dismiss="modal">تراجع</button>
                      
                        <button type="submit" name="insertBtn" class="btn btn-success" 
                        style="border: none; background-color: #af9d80; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">اضف</button>
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
                    <h5 class="modal-title" dir="rtl" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 700;" dir="rtl">حذف منتج</h5>
                </div>
                <div class="modal-body">
                    <p style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">هل انت متأكد من حذف هذا المنتج ؟</p>
                    <p class="text-warning"><small style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600; color:#af9d80;">لايمكن التراجع بعد تنفيذ الامر *</small></p>
                    <!-- Hidden input field for Product_id -->
                    <input type="hidden" name="product_id" id="deleteProductID">
                    <input type="hidden" name="delete_product" value="1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">تراجع</button>
                    <button type="submit" class="btn btn-success" style="border:none; background-color:#af9d80 ;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">حذف</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to update hidden input field -->
<script>
$(document).ready(function() {
    $('#deleteEmployeeModal').on('show.bs.modal', function(e) {
        let product_id = $(e.relatedTarget).data('productid');
        $('#deleteProductID').val(product_id);
    });
});
</script>


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
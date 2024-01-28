<?php
 include "../includes/DBConnection.php";

// Prepare the SQL query
$stmt = mysqli_prepare($conn, "SELECT * FROM slider ;");
// Execute the query
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

//--------------------------------------------- delete product ---------------------------------------------------------------
// Delete product if delete request is sent
if(isset($_POST['delete_product']) && !empty($_POST['delete_product'])){
    echo "yessss";
    $image_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $stmt = mysqli_prepare($conn,"DELETE FROM `slider` WHERE image_id='$image_id'");
    if(mysqli_stmt_execute($stmt)){
        header("Location: ".$_SERVER['PHP_SELF']); // Redirect to the same page
        exit; // Stop the script execution after the delete operation
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>الصفحة الرئيسية</title>

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

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-left: auto; margin-right: 0 !important; padding-right: 15px; font-size: 20px; ">
                        <li><a href="adminProfile.php" class="nav-link px-2 text-black">معلومات حسابي</a></li>
                        <li><a href="Display_productNew.php" class="nav-link px-2 text-black">ادارة المنتجات</a></li>
                        <li><a href="Orders_DisplayAll.php" class="nav-link px-2 text-black">طلبات العملاء</a></li>
                        <li><a href="Categories_dispalyAll.php" class="nav-link px-2 text-black">تصنيف المنتجات</a></li>
                        <li><a href="Offers.php" class="nav-link px-2 text-black">العروض</a></li>
                        <li><a href="Coupons_displayAll.php" class="nav-link px-2 text-black">الكوبونات</a></li>
                        <li><a href="#" class="nav-link px-2 text-warning"><strong>الخلفيات</strong></a></li>
                </ul>
            </div>
        </div>
    </header>
    <!-- shop section -->
       <!-- shop section -->

       <section id=shopping>
        <div class="album py-5 bg-body-tertiary slide ">
            <div class="container " style="color:#af9d80;">
            <h1> خلفيات الموقع</h1><br>
            <h6 style="color:#033135; ">** لا يمكن إضافة أكثر من ثلاث خلفيات ** <br> عند إضافة أكثر من ثلاث صور سوف تنحذف اقدم صورة تلقائيا</h6><br>
                <div style="overflow-x:auto; color:#033135;">
                <table>
                    <tr>
                    <th>رقم الخلفية </th>
                        <th>اسم الصورة</th>
                        <th>الصورة </th>
                        <th></th>
                    </tr>
                    <?php 
                      $i=1; 
                            while($row = mysqli_fetch_assoc($result))
                            {
                            
                    ?>
                   <tr>
                   <form method="POST" action="">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['Image_name']; ?></td>
                        <td><img src="uploads/<?php echo $row['image_path']; ?>" alt="لا يمكن الوصول للصورة" class="imgP" Style="height:80px;width:120px;"></td>
                        <td><button type="button" class="btn btn-danger" 
                        style="background-color:#af9d80 !important; border: 7px solid #af9d80; border-radius: 7px; padding: 1px 7px !important;" 
                            data-toggle="modal" data-target="#deleteEmployeeModal" data-productid="<?php echo $row['image_id']; ?>">حذف  </button></td>
                            <input type="hidden" name="product_id" value="<?php echo $row['image_id']; ?>"/>
                           <input type="hidden" name="delete_product" value="1"/>
                    </form>
                </tr>
                    <?php $i++;} ?>
                </table>
                </div>
                </div> 
                <div style="display: flex; align-items: center; justify-content: center; margin-top: 30px; ">

                    <div style="display: flex; align-items: center; justify-content: center; margin-top: 30px; ">
                    <button type="button" class="btn btn-dark btn-lg px-4 me-md-2 " onclick="window.location.href='AddNewPic.php'">إضافة خلفية جديدة</button>
                </div>
                </div>          
            </div>
        </div>
    </section>
    
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
<!----delete-modal start--------->
<div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog" dir="rtl">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form method="post" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" dir="rtl" style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 700;" dir="rtl">حذف منتج</h5>
                    </div>
                    <div class="modal-body">
                        <p style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">هل انت متأكد من حذف هذا التصنيف ؟</p>
                        <p class="text-warning"><small style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600; color:#af9d80;">لايمكن التراجع بعد تنفيذ الامر *</small></p>
                    </div>
                    <!-- Hidden input field for Product_id -->
                    <input type="hidden" name="product_id" id="deleteProductID">
                    <input type="hidden" name="delete_product" value="1">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">تراجع</button>
                        <button type="submit" class="btn btn-success" id="deleteBtn" name="deleteBtn" style=" border:none; background-color:  #af9d80; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600;">حذف</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    


    <!-- footer section -->
    <div class="container ">
        <footer class="py-3 my-4 ">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3 ">
                <li class="nav-item "><a href="" class="nav-link px-2 text-body-secondary ">حساب المدير</a></li>
            </ul>
            <p class="text-center text-body-secondary ">© 2023 bena Company, Inc</p>
        </footer>
    </div>




    </body>

</html>
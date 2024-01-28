<?php
     include "includes/DBConnection.php";
$error = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['form_type'])){
    
            // handle sign-up form submission
            $first_name = $_POST['first-name'];
            $middle_name = $_POST['middle-name'];
            $last_name = $_POST['last-name'];
            $city = $_POST['city'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm-password'];

            // check if email already exists in database
            $stmt = $conn->prepare("SELECT * FROM customer WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result_email = $stmt->get_result();

            // check if phone already exists in database
            $stmt = $conn->prepare("SELECT * FROM customer WHERE Phone = ?");
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $result_phone = $stmt->get_result();

            if ($result_email->num_rows > 0) {
                // email already exists, display error message
                $error = 'البريد الإلكتروني مسجل مسبقاً';
            } else if ($result_phone->num_rows > 0) {
                // phone number already exists, display error message
                $error = 'رقم الهاتف مسجل مسبقاً';
            } else if ($password != $confirm_password) {
                // password and confirm password don't match, display error message
                $error = 'كلمة المرور وتأكيد كلمة المرور غير متطابقين';
            } else {

                // prepare and execute SQL query to insert new customer
                $stmt = $conn->prepare("INSERT INTO customer (First_name, Middle_name, Last_name, Email, Phone, Password, city) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $first_name, $middle_name, $last_name, $email, $phone, $password, $city);
                $stmt->execute();

              

                // redirect to sign-in page
 // redirect to sign-in page
 header("Location: login.php");
 exit();
             
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل جديد</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Libre+Baskerville:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        
        .form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr;
        }
        
        .left {
            grid-column-start: 2;
            grid-column-end: 3;
            margin-right: 10px;
        }
        
        .right {
            grid-column-start: 1;
            grid-column-end: 2;
            margin-left: 10px;
        }
        .login {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-image: url(lo11.jpg);
    background-size: cover;
    background-position: center;
}
    

.error-message {
    z-index: 1;   
    font-size: 15px;
    font-weight: 700;
    text-align: left;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 15px 40px;
    display: inline-block;
    border-radius: 4px;
    font-family: 'Dubai', Arial, sans-serif;
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
.btn.btn-warning:hover{
background-color:#033135;
color:#ffff;
   

}


</style>
</head>

<body>
    <!-- header -->
    <header class="p-3 navbar-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="assets/img/logo.png" alt="" width="40" height="32">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-left: auto; margin-right: 0 !important; padding-right: 15px; font-size: 20px;">
                    <li><a href="index.php" class="nav-link px-2 text-black ">الرئيسية</a></li>
                    <li><a href="index.php.#shopping" class="nav-link px-2 text-black">المنتجات</a></li>
                    <li><a href="sales.php" class="nav-link px-2 text-black">العروض</a></li>
                    <li><a href="index.php.#about-us" class="nav-link px-2 text-black">من نحن</a></li>
                    <li><a href="index.php.#contact-us" class="nav-link px-2 text-black">تواصل معنا</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="عن ماذا تبحث؟" aria-label="Search" style="background: transparent !important; border-color: black !important; margin:-0.8rem;">
                </form>

                <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)  {
                        echo '<div class="text-end">
                                <button type="button" class="btn btn-warning" onclick="location.href=\'customerProfile.php\'" style="margin-left: 1rem; ">حسابي</button>
                            </div>';
                    } else {
                        echo '<div class="text-end">
                                <button type="button" class="btn btn-warning" onclick="location.href=\'login.php\'" style="margin-left: 1rem; ">تسجيل الدخول</button>
                            </div>';
                    } ?>
                    <a href="cart.php" style="hover-color: rgb(156, 148, 124); "><i class='bx bxs-cart-alt' style="font-size: 30px; color:#033135;"></i></a>
            </div>
        </div>
    </header>
    </div>
    </section>

    <!-- your code -->
    <div class="login">
        <div class="wapper">
            <h1 Style="color:#033135;">
                انشاء حساب جديد
            </h1>
            <div class="form">
            <div class="right item">

            <form action="" method="POST" >
            <input type="hidden" name="form_type" value="signup">

                    <div class="input-box">
                        <input type="text" id="first-name" name="first-name" placeholder="الاسم الاول" required>
                    </div>

                    <div class="input-box">
                        <input type="text" id="middle-name" name="middle-name" placeholder="اسم الاب" required>
                    </div>

                    <div class="input-box">
                        <input type="text" id="last-name"  name="last-name" placeholder="اسم العائلة" required>
                    </div>

                    <div class="input-box">
                        <input type="text" id="city" name="city" placeholder="المدينة" required>
                    </div>
                </div>

                <div class="left item">
                    <div class="input-box">
                        <input type="email" id="email" name="email" placeholder="البريد الالكتروني" required>
                    </div>

                    <div class="input-box">
                        <input type="text" id="phone" name="phone" placeholder="رقم الجوال" required>
                    </div>


                    <div class="input-box item">
                        <input type="password" id="password" name="password" placeholder="كلمة المرور" required>
                    </div>

                    <div class="input-box item">
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="تأكيد كلمة المرور" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn"name="form_type" Style="background-color:#033135;  color:#ffff;">تسجيل</button>
            <div class="error-message" style="color: red;">
    <?php echo $error; ?>
</div>
            </form>


        </div>
    </div>

    
<script>
var passwordInput = document.getElementById('password');
var confirmPasswordInput = document.getElementById('confirm-password');
var phone = document.getElementById('phone');
var fName = document.getElementById('first-name');
var mName = document.getElementById('middle-name');
var lName = document.getElementById('last-name');

// add event listener to inputs
passwordInput.addEventListener('input', checkPassword);
confirmPasswordInput.addEventListener('input', checkPassword);
phone.addEventListener('input', checkPhone);
fName.addEventListener('input', checkFName);
mName.addEventListener('input', checkMName);
lName.addEventListener('input', checkLName);

var pattern = /^([^0-9]*)$/;

function showSuccessMessage(message) {
  var messageElement = document.createElement("div");
  messageElement.className = "success-message";
  messageElement.textContent = message;
  document.body.appendChild(messageElement);
}
function showErrorMessage(message) {
  var messageElement = document.createElement("div");
  messageElement.className = "error-message";
  messageElement.textContent = message;
  document.body.appendChild(messageElement);
}

// check if password inputs match
function checkPassword() {
  if (passwordInput.value == confirmPasswordInput.value) {
    confirmPasswordInput.setCustomValidity('');
    if ( passwordInput.value.length < 6 || passwordInput.value.length > 20) 
    confirmPasswordInput.setCustomValidity('كلمة المرور يجب أن تحتوي على 6 الى 20 حرف أو رقم');
  } else {
    confirmPasswordInput.setCustomValidity('كلمة المرور غير متطابقة');
  }
}

//check phone number
function checkPhone() {
    if(phone.value.length == 10) {
        if(phone.value.slice(0,2) == '05')
            phone.setCustomValidity('');
        else
        phone.setCustomValidity('يجب ان يبدأ رقم الهاتف بالرقمين 05');
    } else {
        phone.setCustomValidity('يجب ان يتكون رقم الهاتف من 10 أرقام');
    }
}
function checkFName() {
  var checkName = fName.value.match(/^[\u0621-\u064Aa-zA-Z]+$/);
    console.log(checkName);
    if(checkName) {
        fName.setCustomValidity('');
    } else {
        fName.setCustomValidity('يجب ان لا يحتوي الإسم على رقم ');
    }
}
function checkMName() {
  var checkName = mName.value.match(/^[\u0621-\u064Aa-zA-Z]+$/);
    console.log(checkName);
    if(checkName) {
        mName.setCustomValidity('');
    } else {
        mName.setCustomValidity('يجب ان لا يحتوي الإسم على رقم ');
    }
}
function checkLName() {
  var checkName = lName.value.match(/^[\u0621-\u064Aa-zA-Z]+$/);
    if(checkName) {
        lName.setCustomValidity('');
    } else {
        lName.setCustomValidity('يجب ان لا يحتوي الإسم على رقم ');
    }
}


    </script>


    







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


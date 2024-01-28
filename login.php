<?php
 include "includes/DBConnection.php";

// Check if the sign-in form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get email and password from form
    $email = $_POST['email'];
    $password = $_POST['password'];

// prepare and execute SQL query
$stmt = $conn->prepare("SELECT * FROM sales_admin WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// check if user exists in database
if ($result->num_rows == 1) {

    // fetch user data from database 
    $row = $result->fetch_assoc();
    if ($row['Password'] == $password) {

    // redirect to dashboard or home page 
    $_SESSION['loggedin'] = true;
     $_SESSION['email'] = $email;
    $_SESSION['admin_id'] = $row['Admin_id'];
    header("Location:  Admin_pages\Display_productNew.php"); exit();
    }else {
       $error  = 'كلمة المرور غير صحيحة';
    } 
}

    // Prepare and execute SQL query
    $stmt = $conn->prepare("SELECT * FROM customer WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists in database
    if ($result->num_rows == 1) {
        // Fetch user data from database
        $row = $result->fetch_assoc();

        if ($row['Password'] == $password) {
            // Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['customer_id'] = $row['Customer_id'];

            // Check if "Remember Me" checkbox is checked
            if (isset($_POST['remember_me'])) {
                // Set cookies for the email and password fields
                setcookie('email', $_POST['email'], time() + 86400 * 30, '/');
                setcookie('password', $_POST['password'], time() + 86400 * 30, '/');
            } else {
                // Delete the cookies for the email and password fields
                setcookie('email', '', time() - 3600, '/');
                setcookie('password', '', time() - 3600, '/');
            }

            // Redirect to dashboard or home page
            header("Location: index.php");
            exit();
        } else {
            // Display error message
            $error = 'كلمة المرور غير صحيحة';
        }
    } else {
        // Display error message
        $error = 'هذا البريد الإلكتروني غير مسجل، اختر تسجيل جديد';
    }

   
}
?>
    
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Libre+Baskerville:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
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
.btn{
    background-color:#033135;
}
.btn.btn-success{
background-color:#af9d80;
    color:#ffff;
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

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" style="margin-left: 1rem;">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="عن ماذا تبحث؟" aria-label="Search" style="background: transparent !important; border-color: black !important;">
                </form>
                <a href="cart.php" style="hover-color: rgb(255, 193, 7);  color:#033135;"><i class='bx bxs-cart-alt' style="font-size: 30px;"></i></a>

            </div>
        </div>
    </header>
    </div>
    </section>

    <!-- your code -->
    <div class="login" >
        <div class="wapper" Style="  box-shadow: 0 0 10px rgb(255, 255, 255, .2);" >
        <form action="login.php" method="post">
    <h1 Style="color:#;">تسجيل الدخول</h1>
    <?php if (isset($error)) {
         echo "<span class='error-message'>$error</span>"; 
         } ?> 

    <div class="input-box">
        <input type="email" placeholder="البريد الإلكتروني" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required name="email" id="email"  >
        <i class='bx bxs-user'></i>
    </div>
    <div class="input-box">
        <input type="password" placeholder="كلمة المرور" required name="password" id="password" >
        <i class='bx bxs-lock-alt'></i>
    </div>
    <div class="remembr-forget">
        <label for="remember-me">
            <input type="checkbox" id="remember-me" name="remember_me">تذكرني
        </label>
        <a href="#">هل نسيت كلمة المرور؟</a>
    </div>
    <button type="submit" class="btn" name="login" Style=" background-color:#033135; color:#ffff;" onclick="location.href ='index.php';" >تسجيل الدخول</button>
    <div class="register-link">
        <p>ليس لديك حساب؟
            <a href="signUp.php">تسجيل جديد</a>
        </p>
    </div>
</form>
        </div>
    </div>

    <script>
        var signINpass = document.getElementById('password');
        signINpass.addEventListener('input', checkSPassword);
        function checkSPassword() { 
    if ( signINpass.value.length < 6 || signINpass.value.length > 20) 
    signINpass.setCustomValidity('كلمة المرور يجب أن تحتوي على 6 الى 20 حرف أو رقم');
   else 
   signINpass.setCustomValidity('');
  
}

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


        </script>

<style>

.error-message {
    color: red;
    font-size: 14px;
    margin-top: 10px;
    background-color: #ffe6e6;
    display: block;
    border-right: 4px solid #ff3333;
    padding: 6px 6px; 
    font-weight: bold;
    font-family: 'Dubai', sans-serif; 
    border-radius: 5px;
}
</style>




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

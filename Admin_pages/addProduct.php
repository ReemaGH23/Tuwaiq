<?php  include "../includes/DBConnection.php";


if (isset($_POST["insertBtn"])) {
    
  // Get the form data
  $title = $_POST["title"];
  $description = $_POST["description"];
  $price = $_POST["price"];
  $quantity = $_POST["quantity"];
  $category_id = $_POST["category_id"];
  $brand = $_POST["brand"];
  $color = $_POST["color"];
  $insurance = $_POST["insurance"];
   echo $title."-".$description."-".$price."-".$quantity."-".$brand."-";
   echo $color."-".$insurance ;
  // Validate the form data (you can add more validation rules if needed)
  if (empty($title) || empty($description) || empty($price)) {
      // Set an error message and redirect back to the form
      $_SESSION["error"] = "Please fill in all the required fields.";
     
  }

  $conn = new mysqli($servername, $username, $password, $myDB);

  // Check if the connection is successful
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

      // Set the parameter values
      $date = date("Y-m-d");
      $status = "معروض للبيع"; // Set the status to "Active" by default
      $admin_id = 1; // Replace with the actual admin ID
      $offer_id = 0; // Replace with the actual offer ID
      $no_of_sits = 0; // Replace with the actual number of sits

  // Prepare the SQL statement
  $sql = $conn->prepare("INSERT INTO product (category_id, title, Price, description, date, Status, 
                          Admin_id, Quantity, Offer_id,  brand, insurance, color) 
          VALUES ('$category_id', '$title', '$price', '$description', '$date', '$status',
        '$admin_id', '$quantity', '$offer_id', '$brand', '$insurance', '$color')");
 

  if($sql->execute()){
    echo "coupon added successfully <br>";


    if(isset($_POST['title']) && isset($_FILES['image'])){
        
        $stmt6 = mysqli_prepare($conn, "SELECT product_id FROM product WHERE title= '$title';");
// Execute the query
        mysqli_stmt_execute($stmt6);
        $result = mysqli_stmt_get_result($stmt6);
        $row = mysqli_fetch_assoc($result);
        $product_id= $row["product_id"];
        $name = $_POST["title"];
        $image_name = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        if ($error === 0) {
            if ($image_size > 1250000000) {
                $em = 'حجم الصورة كبير';  
            } else {
                $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $uploads_dir = 'uploads/';
                    move_uploaded_file($tmp_name, $uploads_dir.$image_name);
                    
                    // Prepare the SQL query with placeholders
                    $stmt = mysqli_prepare($conn, "INSERT INTO images (Image_path, Product_ID, Image_name, main_image) VALUES (?, ?, ?, ?)");

                    // Bind the parameters to the placeholders
                     // Replace with the actual product ID
                    $target_file = $uploads_dir.$image_name; // Replace with the actual image path
                    $is_main_image = 1; // Replace with the actual value for the main image flag
                    mysqli_stmt_bind_param($stmt, "sisi", $image_name, $product_id, $name, $is_main_image);

                    // Execute the query
                    mysqli_stmt_execute($stmt);
                } else {
                    $em = 'الصورة يجب أن تكون باحد الصيغ التالية  jpg - jpeg - png';
                }
            }
        } else {
            $em = "حدث خطأ";
        }
    }

  




    

 
      // Set a success message and redirect back to the form
      $_SESSION["success"] = "Product added successfully.";
      
  } else {
      // Set an error message and redirect back to the form
      $_SESSION["error"] = "Failed to add product.";
  }

   } // Close the statement and connection
  mysqli_stmt_close($stmt);

  
    // Redirect back to the Display_productNew.php page
   header("Location: Display_productNew.php");
   exit();
?>
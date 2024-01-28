<?php
 include "../includes/DBConnection.php";

// Prepare the SQL query
$stmt = mysqli_prepare($conn, "SELECT * FROM slider ;");
// Execute the query
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
print_r($_FILES['image']);
if(isset($_POST['name'])&& isset($_FILES['image'])){
    echo"here";
    $title = $_POST["name"]; //not null
    //$image_path     = $_POST["img"]; //not null       

    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp_name = $_FILES ['image']['tmp_name'];
    $error = $_FILES ['image']['error'];

    if($error ===0 ){
        if($img_size > 1250000000){
            $em='حجم الصورة كبير ';  
        }else{
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc= strtolower($img_ex);
            $allowed_exs = array("jpg","jpeg","png");

            if (in_array($img_ex_lc, $allowed_exs )){
                if(mysqli_num_rows($result)==3){
                    $sql2=$conn->prepare("DELETE FROM `slider` WHERE image_id = (SELECT MIN(image_id) FROM `slider`)");
                            if( $sql2->execute()){
                                echo "item deleted successfully <br>";
                            } else
                                echo "item delete failed<br>";
                }
             //   $img_uploaded_path = 'website/Admin_pages/uploads'.$newImageName;
               // move_uploaded_file($tmp_name, $img_uploaded_path);

                $uploads_dir = 'uploads/';
                move_uploaded_file($_FILES['image']['tmp_name'], $uploads_dir.$img_name);
                $query = "INSERT INTO `slider`(`image_path`, `Image_name`) VALUES ('$img_name','$title') ";
                mysqli_query($conn, $query);
                header("location:Slider_DisplayAll.php");
            }else{
                $em='الصورة يجب أن تكون باحد الصيغ التالية  jpg - jpeg - png';
            }
        }
    }else{
        $em= "حدث خطأ";
    }

/*

   else{
               if(mysqli_num_rows($result)==3){
            $sql2=$conn->prepare("DELETE FROM `slider` WHERE image_id = (SELECT MIN(image_id) FROM `slider`)");
                    if( $sql2->execute()){
                        echo "item deleted successfully <br>";
                    } else
                        echo "item delete failed<br>";
                }
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
            echo"yes";
            move_uploaded_file($tmpname, 'img/'. $newImageName);
            $query = "INSERT INTO `slider` VALUES ('','$image_name','$newImageName') ";
            mysqli_query($conn, $query);
            echo "<script> alert ('تم إضافة الصورة  '); </script>"; 
        
    }

 */
        
/*$sql2=$conn->prepare("INSERT INTO `slider`( `image_name`, `Image_path`)  VALUES ('$image_name','$image_path')");
if( $sql2->execute()){
     echo "item added successfully <br>";
} else
     echo "item added failed<br>";
     
     if (!$sql2) {
        die("Query failed: " . mysqli_error($conn));
      } else {
        // Display a success message
        echo '<div class="alert alert-success" role="alert">تم تحديث البيانات بنجاح.</div>';
      } */
// header("location:Confirmation.html");

}


?>
<?php

include "../includes/DBConnection.php";
        
// Prepare the SQL query
$stmt = mysqli_prepare($conn, "SELECT * FROM sales_admin WHERE Email = ?");
$email= $_SESSION['email'];
$Admin_id=$_SESSION['admin_id'];
mysqli_stmt_bind_param($stmt, "s", $email);

// Execute the query
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Process the results
while ($row = mysqli_fetch_assoc($result)) {
    $Fristname= $row['First_name'];
    $Middlename=$row['Middle_name'];
    $Lastname=$row['Last_name'];
    $phone=$row['Phone'];
    $Username= $row['Username'];
    $pass= $row['Password'];
	
}

if(isset($_POST['edit']))
 {
    $UpdateFirstname= $_POST['account-fn'];
    $UpdateMiddlename=$_POST['account-mn'];
    $UpdateLastname=$_POST['account-ln'];
    $UpdatePhone=$_POST['account-phone'];
    $UpdateEmail=$_POST['account-email'];
    $UpdatePass= $_POST['pass'];
    $UpdateUsername= $_POST['username'];

    $sql = "UPDATE sales_admin SET First_name='$UpdateFirstname', Middle_name='$UpdateMiddlename', Last_name='$UpdateLastname', Username='$UpdateUsername' , Email='$UpdateEmail', Phone='$UpdatePhone', Password= ' $UpdatePass' where Admin_id='$Admin_id';";
    $result = mysqli_query($conn, $sql);
    
    // Check if the update was successful
    if ($result) {
        echo "<script>alert('User information updated successfully');</script>";
  exit();
        
    } else {
        echo "<script>alert('Error updating user information: ' . mysqli_error($conn));</script>";

  exit();
     
    }

 }

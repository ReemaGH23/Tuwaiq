<?php

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256",$token);

$expiry = date("Y-m-d H:i:s",time() + 60 * 3 );

include "includes/DBConnection.php";

$sql = "UPDATE customer SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email= ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $token_hash, $expiry, $email);
$stmt->execute();

if($conn->affected_rows ){
    echo"f";
    $mail = require "mailer.php";
    echo"f";
    $mail->setFrom("noone82829@gmail.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="localhost/website_3/ResetPassword.php?token=$token">here</a> 
    to reset your password.

    END;

    try {

        $mail->send();

        echo "Message sent, please check your inbox.";

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

    }

}


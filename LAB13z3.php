<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<title>Възстановяване на парола</title>
</head>
<body>
 <div style="width:1400px">
 <div style="text-align: center">
<br>
<h1>Възстановяване на парола</h1>
<br>
<p style="font-weight:bold;font-size:20px">Моля въведете вашия имейл:</p><br>
 </div>
 <div style="height:300px;width:600px;float:left;">
 </div>
 <div style="height:210px; width:800px; float:left;">
<form method="post" action="send_reset_email.php">
 <table style="text-align:left;font-weight:bold">
 <tr>
<td><label for="email">Имейл: </label></td>
<td><input type="text" name="email" id="email"></td>
 </tr>
 <tr>
<td></td>
 <td style="text-align:center">
 <br>
 <input type="submit" name="submit" value="Изпрати">
</td>
 </tr>
 </table>
</form>
 </div>
</div>
 </body>
</html>

<?php
//--------------------------file send_reset_email.php----------------------
$con = mysqli_connect('localhost', 'root', '', 'BD'); 
if (!$con) {
    die('Неуспешно свързване. Получи се следната грешка: ' . mysqli_connect_error());
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];


    $check_query = "SELECT * FROM Users WHERE Email = '$email'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
       
        $token = bin2hex(random_bytes(32)); 
        

        $update_query = "UPDATE Users SET ResetToken = '$token' WHERE Email = '$email'";
        if (mysqli_query($con, $update_query)) {
           
            $to = $email;
            $subject = 'Reset Your Password';
            $message = "Hello,\n\n We have received a request to reset your password. Please click the following link to reset your password:\n\nhttp://example.com/reset_password.php?token=$token\n\nIf you did not request this, please ignore this email.";
            $headers = 'From: your_email@example.com'; 
            mail($to, $subject, $message, $headers);
            
            echo "Изпратено е писмо с инструкции за нулиране на паролата на вашия имейл.";
        } else {
            echo "Получи се следната грешка: " . mysqli_error($con);
        }
    } else {
        echo "Имейлът не е намерен. Моля, опитайте отново.";
    }
}

mysqli_close($con);
?>

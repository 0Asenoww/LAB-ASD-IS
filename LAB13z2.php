<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<title>Регистрация на нов потребител</title>
</head>
<body>
 <div style="width:1400px">
 <div style="text-align: center">
<br>
<h1>Регистрация на нов потребител</h1>
<br>
<p style="font-weight:bold;font-size:20px">Моля въведете вашите данни:</p><br>
 </div>
 <div style="height:300px;width:600px;float:left;">
 </div>
 <div style="height:210px; width:800px; float:left;">
<form method="post" action="register_user.php">
 <table style="text-align:left;font-weight:bold">
 <tr>
<td><label for="new_user">Потребителско име: </label></td>
<td><input type="text" name="new_user" id="new_user"></td>
 </tr>
 <tr>
 <td><label for="new_pass">Парола: </label></td>
 <td><input type="password" name="new_pass" id="new_pass"></td>
 </tr>
 <tr>
 <td><label for="email">Имейл: </label></td>
 <td><input type="text" name="email" id="email"></td>
 </tr>
 <tr>
<td></td>
 <td style="text-align:center">
 <br>
 <input type="submit" name="submit" value="Регистрация">
</td>
 </tr>
 </table>
</form>
 </div>
</div>
 </body>
</html>
<?php
//--------------------------file register_user.php----------------------
$con = mysqli_connect('localhost', 'root', '', 'BD'); 
if (!$con) {
    die('Неуспешно свързване. Получи се следната грешка: ' . mysqli_connect_error());
}

if (isset($_POST['new_user']) && isset($_POST['new_pass']) && isset($_POST['email'])) {
    $new_user = $_POST['new_user'];
    $new_pass = $_POST['new_pass'];
    $email = $_POST['email'];
    $check_query = "SELECT * FROM Users WHERE Username = '$new_user'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Потребителското име вече съществува. Моля изберете друго.";
    } else {
        $insert_query = "INSERT INTO Users (Username, Password, Email) VALUES ('$new_user', '$new_pass', '$email')";
        if (mysqli_query($con, $insert_query)) {
            echo "Регистрацията е успешна. Добре дошли, $new_user! Потвърдете вашия имейл.";
            
         
            $to = $email;
            $subject = 'Потвърждение на регистрация';
            $message = "Здравей, $new_user! Благодарим ви за регистрацията. Моля, потвърдете вашия имейл.";
            $headers = 'From: your_email@example.com'; // Update with your email
            mail($to, $subject, $message, $headers);
        } else {
            echo "Получи се следната грешка: " . mysqli_error($con);
        }
    }
}

mysqli_close($con);
?>
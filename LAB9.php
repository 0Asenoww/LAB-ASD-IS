<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<title>Форма за вход</title>
</head>
<body>
 <div style="width:1400px">
 <div style="text-align: center">
<br>
<h1>Необходимо е да влезнете в системата за да продължите:</h1>
<br>
<p style="font-weight:bold;font-size:20px">Моля въведете вашите потребителско име и парола:</p><br>
 </div>
 <div style="height:300px;width:600px;float:left;">
 </div>
 <div style="height:210px; width:800px; float:left;">
<form method="post" action="script.php">
 <table style="text-align:left;font-weight:bold">
 <tr>
<td><label for="users"> Username: </label></td>
<td><input type="text" name="Username" id="users"></td>
 </tr>
 <tr>
 <td><label for="pass"> Password: </label></td>
 <td><input type="password" name="Pass" id="pass"></td>
 </tr>
 <tr>
<td></td>
 <td style="text-align:center">
 <br>
 <input type="submit" name="submit" value="Вход">
</td>
 </tr>
 <tr>
<td colspan="2" style="text-align:center">
 <br>
 <a href="forgot_password.php">Забравена парола</a> | 
 <a href="register.php">Регистрация на нов потребител</a>
</td>
 </tr>
 </table>
</form>
 </div>
</div>
 </body>
</html>

<?php
//--------------------------file forma.php----------------------
$con = mysqli_connect('localhost', 'root', '', 'BD'); 
if (!$con) {
    die('Неуспешно свързване. Получи се следната грешка: ' . mysqli_connect_error());
}

$query = "SELECT * FROM Users";
$dbreg = mysqli_query($con, $query);
if (!$dbreg) {
    die('Получи се следната грешка: ' . mysqli_error($con));
}

$users = $_POST['Username'];
$pass = $_POST['Pass'];

while ($value = mysqli_fetch_array($dbreg)) {
    if ($users == $value['Username']) {
        break;
    }
}

if ($users == $value['Username'] && $pass == $value['Password']) {
    echo 'Здравей ' . $value['Username'] . '. Вие успешно влезнахте в системата';
} else {
    echo "Невалиден потребителско име или парола";
}

mysqli_close($con);
?>

<?php
//zad 2
//--------------------------file register_user.php----------------------
$con = mysqli_connect('localhost', 'root', '', 'BD'); 
if (!$con) {
    die('Неуспешно свързване. Получи се следната грешка: ' . mysqli_connect_error());
}

if (isset($_POST['new_user']) && isset($_POST['new_pass'])) {
    $new_user = $_POST['new_user'];
    $new_pass = $_POST['new_pass'];

    // Check if the username already exists
    $check_query = "SELECT * FROM Users WHERE Username = '$new_user'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Потребителското име вече съществува. Моля изберете друго.";
    } else {
        // Insert new user into the database
        $insert_query = "INSERT INTO Users (Username, Password) VALUES ('$new_user', '$new_pass')";
        if (mysqli_query($con, $insert_query)) {
            echo "Регистрацията е успешна. Добре дошли, $new_user!";
        } else {
            echo "Получи се следната грешка: " . mysqli_error($con);
        }
    }
}

mysqli_close($con);
?> 

<?php
//zad 3
//--------------------------file recover_password.php----------------------
$con = mysqli_connect('localhost', 'root', '', 'BD'); 
if (!$con) {
    die('Неуспешно свързване. Получи се следната грешка: ' . mysqli_connect_error());
}

if (isset($_POST['recover_user'])) {
    $recover_user = $_POST['recover_user'];

    // Check if the username exists
    $check_query = "SELECT * FROM Users WHERE Username = '$recover_user'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Потребителското име е намерено. Можете да възстановите вашата парола.";
        // Here, you can add additional steps to reset the password, such as displaying a form to set a new password.
    } else {
        echo "Потребителското име не е намерено. Моля, опитайте отново.";
    }
}

mysqli_close($con);
?>
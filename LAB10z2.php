<!-- login.php -->
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<title>Вход</title>
</head>
<body>
 <div style="text-align:center">
    <h1>Вход</h1><br>
    <form method="post" action="login.php">
        <label for="username">Потребителско име: </label>
        <input type="text" name="username" id="username"><br>
        <label for="password">Парола: </label>
        <input type="password" name="password" id="password"><br>
        <input type="submit" name="submit" value="Вход">
    </form>
 </div>
</body>
</html>
<?php
// login.php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'ShoppingCenter');
if (!$con) {
    die('Неуспешно свързване. Получи се следната грешка: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: add_employee.php");
        exit();
    } else {
        echo "Невалидно потребителско име или парола.";
    }

    mysqli_close($con);
}
?>
<!-- add_employee.php -->
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<title>Нови служители</title>
<script type="text/javascript">
function validateForm() {
    var firstName = document.getElementById("FirstName").value;
    var secondName = document.getElementById("SecondName").value;
    var lastName = document.getElementById("LastName").value;
    var dogovor = document.getElementById("dogovor").value;
    var dlajnost = document.getElementById("dlajnost").value;
    var adress = document.getElementById("adress").value;
    var telephon = document.getElementById("telephon").value;

    if (!firstName  !secondName  !lastName  !dogovor  !dlajnost  !adress  !telephon) {
        alert("Моля, попълнете всички полета.");
        return false;
    }
    return true;
}
</script>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    die("Нямате необходимите права за достъп до тази страница.");
}
?>
 <div style="width:1000px">
    <div style="text-align:center">
        <h1>Въведи необходимата информация за новия служител</h1><br>
    </div>
    <form method="post" action="script.php" onsubmit="return validateForm()"> 
        <div style="height:100px;width:140px;float:left;">
        </div>
        <div style="height:100px; width:380px; float:left;">
            <table style="text-align:left;font-weight:bold">
                <tr>
                    <td><label for="FirstName"> Име: </label></td>
                    <td><input type="text" name="FirstName" id="FirstName"></td>
                </tr>
                <tr>
                    <td><label for="SecondName"> Презиме: </label></td>
                    <td><input type="text" name="SecondName" id="SecondName"></td>
                </tr>
                <tr>
                    <td><label for="LastName"> Фамилия: </label></td>
                    <td><input type="text" name="LastName" id="LastName"></td>
                </tr>
            </table>
</div>
        <div style="height:100px; width:380px; float:left;">
            <table style="text-align:left;font-weight:bold">
                <tr style="height:10px"></tr>
                <tr>
                    <td><label for="dogovor"> Номер на договор: </label></td>
                    <td><input type="text" name="dogovor" id="dogovor"></td>
                </tr>
                <tr>
                    <td><label for="dlajnost"> Заемана длъжност: </label></td>
                    <td><input type="text" name="dlajnost" id="dlajnost"></td>
                </tr>
            </table>
        </div>
        <div style="margin-left:140px;">
            <table style="text-align:left;font-weight:bold">
                <tr>
                    <td style="width:75px"><label for="adress"> Адрес: </label></td>
                    <td><input type="text" name="adress" id="adress"></td>
                    <td style="width:135px"></td>
                    <td style="width:140px"><label for="telephon"> Телефон: </label></td>
                    <td><input type="text" name="telephon" id="telephon"></td>
                </tr>
</table>
        </div>
        <div style="height:30px"></div>
        <div style="text-align:center">
            <span> <input type="submit" name="submit" value="Запис"> </span>
        </div>
    </form>
 </div>
</body>
</html>
<?php
// script.php
session_start();
if (!isset($_SESSION['username'])  $_SESSION['role'] != 'admin') {
    die("Нямате необходимите права за добавяне на служители.");
}

$con = mysqli_connect('localhost', 'root', '', 'ShoppingCenter');
if (!$con) {
    die('Неуспешно свързване. Получи се следната грешка: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Fname = $_POST['FirstName'];
    $Sname = $_POST['SecondName'];
    $Lname = $_POST['LastName'];
    $NDog = $_POST['dogovor'];
    $dlajnost = $_POST['dlajnost'];
    $adress = $_POST['adress'];
    $tel = $_POST['telephon'];

    // Check if all fields are filled
    if (empty($Fname)  empty($Sname)  empty($Lname)  empty($NDog)  empty($dlajnost)  empty($adress) || empty($tel)) {
        die('Моля, попълнете всички полета.');
    }

    $query = "INSERT INTO employees (EmployeeID, FirstName, SecondName, LastName, ContractNumber, Position, address, Telephon) VALUES ('0', '$Fname', '$Sname', '$Lname', '$NDog', '$dlajnost', '$adress', '$tel')";
    $dbreg = mysqli_query($con, $query);

    if (!$dbreg) {
        die('Получи се следната грешка: ' . mysqli_error($con));
    } else {
        echo "Вие успешно добавихте информацията за новия служител";
    }

    mysqli_close($con);
}
?>
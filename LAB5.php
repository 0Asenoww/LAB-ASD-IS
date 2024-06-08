<?php
$conn=mysqli_connect('localhost', 'root', '', 'firma', '3308') or die(mysqli_connect_error());
echo "Connection to the server was succesfull! <br/>";
mysqli_select_db($conn, "firma") or die(mysqli_error($conn));
echo "Database was selected! <br/>";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Products</title>
</head>
<body>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "firma";
	$port = "3308";

    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO Products (NameOfProduct, Description, Price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $description, $price);


    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if ($stmt->execute() === TRUE) {
        echo "Product added succesfully!";
    } else {
        echo "Error: " . $stmt . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<h2>Add new product</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    NameOFProduct: <input type="text" name="name"><br>
  Description: <input type="text" name="description"><br>
    Price: <input type="text" name="price"><br>
    <input type="submit" value="Add Product">
</form>

</body>
</html>

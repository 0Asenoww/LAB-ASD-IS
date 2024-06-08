<?php
$conn=mysqli_connect('localhost', 'root', '', 'firma', '3308') or die(mysqli_connect_error());
echo "Connection to the server was succesfull! <br/>";
mysqli_select_db($conn, "firma") or die(mysqli_error($conn));
echo "Database was selected! <br/>";



$sql = "SELECT Description FROM Products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 
    $result->data_seek(2);
 
    $row = $result->fetch_row();
 
    echo "Description of the third record: " . $row[0];
} else {
    echo "No data.";
}


$conn->close();
?>
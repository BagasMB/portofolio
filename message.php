<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "message";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}
// echo "Connected successfully";
?>


<?php

if (isset($_POST['submit'])) {
    global $conn;
    $name = mysqli_real_escape_string ($conn, $_POST['name']);
    $email = mysqli_real_escape_string ($conn, $_POST['email']);
    $no_hp = mysqli_real_escape_string ($conn, $_POST['no_hp']);
    $message = mysqli_real_escape_string ($conn, $_POST['message']);

    $sql = "INSERT INTO `message`(`id`, `name`, `email`, `no_hp`, `message`) VALUES ('','$name','$email','$no_hp','$message')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.html#contact");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

?>
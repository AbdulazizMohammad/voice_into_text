<?php
define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB', 'robot');

$con = mysqli_connect(HOST, USERNAME, PASSWORD, DB);

$text = $_POST['text'];

$sql = "insert into speeches (text) values ('$text')";

if (mysqli_query($con, $sql)) {
    echo 'success';
}
mysqli_close($con);
?>
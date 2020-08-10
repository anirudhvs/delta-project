<?php
$conn = mysqli_connect('db','root','root1234','onelink');
if(!$conn){
echo "Connection Error " . mysqli_connect_error();
}
?>

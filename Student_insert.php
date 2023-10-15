<?php
$conn = mysqli_connect('localhost','root','','ajax');
extract($_POST);
$sql = "insert into student(name,age,email) Values ('$name','$age','$email')";
$query = mysqli_query($conn,$sql);  

?>
<?php
$conn = mysqli_connect('localhost','root','','ajax');
if(isset($_POST['hiddenuserid'])){
    $id = $_POST['hiddenuserid'];
    $name = $_POST['nam'];
    $age = $_POST['agea'];
    $email = $_POST['emai'];
    $sql = "Update student set name='$name',age='$age',email='$email' where id='$id'";
    $query = mysqli_query($conn,$sql);
}

?>
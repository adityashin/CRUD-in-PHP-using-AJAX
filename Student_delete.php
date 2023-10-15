<?php
$conn = mysqli_connect('localhost','root','','ajax');
if(isset($_POST['deleteid'])){
    $id = $_POST['deleteid'];
    $sql = "delete from student where id='$id'";
   mysqli_query($conn,$sql);
}


?>
<?php
$conn = mysqli_connect('localhost','root','','ajax');
if(isset($_POST['id']) && isset($_POST['id'])!=''){
$id = $_POST['id'];
$sql = "select * from student where id = '$id'";
$query = mysqli_query($conn,$sql);

$response = array();

if(mysqli_num_rows($query)>0){
    while($data = mysqli_fetch_array($query)){
        $response = $data;
    }
}
 echo json_encode($response);
}

?>
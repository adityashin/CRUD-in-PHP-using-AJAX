<?php
$conn = mysqli_connect('localhost','root','','ajax');
if(isset($_POST['readrecord'])){
  $table ="<table class='table'>
    <thead>
      <tr>
        <td>Sr.No</td>
        <td>Name</td>
        <td>Age</td>
        <td>Email</td>
        <td>Update Action</td>
        <td>Delete Action</td>
      </tr>
    </thead>
  <tbody>";
  $sql = "select * from student";
  $query = mysqli_query($conn,$sql) ;
  if(mysqli_num_rows($query) >0){
    $number = 1;
    while($data = mysqli_fetch_array($query)){
     $table .="<tr>
        <td>". $number  ."</td>
        <td>". $data['name'] ."</td>
        <td>". $data['age']."</td>
        <td>". $data['email'] ."</td>
        <td>
          <button class='btn btn-primary' onclick='updateuser(".$data['id'] .")' >Update</button>
        </td>
        <td>
        <button class='btn btn-danger' onclick='deleteuser(".$data['id'] .")'>Delete</button>
        </td>
      </tr>";
      $number++;
    }
  }
  $table .="
  </tbody>
  </table>";
  echo $table;
}

?>
<?php

if(isset($name) || isset($gmail) || isset($password) || isset($Comment)){

echo $_POST["name"];
echo $_POST["gmail"];
echo $_POST["password"];
echo $_POST["Comment"];
}

$conn=new mysqli('localhost','root','','test1');
if($conn->connect_error){
    die('Connection Failed :'.$conn->connect_error);
}
else{

    $stmt=$conn->prepare("insert into CONTECT_US(name,gmail,password,Comment)
value(?,?,?,?)");
$stmt->bind_param("vvvv",$name,$gmail,$password,$Comment);
$stmt->execute();
echo "Your information upload successfully...";
$stmt->close();
$conn->close();
}

?>
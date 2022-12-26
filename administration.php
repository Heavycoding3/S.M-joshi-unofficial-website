<?php  session_start();

$servername="localhost";
$username="root";
$password="";
$dbname="keyboard";

$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){

    die("connecction fail");
}

$name=$_POST['name'];
$number=$_POST['number'];
$gmail=$_POST['gmail'];
$password=$_POST['password'];


$sql="INSERT INTO student('name','number','gmail','password') VALUES('$name',$number','$gmail','$password')";

if($conn->query($sql)==true){

    echo "new record added";
}
else{
    echo "Error";
}
$conn->close();

?>

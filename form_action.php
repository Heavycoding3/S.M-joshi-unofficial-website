<?php require_once("config.php");
if(isset($_POST['form_submit']))
{
    $fname=trim($_POST['fname']);
    $mname=trim($_POST['mname']);
    $lname=trim($_POST['lname']);
    $dob=trim($_POST['dob']);
    $gender=trim($_POST['gender']);
    $category=trim($_POST['category']);
    $course=trim($_POST['course']);
    $address=trim($_POST['address']);
    $email=trim($_POST['email']);
    $mobileno=trim($_POST['mobileno']);
    $image=trim($_POST['image']);
    $simage=trim($_POST['simage']);
    $pay_status='PAID';
    $course_fees='8000';
    $res_no='TS'.rand(99,10).time();
    $folder="uploads/";
    $image_file=$_FILES['image']['name'];
    $file=$_FILES['image']['tmp_name'];
    $path=$folder.$image_file;
    $file_name_array=explode(".",$image_file);
    $extension = end($file_name_array);
    $new_image_name = 'photo_'.rand() . '.' . $extension;
    
    $simage_file=$_FILES['simage']['name'];
    $sfile=$_FILES['simage']['tmp_name'];
    $spath=$folder.$simage_file;
    $file_name_array=explode(".",$simage_file);
    $extension = end($file_name_array);
    $snew_image_name = 'sign_'.rand() . '.' . $extension;

    if($file!='')
    {
        move_uploaded_file($file, $folder . $new_image_name);
    }
    if($sfile!=''){
        move_uploaded_file($sfile, $folder . $snew_image_name);
    }
    $sql="INSERT INTO  admissiondata(fname,mname,lname,gender,dob,address,category,course,email,mobileno,pay_status,course_fees,reg_no,image,sign)
    VALUES(:fname,:mname,:lname,:gender,:dob,:address,:category,:course,:email,:mobileno,:pay_status,:course_fees,:reg_no,:image,:sign)";
    $stmt=$db->prepare($sql);
    $stmt->bindParam(':reg_id',$reg_id,PDO::PARAM_STR);
    $stmt->bindParam(':fname',$fname,PDO::PARAM_STR);
    $stmt->bindParam(':mname',$mname,PDO::PARAM_STR);
    $stmt->bindParam(':lname',$lname,PDO::PARAM_STR);
    $stmt->bindParam(':gender',$gender,PDO::PARAM_STR);
    $stmt->bindParam(':dob',$dob,PDO::PARAM_STR);
    $stmt->bindParam(':address',$address,PDO::PARAM_STR);
    $stmt->bindParam(':category',$category,PDO::PARAM_STR);
    $stmt->bindParam(':course',$course,PDO::PARAM_STR);
    $stmt->bindParam(':email',$email,PDO::PARAM_STR);
    $stmt->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
    $stmt->bindParam(':pay_status',$pay_status,PDO::PARAM_STR);
    $stmt->bindParam(':course_fees',$course_fees,PDO::PARAM_STR);
    $stmt->bindParam(':reg_no',$reg_no,PDO::PARAM_STR);
    $stmt->bindParam(':image',$new_image_name,PDO::PARAM_STR);
    $stmt->bindParam(':sign',$snew_image_name,PDO::PARAM_STR);
$stmt->execute();
$last_id=$db->lastInsertId();
if($last_id=!'')
{
    header("location:preview.php?id=".$reg_no);
}
else{
    echo "Something went wrong";
}
}
?>

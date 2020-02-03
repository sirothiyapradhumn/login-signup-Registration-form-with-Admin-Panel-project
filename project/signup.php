<?php
include ("include/header.php");
include ("include/config.php");
include ("include/functions.php");
$msg='';$msg1='';$msg2='';$msg3='';$msg4='';$msg5='';$msg6='';$msg7='';$msg8='';
if(isset($_POST['submit']))
{
$firstname=$_POST['fname'];
$lastname=$_POST['lname'];
$email=$_POST['mail'];
$date=$_POST['dob'];
$password=$_POST['pass'];
$c_password=$_POST['cpass'];
$image=$_FILES['image']['name'];
$tmp_image=$_FILES['image']['tmp_name'];
$size_image=$_FILES['image']['size'];
$checkbox=isset($_POST['check']);
  //echo $firstname."</br>".$lastname."</br>".$email."</br>".$date."</br>".$password."</br>"
  //.$c_password."</br>".$image."</br>".$checkbox;
  if(strlen($firstname)<3)
  {
    $msg="<div class ='error'>First name must contain atleast 3 character</div>";
  }
  else if(strlen($lastname)<3)
  {
    $msg1="<div class ='error'>Last name must contain atleast 3 character</div>";
  }
  else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    $msg2="<div class ='error'>Enter valid email</div>";
  }
  else if(email_exists($email,$con))
  {
    $msg2="<div class ='error'>Email already exists</div>";
  }
  else if(empty($date))
    {
        $msg3="<div class='error'>Please Enter your date of birth</div>";
    }
 else if (empty($password))
 {
   $msg4="<div class='error'>Please enter your password</div>";
 }
  else if(strlen($password)<5)
  {
  $msg4="<div class='error'>Password must contain atleast 5 character</div>";
  }
  else if($password!==$c_password)
  {
    $msg5="<div class='error'>Password didn't match</div>";
  }
  else if($image=='')
  {
    $msg6="<div class='error'>PLease upload the image</div>";
  }
  else if($size_image>=1000000)
  {
  $msg6="<div class='error'>PLease upload the image less than 1 MB</div>";
  }
else if($checkbox=='')
{
  $msg7="<div class='error'>Please Agree our Terms and Conditions</div>";
}
else {

  $password=md5($password);
  $img_ext=explode(".",$image);
  $image_ext=$img_ext['1'];
  $image=rand(1,1000).rand(1,1000).time().".".$image_ext;
  if($image_ext=='jpg' || $image_ext=='png' || $image_ext=='jpge')
  {
    move_uploaded_file($tmp_image,"images/$image");
  mysqli_query($con,"INSERT INTO users(first_name,last_name,mail,dob,password,img)VALUES('$firstname','$lastname','$email','$date','$password','$image')");
  $msg8="<div class = 'success'><center>You are Successfully Register</center></div>";
  $firstname='';$lastname='';$email='';$date='';$password='';$c_password='';$image='';
}
else
{
$msg6="<div class='error'>Please upload the image file</div>";
}
}
}

 ?>
 <title>Sign Up Form</title>
</head>
<style type = 'text/css'>
#body-bg
{
  background: url("images/bg.jpg") center no-repeat fixed;
}
.error
{
color:red;
}
.success
{
  color:green;
  font-weight:bold;
}
</style>
<body id='body-bg'  >
<div class = 'container'>
  <div class = 'login-form col-md-6 offset-md-3'>
    <div class = 'jumbotron' style = 'margin-top:20px;padding-top:20px;padding-bottom:20px;'>
<h3 align ='center'>Sign Up Form</h3></br>
<?php echo $msg8; ?></br>
<form method ='post' enctype="multipart/form-data">
  <div class = "form-group">
<lable>First Name : </lable>
<input type ='text' name= 'fname' placeholder="Your First Name" class = 'form-control' value='<?php echo $firstname; ?>'>
<?php echo $msg; ?>
</div>
<div class = "form-group">
<lable>Last Name : </lable>
<input type ='text' name= 'lname' placeholder=" Your First Name" class = 'form-control' value='<?php echo $lastname; ?>'>
<?php echo $msg1 ; ?>
</div>
<div class = "form-group">
<lable>Email : </lable>
<input type ='email' name= 'mail' placeholder="Your Email" class = 'form-control' value='<?php echo $email; ?>'>
<?php echo $msg2; ?>
</div>
<div class = "form-group">
<lable>Date Of Birth : </lable>
<input type ='date' name= 'dob' placeholder="Your DOB" class = 'form-control' value='<?php echo $date; ?>'>
<?php echo $msg3 ; ?>
</div>
<div class = "form-group">
<lable>Password : </lable>
<input type ='password' name= 'pass' placeholder="Password" class = 'form-control' value='<?php echo $password; ?>'>
<?php echo $msg4 ; ?>
</div>
<div class = "form-group">
<lable>Re-Enter Password : </lable>
<input type ='password' name= 'cpass' placeholder="Re-enter Password" class = 'form-control' value='<?php echo $c_password; ?>'>
<?php echo $msg5 ; ?>
</div>
<div class = "form-group">
<lable>Profile Image : </lable><br>
<input type ='file' name= 'image' value='<?php echo $image; ?>' >
<?php echo $msg6 ; ?>
</div>
<div class = "form-group">
<input type ='checkbox' name= 'check' >
I Agree the terms and conditions
<?php echo $msg7 ; ?>
</div></br>
<center><input type ='submit' value='Submit' name='submit' class= 'btn btn-success'></center></br>
<center><a href='login.php'>Already Registered ?</a></center>
</form>
</div>
</div>
</div>
</body>
</html>

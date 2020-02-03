<?php
include ("include/header.php");
include ("include/config.php");
include ("include/functions.php");
$msg='';$msg1='';$msg2='';$msg3='';$msg4='';
$email='';$date='';$password='';$cpassword='';
if(isset($_POST['submit']))
{
  $email=$_POST['email'];
  $date=$_POST['dob'];
  $password=$_POST['pass'];
  $cpassword=$_POST['cpass'];
  if(empty($email))
  {
    $msg="<div class='error'>Enter your email</div>";
  }
  else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
  {
    $msg="<div class='error'>Please Enter Your Valid Email</div>";
  }
  else if(empty($date))
  {
    $msg1="<div class='error'>Please Enter Date</div>";
  }
  else if(empty($password))
  {
    $msg2="<div class='error'>Please Enter Password</div>";
  }
  else if(strlen($password)<=4)
  {
    $msg2="<div class='error'>password must contain atleast 5 characters</div>";

  }
  else if(empty($cpassword))
  {
    $msg3="<div class='error'>Please Re-Enter Password</div>";
  }
  else if($password!=$cpassword)
  {
    $msg3="<div class='error'>Password Dosen't matche</div>";
  }
  else if (email_exists($email,$con))
  {
   $result=mysqli_query($con,"SELECT dob FROM users WHERE mail='$email'");
   $retrive=mysqli_fetch_array($result);
   $DOB=$retrive['dob'];
   if($date==$DOB)
   {
     $pass=md5($password);
     mysqli_query($con,"UPDATE users SET password='$pass'");
     $msg4="<div class='success'>Password Change Successfully</div>";

   }
   else {
     $msg1="<div class='error'>DOB is worng</div>";
   }
  }
  else {
    $msg="<div class='error'>Email does't exist</div>";

  }



}
 ?>
 <title>Forgot Password</title>
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
    <div class = 'jumbotron' style = 'margin-top:20px;padding-top:20px;padding-bottom:30px;'>
<h3 align ='center'>Forgot Password</h3></br>
<center><?php echo $msg4 ; ?></center></br>
<form method ='post' >
  <div class ='form-group'>
    <lable>Email :</lable>
    <input type='email' name='email' class='form-control' placeholder="Enter Your Email" value="<?php echo $email; ?>">
    <?php echo $msg; ?>
 </div>

 <div class ='form-group'>
   <lable>Date Of Birth :</lable>
   <input type='date' name='dob' class='form-control' value="<?php echo $date; ?>">
   <?php echo $msg1; ?>
</div>

<div class ='form-group'>
  <lable>New Password:</lable>
  <input type='password' value="<?php echo $password ;?>" name='pass' class='form-control' placeholder="Enter Your Password">
  <?php echo $msg2; ?>
</div>

<div class ='form-group'>
  <lable>Re-enter Password :</lable>
  <input type='password' name='cpass'  value="<?php echo $cpassword ;?>" class='form-control' placeholder="Re-Enter New Password">
<?php echo $msg3; ?>
</div>

</br><center><button class='btn btn-success' name ='submit'>Submit</button></center>

</br><center><a href='login.php'>Back To Login ?</a></center>
</form>
</div>
</div>
</div>
</body>
</html>

<?php
include("include/header.php");
include("include/config.php");
session_start();
include("include/functions.php");
$id=$_GET['id'];
if(isset($id))
{
$msg='';$msg1='';$msg2='';
if(isset($_POST['submit']))
{
  $password=$_POST['pass'];
  $cpassword=$_POST['cpass'];
  if(empty($password))
  {
    $msg="<div class='error'>Please Enter new password</div>";
  }
  else if(strlen($password)<5)
  {
    $msg="<div class='error'>Password must have atleast 5 characters</div>";

  }
  else if(empty($cpassword))
  {
    $msg1="<div class='error'>Please Re-Enter new password</div>";
  }
  else if($password!=$cpassword)
  {
    $msg1="<div class='error'>Password is not same</div>";
  }
  else{
    $pass=md5($password);
    mysqli_query($con,"UPDATE users SET password='$pass' WHERE id='$mail'");
    $msg2="<div class='success'>Password Changed Successfully</div>";

  }
}
?>
<title>Change Password</title>
<style type ="text/css">
#body-bg
{
  background-color: #efefef;
}
.box
{
  border:1px solid gray;
  padding:20px;
  border-radius:5px;
  box-shadow: 3px 3px 3px gray;
  background-color: lightgreen;
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
</head>
<body id='body-bg'>
<div class='container' style='padding-top:10px; background-color:#fff; margin-top:20px;margin-bottom:20px;width:1200px;height:640px;'>
  <a href ='profile.php'><button class ='btn btn-outline-danger' style='float:right'>Back</button></a>
<div class ='col-md-4 offset-md-4'>
  <div class='box'>
<h2 align="center">Change Password</h2></br>
<center><?php echo $msg2; ?></center>
<form method='post'>

<div class ='form-group'>
  <lable>Enter new password :</lable>
  <input type='password' name= 'pass' placeholder='Enter new password' class='form-control'>
  <?php echo $msg; ?>
</div>

<div class ='form-group'>
  <lable>Re-Enter new password :</lable>
  <input type='password' name= 'cpass' placeholder='Re-Enter new password' class='form-control'>
  <?php echo $msg1; ?>
</div>

<center><button name='submit' class='btn btn-success' >Submit</button></center>
</form>
</div>
</div>
</div>
</body>
</html>
<?php
}
else {
  header("location:login.php");
}

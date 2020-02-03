<?php
include("include/header.php");
include("include/config.php");
include("include/functions.php");
session_start();
$msg='';$msg1='';

if(isset($_POST['submit']))
{
  $fname=$_POST['name'];
  $password=$_POST['pass'];

  if(empty($fname))
  {
    $msg='<div class="error">Please Enter Your Name</div>';
  }
else if(empty($password))
{
  $msg1='<div class="error">Please Enter Your Password</div>';
}
else
{
$pass=mysqli_query($con,"SELECT password FROM admin WHERE name='$fname'");
$pass_w=mysqli_fetch_array($pass);
$dpass=$pass_w['password'];
if($password!==$dpass)
{
    $msg1='<div class="error">Password is  worng</div>';
}
 else
 {
   $_SESSION['name']=$fname;
  header("location:admin_panel.php");
 }
}
}
?>
<title>Admin Login</title>
<style type ="text/css">
#body-bg
{
  background: url("images/bg.jpg") center no-repeat fixed;
}
.error
{
  color:red;
}
</style>

</head>
<body id='body-bg'>
  <div class ='container'>
    <div class = 'login-form col-md-4 offset-md-4'>
      <div class = 'jumbotron' style='margin-top:50px; padding-top:20px; padding-bottom:20px'>
        <h2 align ='center'>Login Form</h2></br>
        <form method ='post'>

        <div class ='form-group'>
          <lable>User name :</lable>
          <input type ='text' name="name" class='form-control' placeholder='User Name'  >
          <?php echo $msg; ?>
        </div>

        <div class ='form-group'>
          <lable>password :</lable>
          <input type ='password' name="pass" class='form-control' placeholder='Password'>
          <?php echo $msg1; ?>
        </div>

        <div class ='form-group'>
          <center><input type ="submit" name='submit' value='Login' class='btn btn-success' ></center>
        </div>

</form>
</div>
</div>
</div>
</body>
</html>

<?php
include("include/header.php");
include("include/config.php");
include("include/functions.php");
session_start();
$msg='';$msg1='';
$email='';
if(isset($_POST['submit']))
{
  $email=$_POST['mail'];
  $password=$_POST['pass'];
  $checkbox=isset($_POST['check']);
  if(empty($email))
  {
    $msg='<div class="error">Please Enter Your Email</div>';
  }
else if(empty($password))
{
  $msg1='<div class="error">Please Enter Your Password</div>';
}
else if(email_exists($email,$con))
{
$pass=mysqli_query($con,"SELECT password FROM users WHERE mail='$email'");
$pass_w=mysqli_fetch_array($pass);
$dpass=$pass_w['password'];
$password=md5($password);
if($password!==$dpass)
{
    $msg1='<div class="error">Password is  worng</div>';
}
 else
 {
   $_SESSION['mail']=$email;
   if($checkbox=='on')
   {
     setcookie('name',$email,time()+3000);
   }
  header("location:profile.php");
 }
}
else
{
  $msg='<div class="error">Email does not Exists</div>';
}
}
?>
<title>Login Form</title>
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
          <lable>Email :</lable>
          <input type ='email' name="mail" class='form-control' placeholder='Your email' value='<?php echo $email; ?>'>
          <?php echo $msg; ?>
        </div>

        <div class ='form-group'>
          <lable>password :</lable>
          <input type ='password' name="pass" class='form-control' placeholder='Password'>
          <?php echo $msg1; ?>
        </div>

        <div class ='form-group'>
          <input type ='checkbox' name="check" >
          &nbsp; Keep me Logged in
        </div></br>

        <div class ='form-group'>
          <center><input type ="submit" name='submit' value='Login' class='btn btn-success' ></center>
        </div>

     <center><a href ='forgot.php'>Forgot Password ?</a></center>
</form>
</div>
</div>
</div>
</body>
</html>

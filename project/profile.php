<?php
include("include/header.php");
include("include/config.php");
session_start();
include("include/functions.php");
if(logged_in())
{
  header("location:login.php");
}
if(isset($_COOKIE['name']))
{

  $email=$_COOKIE['name'];
$result=mysqli_query($con,"SELECT id,first_name,last_name,img FROM users WHERE mail='$email'");
$retrive=mysqli_fetch_array($result);
//print_r($retrive);
$id=$retrive['id'];
$firstname=$retrive['first_name'];
$lastname=$retrive['last_name'];
$image=$retrive['img'];
?>
<title>Profile Page</title>
<style type ="text/css">
#body-bg
{
  background-color: #efefef;
}
</style>
</head>
<body id='body-bg'>
<div class='container' style='padding-top:10px; background-color:#fff; margin-top:20px;margin-bottom:20px;width:1200px;height:640px;'>
<h2 align='center'>Welcome <?php echo ucfirst($firstname)." ".ucfirst($lastname) ?></h2>
<a href ='logout.php'><button class ='btn btn-outline-success' style='float:right;'>Logout</button></a>
<a href ='changePassword.php?id=<?php echo $id; ?>'><button class ='btn btn-outline-primary' style='float:left;'>Change password</button></a></br></br>
<center><img src='images/<?php echo $image ?>' class='img-fluid img-thumbnail'style='width:350px;'></center>
</div>
</body>
</html>
<?php
}
else
{

  $email=$_SESSION['mail'];
  $result=mysqli_query($con,"SELECT id,first_name,last_name,img FROM users WHERE mail='$email'");
  $retrive=mysqli_fetch_array($result);
  //print_r($retrive);
  $id=$retrive['id'];
  $firstname=$retrive['first_name'];
  $lastname=$retrive['last_name'];
  $image=$retrive['img'];
  ?>
  <title>Profile Page</title>
  <style type ="text/css">
  #body-bg
  {
    background-color: #efefef;
  }
  </style>
  </head>
  <body id='body-bg'>
  <div class='container' style='padding-top:10px; background-color:#fff; margin-top:20px;margin-bottom:20px;width:1200px;height:640px;'>
  <h2 align='center'>Welcome <?php echo ucfirst($firstname)." ".ucfirst($lastname) ?></h2>
  <a href ='logout.php'><button class ='btn btn-outline-success' style='float:right;'>Logout</button></a>
  <a href ='changePassword.php?id=<?php echo $id; ?>'><button class ='btn btn-outline-primary' style='float:left;'>Change password</button></a></br></br>

  <center><img src='images/<?php echo $image ?>' class='img-fluid img-thumbnail'style='width:350px;'></center>
  </div>
  </body>
  </html>
<?php
}
?>



<?php
include "configure.php";
if(isset($_POST['username']) and isset($_POST['name']) and isset($_POST['password']))
{
    $uname = $_POST['username'];
    $psd = $_POST['password'];
    $nm = $_POST['name'];
    // echo $uname;
    // echo $psd;
    // echo $nm;
    $query = "select * from registrations where username ='$uname'";
    $result = mysqli_query($conn,$query);
    if($result)
    {
      if(mysqli_num_rows($result)==1)
      {
        $msg = "Username already taken";
        $htcont = "<script >alert('$msg');window.location = 'index.php';</script>";
        echo $htcont;
    }
      else
      {
          $query = "insert into registrations (name,username,password) values ('$nm','$uname','$psd')";
          $result = mysqli_query($conn,$query);
          $htcont = "";
          if($result)
          {
              $msg = "User created please login to proceed!";
              $htcont = "<script >alert('$msg');window.location = 'index.php';</script>";
              header("location: signin.php");
          }
          else
          {
              $msg = "something error";
              $htcont = "<script >alert('$msg');window.location = 'index.php';</script>";
          }
          echo $htcont;
      }
    }
    else
    {
        $msg = "Server Error";
        $htcont = "<script >alert('$msg');window.location = 'index.php';</script>";
        echo $htcont;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Form</title>
  <link rel="stylesheet" href="design.css">
</head>

<body>
  <div class="container">

    <form action="index.php" method="post">
      <h1 class="Mainheading">Sign up </h1>
      <!-- <p><marquee>Required fields are noted by *</marquee></p> -->
      <h2>Register Here!</h2>
      <p>Name: *<input type="text" name="name" required placeholder="Enter full name" /></p>
      <p>Username: *<input type="text" name="username" required placeholder="Enter  username" /></p>
      <p>Password: *<input type="password" name="password" required placeholder="Enter password" /></p>
      <input type="submit" value="Register" />
      
    </form>
  </div>
</body>

</html>
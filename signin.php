<?php
//we have made the two variables login and showError with default values false
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'configure.php';
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    
     //select the username and password  from the database
    $sql = "Select * from registrations where username='$username' AND password='$password'";
    // $sql = "Select * from registrations where username='$username'";
    //then make the connection
    $result = mysqli_query($conn, $sql);
    //consider is there any similar entry present in database
    $num = mysqli_num_rows($result);
    if ($num == 1){
        
                $login = true;

                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location: welcome.php");        
    } 
    else{
        $showError = "Invalid Credentials";
    }
}
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>signin Form</title>
  <link rel="stylesheet" href="design.css">
</head>

<body>
<?php
    if($login){
        echo 'You are successfully logged in ';
    }
    if($showError){
        echo 'wrong username or password';
    }
    ?>
  <div class="container">

    <form action="signin.php" method="post">
      <h1 class="Mainheading">Sign in </h1>
     
     
      <p>Username: *<input type="text" name="username" required placeholder="Enter  username" /></p>
      <p>Password: *<input type="password" name="password" required placeholder="Enter password" /></p>
      <input type="submit" value="Sign in" />
      
    </form>
  </div>
</body>

</html>
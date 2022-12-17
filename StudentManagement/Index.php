<?php
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form>
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Student ID</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <a name="submit" class="sbtn" href="home.php">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Submit
            </a>
        </form>
        <div class="grid">
            <p class="text--center">Not a member? <a class="signup" href="registration.html">Register &#8250</a>
        </div>

    </div>


    </body>

    
<?php
   
 function test_input($data) {
      
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
 }
   
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
     $username = test_input($_POST["username"]);
     $password = test_input($_POST["password"]);
     $submit = $conn->prepare("SELECT * FROM adminlogin");
     $submit->execute();
     $users = $submit->fetchAll();
      
     foreach($users as $user) {
          
         if(($user['username'] == $username) &&
             ($user['password'] == $password)) {
                 header("location: home.php");
         }
         else {
             echo "<script language='javascript'>";
             echo "alert('WRONG INFORMATION')";
             echo "</script>";
             die();
         }
     }
 }
  
 ?>
</html>
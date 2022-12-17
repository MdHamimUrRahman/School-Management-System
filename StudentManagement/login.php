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
        <form method="post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="user-box">
                <input type="text" name="sid" required="">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <button class="sbtn" type="submit">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Submit
            </button>
        </form>
        <div class="grid">
            <p class="text--center">Not a member? <a class="signup" href="registration.php">Register &#8250</a>
        </div>

    </div>
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $sid = $_POST['sid'];
            $password = $_POST['password'];
            $sql = "SELECT s_id FROM students WHERE s_id ='$sid' and s_password = '$password' ";
            $result = $conn->query($sql);
            
            if($result->num_rows > 0){
                session_start();
                $_SESSION['login_user']= $sid;
                header('Location: home.php');
                exit();
            }
            else{
                echo "The student id is not registered yet.";
            }
        }
        ?>
    </body>
</html>
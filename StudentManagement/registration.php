<?php
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Registration</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <div class="login-box">
        <h2>New Registration</h2>
        <form method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="user-box">
                <input type="text" name="sid" required>
                <label>Student ID</label>
            </div>
            <div class="user-box">
                <input type="text" name="sname" required>
                <label>Full Name</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" required>
                <label>E-mail</label>
            </div>
            <div class="user-box">
                <input type="tel" name="pnumber" required>
                <label>Mobile Number</label>
            </div>
            <div class="user-box">
                <input type="text" name="address" required>
                <label>Address</label>
            </div>
            <div class="user-box">
                <input type="text" name="dep" required>
                <label>Program</label>
            </div>
            <div class="user-box">
                <input type="date" name="bdate" required>
                <label>Birth date</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>

            <a href="login.php" class="previous">&#8249 back</a>
            <button type = 'submit'>Submit&#8250</button>
        </form>

    </div>
    <?php 
    
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $sid = $_POST['sid'];
            $sname = $_POST['sname'];
            $semail= $_POST['email'];
            $pnumber = $_POST['pnumber'];
            $dep = $_POST['dep'];
            $bdate = $_POST['bdate'];
            $password = $_POST['password'];
            $address = $_POST['address'];
            $month = date('m');
            $year = substr(date('Y'), -2);
            if($month >=1 && $month <= 4){
                $sem = "Spring".$year;
            }
            elseif($month >=5 && $month <= 8){
                $sem = "Summer".$year;
            }
            else{
                $sem = "Fall".$year;

            }
            
            
            $sql = "SELECT s_id FROM students WHERE s_id ='$sid' ";
            $result = $conn->query($sql);
            
            if($result->num_rows > 0){
                echo "The student id already has been registered.";
            }
            else{
                $sql = "INSERT INTO `students`(`s_id`, `s_name`, `s_email`, `s_phone`, `s_password`, `s_address`, `s_bdate`, `dep`, `semester`) 
                VALUES ('$sid','$sname','$semail','$pnumber','$password','$address','$bdate','$dep','$sem')";
                if($conn->query($sql) == TRUE){
                    echo "Registration was successfull.";
                    header('Location: login.php');
                    exit();
                    
                }else{
                    echo"Try again!";
                }
            }


        }
    ?>
</body>
</html>
<?php
require "session.php";
require "connection.php";

$id = $_SESSION['login_user'];
$sql = "SELECT * FROM students where s_id=$id";
$self_info = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <div class="login-box">
        <h2>New Registration</h2>
        <form method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="user-box">
                <input type="text" name="sid" value='<?php echo $self_info[0]['s_id']; ?>' required>
                <label>Student ID</label>
            </div>
            <div class="user-box">
                <input type="text" name="sname" value='<?php echo $self_info[0]['s_name']; ?>' required>
                <label>Full Name</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" value='<?php echo $self_info[0]['s_email']; ?>' required>
                <label>E-mail</label>
            </div>
            <div class="user-box">
                <input type="tel" name="pnumber" value='<?php echo $self_info[0]['s_phone']; ?>' required>
                <label>Mobile Number</label>
            </div>
            <div class="user-box">
                <input type="text" name="address" value='<?php echo $self_info[0]['s_address']; ?>' required>
                <label>Address</label>
            </div>
            <div class="user-box">
                <input type="text" name="dep" value='<?php echo $self_info[0]['dep']; ?>' required>
                <label>Program</label>
            </div>
            <div class="user-box">
                <input type="text" name="sem" value='<?php echo $self_info[0]['semester']; ?>' required>
                <label>Semester</label>
            </div>
            <div class="user-box">
                <input type="date" name="bdate" value='<?php echo $self_info[0]['s_bdate']; ?>' required>
                <label>Birth date</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" value='<?php echo $self_info[0]['s_password']; ?>' required>
                <label>Password</label>
            </div>
            <button type='submit'>Update Profile&#8250</button>
        </form>

    </div>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sid = $_POST['sid'];
        $sname = $_POST['sname'];
        $semail = $_POST['email'];
        $pnumber = $_POST['pnumber'];
        $dep = $_POST['dep'];
        $bdate = $_POST['bdate'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $sem = $_POST['sem'];

        $sql = "SELECT s_id FROM students WHERE s_id ='$sid' ";
        $result = $conn->query($sql);


        $sql = "INSERT INTO `requests`(`s_id`, `s_name`, `s_email`, `s_phone`, `s_password`, `s_address`, `s_bdate`, `dep`, `semester`) 
                VALUES ('$sid','$sname','$semail','$pnumber','$password','$address','$bdate','$dep','$sem')";
        if ($conn->query($sql) == TRUE) {
            echo "Request  pending was successfull.";
        } else {
            echo "Try again!";
        }
    }
    ?>
</body>

</html>
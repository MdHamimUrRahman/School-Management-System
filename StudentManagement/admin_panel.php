<?php
require "session.php";
require "connection.php";

$id = $_SESSION['login_user'];
$sql = "SELECT * FROM students where s_id=$id";
$self_info = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

$sql = "select * from requests";
$result = $conn->query($sql);
$row = [];
if ($result->num_rows > 0) {
    $row = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <div class="sbox" >
        <h2>Add Courses</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="user-box">
                <input type="text" name="cid" required>
                <label>Course ID</label>
            </div>
            <div class="user-box">
                <input type="text" name="cname" required>
                <label>Course Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="cdep" required>
                <label>Course Department</label>
            </div>
            <div class="user-box">
                <input type="text" name="preq" >
                <label>Pre requisite</label>
            </div>
            <div class="user-box">
                <input type="text" name="teacher" required>
                <label>Faculty</label>
            </div>
            <div class="user-box">
                <input type="number" name="aseat" required>
                <label>Available Seat</label>
            </div>
            <div class="user-box">
                <input type="date" name="e_date" required>
                <label>Exam Date</label>
            </div>
            <button type="submit" name="insert" value="submit">SUBMIT</button>
        </form>
    </div>
    <div class="table0">
    <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Birth date</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($row))
                        foreach ($row as $rows) {
                    ?>
                        <tr>

                            <td><?php echo $row['s_id']; ?></td>
                            <td><?php echo $row['s_name']; ?></td>
                            <td><?php echo $row['s_email']; ?></td>
                            <td><?php echo $row['s_bdate']; ?></td>
                            <td><?php echo $row['dep']; ?></td>
                            <!-- <td><button type = 'submit' formaction="update.php">Approve</button></td>
                            <td><button type = 'submit' formaction="decline.php">Decline</button></td> -->

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    </div>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $cid = $_POST['cid'];
            $cname = $_POST['cname'];
            $cdep = $_POST['cdep'];
            $preq = $_POST['preq'] == ""?'NULL': $_POST['preq'];
            $teacher = $_POST['teacher'];
            $edate = $_POST['e_date'];
            $aseat = $_POST['aseat'];

            $sql = "INSERT INTO `courses`(`c_id`, `c_name`, `c_dep`, `c_pre`, `c_faculty`, `a_seat`, `exam_date`) 
            VALUES ('$cid','$cname','$cdep',$preq,'$teacher','$aseat','$edate')";
            if($conn->query($sql) == TRUE){
                echo "Course has been added successfully";
            }
            else{
                echo "Something went wrong! Failed to add the course.";
            }



        }
    ?>
</body>



</html>
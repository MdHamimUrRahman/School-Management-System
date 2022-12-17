<?php
require "session.php";
require "connection.php";

$id = $_SESSION['login_user'];
$sql = "SELECT * FROM students where s_id=$id";
$self_info = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

$sql = "select * from students where s_id != $id";
$result = $conn->query($sql);
$row = [];

if ($result->num_rows > 0) {
    $row = $result->fetch_all(MYSQLI_ASSOC);
}

$sql = "SELECT * FROM  student_courses sa INNER JOIN courses c ON sa.c_id = c.c_id INNER JOIN teachers t ON c.c_faculty=t.t_id  WHERE s_id = '$id'";
$result = $conn->query($sql);
$crow = [];

if ($result->num_rows > 0) {
    $crow = $result->fetch_all(MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="home.css?<?php echo time(); ?>">
</head>

<body>
    <nav>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <button class="lgt" type="submit" name="insert" value="submit">Logout</button>
        </form>
    </nav>
    <div>
        <div>
            <table class="my_profile">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Birth date</th>
                        <th>Department</th>
                        <th>CGPA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <td><?php echo $self_info[0]['s_id']; ?></td>
                        <td><?php echo $self_info[0]['s_name']; ?></td>
                        <td><?php echo $self_info[0]['s_email']; ?></td>
                        <td><?php echo $self_info[0]['s_bdate']; ?></td>
                        <td><?php echo $self_info[0]['dep']; ?></td>
                        <td><?php echo $self_info[0]['cgpa']; ?></td>

                    </tr>


                </tbody>
            </table>
        </div>
        <div>
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

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Department</th>
                        <th>Pre Requisite</th>
                        <th>Available Seat</th>
                        <th>Exam Date</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($row))
                        foreach ($row as $rows) {
                    ?>
                        <tr>

                            <td><?php echo $crow['c_id']; ?></td>
                            <td><?php echo $crow['c_name']; ?></td>
                            <td><?php echo $crow['c_dep']; ?></td>
                            <td><?php echo $crow['t_initial']; ?></td>
                            <td><?php echo $crow['c_pre']; ?></td>
                            <td><?php echo $crow['a_seat']; ?></td>
                            <td><?php echo $crow['exam_date']; ?></td>


                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_SESSION['login_user'])) {
            unset($_SESSION['login_user']);
            header('Location:login.php');
        }
    }
    ?>
</body>
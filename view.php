<?php
include 'includes/db.php';

$id = $_GET['id'];
$query = "SELECT student.*, classes.name AS class_name 
          FROM student 
          LEFT JOIN classes ON student.class_id = classes.class_id 
          WHERE student.id = $id";
$result = $conn->query($query);
$student = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Student Details</h1>
    <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
    <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
    <p><strong>Address:</strong> <?php echo $student['address']; ?></p>
    <p><strong>Class:</strong> <?php echo $student['class_name']; ?></p>
    <p><strong>Created At:</strong> <?php echo $student['created_at']; ?></p>
    <img src="uploads/<?php echo $student['image']; ?>" alt="Student Image" width="150">
    <br>
    <a href="index.php">Back to Home</a>
</body>
</html>

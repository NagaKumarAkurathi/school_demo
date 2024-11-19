<?php
include 'includes/db.php';

$query = "SELECT student.*, classes.name AS class_name 
          FROM student 
          LEFT JOIN classes ON student.class_id = classes.class_id";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Students List</h1>
    <a href="create.php">Add Student</a>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Class</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['class_name']; ?></td>
            <td><img src="uploads/<?php echo $row['image']; ?>" alt="Image" width="50"></td>
            <td>
                <a href="view.php?id=<?php echo $row['id']; ?>">View</a> |
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
